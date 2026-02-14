<?php

namespace AlwaysBlank\Brick\Interface;

interface IsHashable {

	/**
	 * Provide a unique hash based on the object's identity.
	 */
	public function hash(): string;
}
