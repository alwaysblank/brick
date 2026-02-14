<?php

namespace AlwaysBlank\Brick;

use Traversable;

readonly class Attribute extends Brick {
	private const CLEAN_NAME = '/[^a-z0-9\-_\[\]]*/i';

	protected function __construct( protected string $name, protected int|float|string|null|\Stringable|\JsonSerializable $value = null ) {}

	public function render(): string {
		$name = preg_replace( self::CLEAN_NAME, '', $this->name );
		if ( null === $this->value ) {
			// This is a boolean attribute.
			return $name;
		}

		try {
			$value = match( true ) {
				$this->value instanceof \JsonSerializable => json_encode( $this->value, JSON_THROW_ON_ERROR ),
				default => (string) $this->value,
			};
		} catch ( \JsonException $e ) {
			$value = null;
		}

		if ( null === $value ) {
			// Something about this is invalid, so return nothing.
			return '';
		}

		return sprintf( '%s="%s"', $name, htmlspecialchars( $value ) );
	}

	public static function factory( string $name, int|float|string|null|\Stringable|\JsonSerializable $value = null ) : static {
		return new static( $name, $value );
	}

	protected function __toArray( bool $deep = false ) : array {
		return array_filter([$this->name, $this->value]);
	}
}
