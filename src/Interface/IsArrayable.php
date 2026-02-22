<?php

namespace AlwaysBlank\Brick\Interface;

interface IsArrayable extends \Iterator, \JsonSerializable {
	public static function factory(mixed ...$args): self;
}
