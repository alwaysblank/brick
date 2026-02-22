<?php

namespace AlwaysBlank\Brick\Tag;

readonly class DataAttributeName extends CustomElementAttributeName {
	protected function __construct( string $name ) {
		parent::__construct( 'data-' . $name );
	}
}
