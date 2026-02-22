<?php

namespace AlwaysBlank\Brick\Brick;

use AlwaysBlank\Brick\Interface\{IsComparable, IsContent, IsHashable};
use AlwaysBlank\Brick\Traits\{Comparable, Hashable, Renderable};
use Stringable;

/**
 */
class Scalar implements IsHashable, IsComparable, IsContent {
	use Hashable, Comparable, Renderable;

	/**
	 * @var list<int|float|string|bool> $value
	 */
	readonly public array $value;

	final protected function __construct( int|float|string|bool ...$value ) {
		$this->value = array_values( $value );
	}

	/**
	 * @inheritDoc
	 */
	public function build(): string {
		return implode( ' ', $this->value );
	}

	/**
	 * Is this value suitable for use as a {@see Scalar}?
	 *
	 * @phpstan-assert-if-true int|float|string|bool $value
	 */
	public static function is_scalar( mixed $value ): bool {
		return is_string($value) || is_float($value) || is_int($value) || is_bool($value);
	}

	public static function factory( int|float|string|bool ...$value ): static {
		return new static( ...$value );
	}
}
