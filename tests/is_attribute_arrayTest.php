<?php

namespace AlwaysBlank\Brick\Tests;

use AlwaysBlank\Brick\Tag\AttributeName;
use AlwaysBlank\Brick\Tag\CustomElementAttributeName;
use AlwaysBlank\Brick\Tag\DataAttributeName;
use PHPUnit\Framework\Attributes\CoversFunction;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use function AlwaysBlank\Brick\is_attribute_array;

#[CoversFunction('\AlwaysBlank\Brick\is_attribute_array')]
class is_attribute_arrayTest extends TestCase {

	public static function provide_is_attribute_array(): array {
		return [
			'value match' => [
				[AttributeName::SRC, 'img.jpg'],
				true,
			],
			'boolean match' => [
				[AttributeName::DISABLED],
				true,
			],
			'custom name match' => [
				[CustomElementAttributeName::factory('sandwich'), 'ham'],
				true,
			],
			'data attribute match' => [
				[DataAttributeName::factory('ships'), json_encode(['cerritos', 'enterprise'])],
				true,
			],
			'failure int' => [
				[1],
				false,
			],
			'failure string' => [
				['hi'],
				false,
			],
			'failure object' => [
				[(object) ['attr' => AttributeName::SRC]],
				false
			],
			'failure array' => [
				[['attr' => AttributeName::SRC]],
				false
			],
			'failure too short' => [
				[],
				false
			],
			'failure too long' => [
				[AttributeName::SRC, 'img.jpg', 'extra'],
				false,
			],
		];
	}

	#[DataProvider( 'provide_is_attribute_array' )]
	public function test_is_attribute_array(mixed $args, bool $expected): void {
		$this->assertSame($expected, is_attribute_array($args));
	}
}
