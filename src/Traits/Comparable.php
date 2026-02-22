<?php

namespace AlwaysBlank\Brick\Traits;

use AlwaysBlank\Brick\Interface\IsHashable;

trait Comparable {
	use Hashable;

	public function is_same(mixed ...$others): bool {
		foreach($others as $other) {
			if($other !== $this) {
				return false;
			}
		}
		return true;
	}

	public function is_equivalent(mixed ...$others): bool {
		if (0 === count($others)) {
			// Can't be equivalent to nothing.
			return false;
		}
		if ($this->is_same(...$others)) {
			// Bricks which are the same are by definition equivalent.
			return true;
		}
		return array_reduce(
			$others,
			function(bool $carry, mixed $other) {
				if (false === $carry || !$other instanceof IsHashable) {
					return false;
				}
				try {
					return $this->hash() === $other->hash();
				} catch (\Throwable $e) {
					trigger_error("Failed to hash Brick: {$e->getMessage()}", E_USER_WARNING);
					return false;
				}
			},
			true
		);
	}
}
