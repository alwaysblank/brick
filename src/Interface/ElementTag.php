<?php

namespace AlwaysBlank\Brick\Interface;

interface ElementTag {
	/**
	 * Is this a void (or "self-closing") tag?
	 */
	public function is_void(): bool;

	public function tag(): string;
}
