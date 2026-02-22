<?php

namespace AlwaysBlank\Brick\Brick;

use AlwaysBlank\Brick\Interface\{ElementAttributeName, IsComparable, IsHashable};
use AlwaysBlank\Brick\Traits\{Comparable, Hashable, Renderable};
use Stringable, JsonException, JsonSerializable;

/**
 */
class Attribute implements IsHashable, IsComparable, Stringable {
	use Hashable, Comparable, Renderable;

	final protected function __construct( readonly public ElementAttributeName $name, readonly public int|float|string|null|Stringable|JsonSerializable $value = null ) {}

	public function build(): string {
		if ( null === $this->value ) {
			// This is a boolean attribute.
			return $this->name->name();
		}

		try {
			$value = match( true ) {
				$this->value instanceof JsonSerializable => json_encode( $this->value, JSON_THROW_ON_ERROR ),
				default => $this->value,
			};
		} catch ( JsonException $e ) {
			trigger_error("Failed to encode attribute value: {$e->getMessage()}", E_USER_WARNING);
			$value = null;
		}

		if ( null === $value ) {
			// Something about this is invalid, so return nothing.
			return '';
		}

		return sprintf( '%s="%s"', $this->name->name(), htmlspecialchars( (string) $value, ENT_QUOTES, null, false ) );
	}

	public static function factory( ElementAttributeName $name, null|int|float|string|JsonSerializable $value = null ) : static {
		return new static( $name, $value );
	}
}
