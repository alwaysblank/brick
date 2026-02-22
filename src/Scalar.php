<?php

namespace AlwaysBlank\Brick;

readonly class Scalar extends Brick {

	private array $value;

	protected function __construct( int|float|string|bool ...$value ) {
		$this->value = $value;
	}

	/**
	 * @inheritDoc
	 */
	public function render(): string {
		return implode( ' ', $this->value );
	}

	public function add(int|float|string|bool ...$value): static {
		return new static(...$this->value, ...$value);
	}

	public static function factory( int|float|string|bool ...$value ): static {
		return new static( ...$value );
	}

	protected function __toArray() : array {
		return $this->value;
	}
}
