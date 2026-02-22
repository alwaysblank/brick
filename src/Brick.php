<?php

namespace AlwaysBlank\Brick;

abstract readonly class Brick implements \IteratorAggregate {
	/**
	 * Renders the brick as HTML.
	 *
	 * @return string
	 */
	abstract public function render(): string;

	abstract protected function __toArray(): array;

	public function __toString() {
		return $this->render();
	}

	public function getIterator(): \Traversable {
		return new \ArrayIterator($this->__toArray());
	}
}
