<?php

namespace AlwaysBlank\Brick\Traits;

trait Arrayable {

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize() : mixed {
		return [...$this];
	}

	abstract public function current() : mixed;

	abstract public function next() : void;

	abstract public function key() : mixed;

	abstract public function valid() : bool;

	abstract public function rewind() : void;
}
