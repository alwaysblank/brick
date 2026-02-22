<?php

namespace AlwaysBlank\Brick\Brick;

use AlwaysBlank\Brick\Crawler;
use AlwaysBlank\Brick\Interface\{ElementTag, IsComparable, IsHashable, HasContent};
use AlwaysBlank\Brick\Traits\{ Comparable, Hashable, Renderable};
use Stringable;

/**
 */
class Element implements IsHashable, IsComparable, Stringable, HasContent {
	use Hashable, Comparable, Renderable;

	/**
	 * The content elements contained by this one.
	 *
	 * @phpstan-var list<IsComparable&Stringable> $content
	 */
	readonly public array $content;

	/**
	 * @phpstan-var list<Attribute>
	 */
	readonly public array $attributes;

	/**
	 * No type is defined for the `$content` or `$attributes` arguments so that
	 * we can verify them on construction.
	 *
	 * @param ElementTag $tag
	 * @param mixed|mixed[]                                   $content
	 * @param mixed|mixed[]                                   $attributes
	 */
	final protected function __construct( public readonly ElementTag $tag, mixed $content = [], mixed $attributes = []) {
		if ( ! is_array($content) ) {
			$content = [$content];
		}
		if ( ! is_array($attributes) ) {
			$attributes = [$attributes];
		}
		$this->content = array_values( array_filter( array_map(fn($v) => is_scalar($v) ? Scalar::factory($v) : $v, $content), fn( $c ) => is_object($c) && is_a($c, IsComparable::class) && is_a($c, Stringable::class) && !$this->is_same($c)));
		$this->attributes = array_values( array_filter( $attributes, static fn( $a ) => $a instanceof Attribute ));
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
	 * @param ElementTag $tag
	 * @param mixed|mixed[]                                   $content
	 * @param mixed|mixed[]                                   $attributes
	 *
	 * @return static
	 */
	public static function factory( ElementTag $tag, mixed $content = [], mixed $attributes = [] ): static {
		return new static( $tag, $content, $attributes );
	}
}
