<?php

namespace AlwaysBlank\Brick\Tests;

use AlwaysBlank\Brick\Brick\Attribute;
use AlwaysBlank\Brick\Brick\Element;
use AlwaysBlank\Brick\Tag\AttributeName;
use AlwaysBlank\Brick\Tag\CustomElementAttributeName;
use AlwaysBlank\Brick\Tag\DataAttributeName;
use AlwaysBlank\Brick\Tag\Tag;
use PHPUnit\Framework\Attributes\CoversFunction;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use function AlwaysBlank\Brick\is_element_array;

#[CoversFunction('\AlwaysBlank\Brick\is_element_array')]
class is_element_arrayTest extends TestCase {
	public static function provide_is_element_array(): array {
		return [
			'tag enum' => [
				[Tag::P],
				true,
			],
			'nested array' => [
				[Tag::P, [[Tag::SPAN]]],
				true,
			],
			'attribute object' => [
				[ Tag::DIV, [], Attribute::factory( AttributeName::ID, 'test' ) ],
				true,
			],
			'custom element attribute name' => [
				[ Tag::DIV, [], [CustomElementAttributeName::factory( 'custom-attr' )] ],
				true,
			],
			'data attribute name' => [
				[ Tag::DIV, [], [DataAttributeName::factory( 'test' )] ],
				true,
			],
			'empty array' => [
				[],
				false,
			],
			'array with string' => [
				[ 'not an element' ],
				false,
			],
			'array with integer' => [
				[ 123 ],
				false,
			],
			'array with null' => [
				[ null ],
				false,
			],
			'mixed valid elements nested' => [
				[ Tag::DIV, [ AttributeName::ID, [ [ Tag::SPAN ] ] ] ],
				true,
			],
			'array with stdClass object' => [
				[ new \stdClass() ],
				false,
			],
			'nested array with invalid element' => [
				[ Tag::P, [ 'invalid' ] ],
				false,
			],
		];
	}

	#[DataProvider( 'provide_is_element_array' )]
	public function test_is_element_array(mixed $arg, bool $expected): void {
		self::assertSame($expected, is_element_array($arg));
		try {
			Element::factory(...$arg);
		} catch (\TypeError $e) {
			var_dump($e);
			self::fail('Element::factory() should not throw a TypeError');
		}
	}
}
