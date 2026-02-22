<?php

namespace AlwaysBlank\Brick;

use AlwaysBlank\Brick\{Brick\Attribute,
	Brick\Element,
	Brick\Scalar,
	Interface\ElementAttributeName,
	Interface\ElementTag};
use JsonSerializable, Stringable;
use PHPUnit\Event\Runtime\PHPUnit;

/**
 * Verifies that every value in an array passes a test.
 *
 * If no test is provided, it tests that each value is not null (similar to `array_filter()`).
 *
 * @param mixed[]         $arr      Array to test.
 * @param callable|null $callback Callback to test each value against.
 *
 * @return bool
 */
function array_every(array $arr, ?callable $callback = null): bool {
	if (null === $callback) {
		$callback = static fn($v) => null !== $v;
	}
	foreach($arr as $value) {
		if(!$callback($value)) {
			return false;
		}
	}
	return true;
}

/**
 * @phpstan-assert-if-true ElementContent $args
 */
function is_element_content(mixed $args): bool {
	$item_test = fn($v) => $v instanceof Element || $v instanceof Scalar || is_element_array($v) || is_scalar_value($v);
	if (is_array($args) && array_every($args, $item_test)) {
			return true;
	}
	return $item_test($args);
}

/**
 * @phpstan-assert-if-true ElementArray $args
 */
function is_element_array(mixed $args): bool {
	if (!is_array($args)) {
		return false;
	}
	// We don't care about any keys.
	$args = array_values($args);

	return match ( count( $args ) ) {
		1 => $args[0] instanceof ElementTag,
		2 => $args[0] instanceof ElementTag
		     && is_element_content( $args[1] ),
		3 => $args[0] instanceof ElementTag
		     && is_element_content( $args[1] )
		     && ( $args[2] instanceof Attribute || is_attribute_array( $args[2] ) || is_string( $args[2] ) ),
		default => false,
	};
}

/**
 * @phpstan-assert-if-true AttributeArray $args
 */
function is_attribute_array(mixed $args): bool {
	if ( ! is_array($args) || count($args) < 1 || count($args) > 2) {
		return false;
	}
	if ( !$args[0] instanceof ElementAttributeName ) {
		return false;
	}
	if (isset( $args[1])) {
		$v = $args[1];
		$value_check = is_numeric($v)
		               || is_string($v)
		               || $v instanceof Stringable
		               || $v instanceof JsonSerializable;
		if (!$value_check) {
			return false;
		}
	}
	return true;
}

/**
 * @phpstan-assert-if-true int|float|string|bool $value
 */
function is_scalar_value( mixed $value ): bool {
	return is_string($value) || is_float($value) || is_int($value) || is_bool($value);
}
