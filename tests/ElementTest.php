<?php

namespace AlwaysBlank\Brick\Tests;

use AlwaysBlank\Brick\Brick\Attribute;
use AlwaysBlank\Brick\Brick\Brick;
use AlwaysBlank\Brick\Brick\Element;
use AlwaysBlank\Brick\Brick\Scalar;
use AlwaysBlank\Brick\Interface\IsComparable;
use AlwaysBlank\Brick\Tag\Tag;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ElementTest extends TestCase {
	public static function provide_has_child(): array {
		return [
			'simple scalar' => [
				Element::factory(Tag::P, [Scalar::factory('food')]),
				Scalar::factory('food'),
				true,
			],
			'deep scalar' => [
				Element::factory(Tag::P, [
					Element::factory(Tag::SPAN, [Scalar::factory('food')]),
					Element::factory(Tag::SPAN, [Scalar::factory('drink')]),
				]),
				Scalar::factory('food'),
				false,
			],
			'contain self' => ( static function() {
				$element = Element::factory(Tag::P, [Element::factory(Tag::P, [])]);
				return [$element, $element, false];
			})(),
			'contain an equivalent' => [
				Element::factory(Tag::P, [Scalar::factory('food')]),
				Element::factory(Tag::P, [Scalar::factory('food')]),
				false,
			],
		];
	}

	#[DataProvider( 'provide_has_child' )]
	public function test_has_child(Element $element, \Stringable&IsComparable $content, bool $should_contain): void {
		self::assertSame($should_contain, $element->has_child($content));
		var_dump((string)Brick::div(['hi', 'there', 'friend'], Attribute::factory('data-test', 'value')));
	}

	public static function provide_has_descendant(): array {
		return [
			'simple scalar' => [
				Element::factory(Tag::P, [Scalar::factory('food')]),
				Scalar::factory('food'),
				true,
			],
			'deep scalar' => [
				Element::factory(Tag::P, [
					Element::factory(Tag::SPAN, [Scalar::factory('food')]),
					Element::factory(Tag::SPAN, [Scalar::factory('drink')]),
				]),
				Scalar::factory('food'),
				true,
			],
			'contain self' => ( static function() {
				$element = Element::factory(Tag::P, [Element::factory(Tag::P, [])]);
				return [$element, $element, false];
			})(),
			'contain an equivalent' => [
				Element::factory(Tag::P, [Scalar::factory('food')]),
				Element::factory(Tag::P, [Scalar::factory('food')]),
				false,
			],
		];
	}

	#[DataProvider( 'provide_has_descendant' )]
	public function test_has_descendant(Element $element, \Stringable&IsComparable $content, bool $should_contain): void {
		self::assertSame($should_contain, $element->has_descendant($content));
	}

	public static function provide_rendering(): array {
		return [
			'simple scalar' => [
				Element::factory(Tag::P, [Scalar::factory('food')]),
				'<p>food</p>',
			],
			'deep scalar' => [
				Element::factory(Tag::P, [
					Element::factory(Tag::SPAN, [Scalar::factory('food')]),
					Element::factory(Tag::SPAN, [Scalar::factory('drink')]),
				]),
				'<p><span>food</span><span>drink</span></p>',
			]
		];
	}

	#[DataProvider( 'provide_rendering' )]
	public function test_rendering(Element $element, string $expected): void {
		self::assertSame($expected, (string) $element);
	}
}
