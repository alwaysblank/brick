<?php

namespace AlwaysBlank\Brick\Brick;

use AlwaysBlank\Brick\Interface\{IsComparable, IsHashable};
use AlwaysBlank\Brick\Traits\{Comparable, Hashable, Renderable};
use Stringable, JsonException, JsonSerializable;

/**
 */
class Attribute implements IsHashable, IsComparable, Stringable {
	use Hashable, Comparable, Renderable;
	private const CLEAN_NAME = '/[^a-z0-9\-_\[\]]*/i';

	final protected function __construct( readonly public string $name, readonly public int|float|string|null|Stringable|JsonSerializable $value = null ) {}

	public function build(): string {
		$name = preg_replace( self::CLEAN_NAME, '', $this->name );
		if ( null === $name ) {
			// This is not a valid attribute, so return nothing.
			return '';
		}

		if ( null === $this->value ) {
			// This is a boolean attribute.
			return $name;
		}

		try {
			$value = match( true ) {
				$this->value instanceof JsonSerializable => json_encode( $this->value, JSON_THROW_ON_ERROR ),
				default => (string) $this->value,
			};
		} catch ( JsonException $e ) {
			trigger_error("Failed to encode attribute value: {$e->getMessage()}", E_USER_WARNING);
			$value = null;
		}

		if ( null === $value ) {
			// Something about this is invalid, so return nothing.
			return '';
		}

		return sprintf( '%s="%s"', $name, htmlspecialchars( $value ) );
	}

	public static function factory( string $name, null|int|float|string|JsonSerializable $value = null ) : static {
		return new static( $name, $value );
	}
}
