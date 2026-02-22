<?php

namespace AlwaysBlank\Brick\Tag;

use AlwaysBlank\Brick\Interface\ElementAttributeName;

readonly class CustomElementAttributeName implements ElementAttributeName {

	protected const CLEAN_NAME = '/([\t\n\f \/>"\'=]+)/';
	protected ?string $name;

	protected function __construct( string $name ) {
		$cleaned = $this->check_name( $name );
		if ( null === $cleaned ) {
			throw new \InvalidArgumentException('Invalid attribute name.');
		}
		$this->name = $cleaned;
	}

	protected function check_name( string $name ) : ?string {
		return preg_replace( self::CLEAN_NAME, '', $name );
	}

	public function name(): string {
		return $this->name ?? '';
	}

	public static function factory( string $name ) : ElementAttributeName {
		if (str_starts_with($name, 'data-')) {
			$name = substr($name, 5);
			return DataAttributeName::factory($name);
		}
		return new self($name);
	}
}
