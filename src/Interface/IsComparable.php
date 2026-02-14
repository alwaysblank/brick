<?php

namespace AlwaysBlank\Brick\Interface;

interface IsComparable {

	/**
	 * Is this the same object as everything passed to this method?
	 *
	 * If you want to check for things that have the same data, use {@see is_equivalent()}.
	 */
	public function is_same(mixed ...$others): bool;

	/**
	 * Is this equivalent to everything passed to this method?
	 *
	 * "Equivalent" means that their hashes match, which generally means that
	 * they contain the same data but may not be the same literal object.
	 * If you want the same literal object, use {@see is_same()}.
	 */
	public function is_equivalent(mixed ...$others): bool;
}
