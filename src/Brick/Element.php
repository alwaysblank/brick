<?php

namespace AlwaysBlank\Brick\Brick;

use AlwaysBlank\Brick\Crawler;
use AlwaysBlank\Brick\Interface\{ElementTag, IsComparable, IsContent, IsHashable, HasContent};
use AlwaysBlank\Brick\Traits\{Arrayable, Comparable, Hashable, Renderable};
use Stringable;

/**
 */
class Element implements IsHashable, IsComparable, IsContent, HasContent {
	use Hashable, Comparable, Renderable, Arrayable;

	private int $index = 0;

	/**
	 * The content elements contained by this one.
	 *
	 * @phpstan-var list<IsContent> $content
	 */
	readonly public array $content;

	/**
	 * @phpstan-var list<Attribute>
	 */
	readonly public array $attributes;

	/**
	 */
	final protected function __construct( public readonly ElementTag $tag, self|Attribute|Scalar|IsContent|string|Stringable|int|float|bool ...$args) {
		$content = [];
		$attributes = [];
		foreach($args as $arg) {
			if ( $arg instanceof Attribute ) {
				$attributes[] = $arg;
			} elseif ( $arg instanceof IsContent ) {
				$content[] = $arg;
			} else {
				$content[] = Scalar::factory( (string) $arg );
			}
		}
		$this->content = $content;
		$this->attributes = $attributes;
	}

	public function get_content(): array {
		return $this->content;
	}

	public function replace_content( array $content ): static {
		return static::factory( $this->tag, $content, $this->attributes );
	}

	protected function build() : string {
		if (0 < count($this->content) && $this->tag->is_void()) {
			trigger_error("Void element <{$this->tag->tag()}> cannot have content.", E_USER_WARNING);
		}
		$opening_tag = implode(' ' , array_filter([
			$this->tag->tag(),
			0 === count( $this->attributes ) ? null : implode( ' ', $this->attributes )
		]) );
		$content = implode( '', $this->content );

		return $this->tag->is_void()
			? "<$opening_tag/>"
			: "<$opening_tag>$content</{$this->tag->tag()}>";
	}

	/**
	 * Does this element have the specified attribute?
	 *
	 * @param Attribute $attribute The attribute to check for.
	 * @param bool             $strict    Whether to match with {@see Comparable::is_same()} or {@see Comparable::is_equivalent()}.
	 */
	public function has_attribute(Attribute $attribute, bool $strict = false): bool {
		$compare_function = match( $strict ) {
			true => $attribute->is_same(...),
			false => $attribute->is_equivalent(...),
		};
		foreach($this->attributes as $a) {
			if ($compare_function($a)) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Is `$content` an immediate child of this element?
	 *
	 * @param IsComparable $content The content to check for.
	 * @param bool             $strict    Whether to match with {@see Comparable::is_same()} or {@see Comparable::is_equivalent()}.
	 *
	 * @return bool
	 */
	public function has_child(IsComparable $content, bool $strict = false): bool {
		if ($this->is_same($content)) {
			// An element can never contain itself.
			return false;
		}
		$compare_function = match( $strict ) {
			true => $content->is_same(...),
			false => $content->is_equivalent(...),
		};
		foreach($this->content as $c) {
			if ($compare_function($c)) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Is `$content` a descendant of this element?
	 *
	 * In other words, is it a direct child, or a direct child's child, etc.
	 * An item that returns true for {@see has_child()} will also return true
	 * for this method, as all children are descendants.
	 *
	 * @param Stringable $content The content to check for.
	 * @param bool             $strict    Whether to match with {@see Comparable::is_same()} or {@see Comparable::is_equivalent()}.
	 *
	 * @return bool
	 */
	public function has_descendant(Stringable $content, bool $strict = false): bool {
		if ($this->is_same($content)) {
			// An element can never contain itself.
			return false;
		}

		return (bool) Crawler::factory($this)->find( function(Stringable $c, int $level) use ($strict, $content) {
			if ( $level < 1 ) {
				// Don't want to return the top-level element.
				return false;
			}
			if(!$c instanceof IsComparable) {
				// Can't compare non-comparable objects.
				return false;
			}

			return $strict ? $c->is_same( $content ) : $c->is_equivalent( $content );
		});
	}

	/**
	 * Can this array be converted into an element?
	 *
	 * @phpstan-assert-if-true array{0: ElementTag} $args
	 * @phpstan-param mixed $args
	 */
	public static function is_element(mixed $args): bool {
		return is_array($args) && count($args) >= 2 && $args[0] instanceof ElementTag;
	}

	/**
	 */
	public static function factory( ElementTag $tag, self|Attribute|Scalar|IsContent|string|Stringable|int|float|bool ...$args ): static {
		return new static( $tag, ...$args );
	}

	/**
	 * Get the type and internal index of an item at top-level index of `$i`.
	 *
	 * @phpstan-return array{0: int<0, max>, 1: 'tag'|'content'|'attribute'}|null
	 */
	protected function get_type_index(int $i) : ?array {
		if ( $i < 0 ) {
			return null; // PHP doesn't do anything special w/ negative indices, and we're not storing anything there.
		}

		// index 0 refers to the element's tag
		if ( $i === 0 ) {
			return [ 0, 'tag' ];
		}

		// indices 1..N refer to content
		$content_index = $i - 1;
		if ( isset( $this->content[ $content_index ] ) ) {
			return [ $content_index, 'content' ];
		}

		// indices after content refer to attributes
		$content_length = count( $this->content );
		$attribute_index = $i - 1 - $content_length;
		if ( isset( $this->attributes[ $attribute_index ] ) ) {
			return [ $attribute_index, 'attribute' ];
		}

		return null;
	}

	public function current() : ElementTag|IsContent|Attribute|null {
		$type_index = $this->get_type_index( $this->index );
		if (null === $type_index) {
			return null;
		}
		[$i, $type] = $type_index;

		return match($type) {
			'tag' => $this->tag,
			'content' => $this->content[$i],
			'attribute' => $this->attributes[$i],
		};
	}

	public function next() : void {
		$this->index++;
	}

	public function key() : ?string {
		$type_index = $this->get_type_index( $this->index );
		if (null === $type_index) {
			return null;
		}
		[$i, $type] = $type_index;

		return match ($type) {
			'tag' => 'tag',
			'content' => "content_$i",
			'attribute' => "attribute_$i",
		};
	}

	public function valid() : bool {
		return null !== $this->get_type_index( $this->index );
	}

	public function rewind() : void {
		$this->index = 0;
	}
}
