<?php

namespace AlwaysBlank\Brick\Traits;

trait Renderable {
	/**
	 * Caches the rendered string representation of this object.
	 *
	 * @var string $rendered
	 */
	private string $rendered;

	/**
	 * Generates and returns the string representation of this object.
	 */
	abstract protected function build(): string;

	/**
	 * Returns the string representation of this object.
	 */
	public function __toString(): string {
		return $this->rendered ??= $this->build();
	}
}
