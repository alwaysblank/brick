<?php

namespace AlwaysBlank\Brick;

use AlwaysBlank\Brick\Brick\Element;
use AlwaysBlank\Brick\Interface\HasContent;
use Closure, Stringable;

class Crawler {
	private int $level;
	private Stringable $passed;

	protected function __construct(protected readonly Stringable $element) {}

	/**
	 * Recursively crawl the element and its content; think of it kind of like a recursive `map()`.
	 *
	 * @phpstan-param Closure(Stringable, int, Stringable): ?Stringable $callback
	 */
	protected function crawler(Stringable $element, Closure $callback) : null|Stringable {
		$this->level ??= 0;
		$processed_element = $callback($element, $this->level, $this->element);
		if (! $processed_element instanceof Stringable) {
			return null;
		}
		if ($processed_element instanceof HasContent) {
			$this->level++;
			$crawled = array_map(fn($el) => $this->crawler($el, $callback), $processed_element->get_content());
			if ($crawled === $processed_element->get_content()) {
				// Nothing has been changed, so return the original object.
				return $processed_element;
			}
			return $processed_element->replace_content(array_values(array_filter($crawled)));
		}
		$this->level--;
		return $processed_element;
	}

	/**
	 * Find an element.
	 *
	 * @param Closure(Stringable, int, Stringable): bool $callback
	 */
	protected function finder(Stringable $element, Closure $callback) : null|Stringable {
		if (isset($this->passed)) {
			return $element;
		}
		$this->level ??= 0;
		if ($callback($element, $this->level, $this->element)) {
			$this->passed = $element;
			return null;
		}
		if ($element instanceof HasContent) {
			$this->level++;
			foreach($element->get_content() as $el) {
				if($this->finder($el, $callback) === null) {
					return $this->passed;
				}
			}
			return $element;
		}
		$this->level--;
		return $element;
	}

	/**
	 * Recursively crawl the element and its content.
	 *
	 * If `$callback` returns `null`, it will cease moving down that branch and
	 * jump to the next. Otherwise, `$callback` should return an element. If you
	 * return a different element, it will replace the item currently being
	 * crawled. Note that if your replacement item contains elements of its own,
	 * they will be crawled as well.
	 *
	 * @phpstan-param Closure(Stringable, int, Stringable): ?Stringable $callback
	 */
	public function crawl( Closure $callback): null|Stringable {
		unset($this->level);
		return $this->crawler($this->element, $callback);
	}

	/**
	 * Return an array of all content items that pass the callback.
	 *
	 * This *can* include the element itself if the callback returns true.
	 *
	 * If you want only the first item, use {@see find()}.
	 *
	 * @param Closure(Stringable, int, Stringable): bool $callback
	 *
	 * @phpstan-return list<Stringable>
	 */
	public function match(Closure $callback): array {
		$collection = [];
		$this->crawler(
			$this->element,
			function(Stringable $content, int $level, Stringable $element_parent) use ($callback, &$collection) {
				if ($callback($content, $level, $element_parent)) {
					$collection[] = $content;
				}
				return $content;
			}
		);
		return $collection;
	}

	/**
	 * Return the first content item that matches the callback.
	 *
	 * This *can* be the element itself if the callback returns true.
	 *
	 * If you want all items, use {@see match()}.
	 *
	 * @phpstan-param Closure(Stringable, int, Stringable): bool $callback
	 */
	public function find(Closure $callback): null|Stringable {
		unset($this->passed);
		$found = null;
		$this->finder($this->element, function($element, int $level, Stringable $element_parent) use ($callback, &$found) {
			if ($callback($element, $level, $element_parent)) {
				$found = $element;
				return true;
			}
			return false;
		});
		return $found;
	}

	public static function factory(Stringable $element): self {
		return new self($element);
	}
}
