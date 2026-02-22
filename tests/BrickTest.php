<?php

namespace AlwaysBlank\Brick\Tests;

use AlwaysBlank\Brick\Brick\Attribute;
use AlwaysBlank\Brick\Brick\Brick;
use AlwaysBlank\Brick\Tag\AttributeName;
use AlwaysBlank\Brick\Tag\Tag;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass('\AlwaysBlank\Brick\Brick\Brick')]
class BrickTest  extends \PHPUnit\Framework\TestCase {

	public static function provide_variable_arguments_to_el_shortcut(): array {
		return [
			'simple' => [
				'p',
				['food'],
				'<p>food</p>',
			],
			'mixed elements and attributes' => [
				'div',
				['food', Attribute::factory(AttributeName::CL, 'container'), Brick::img(Brick::attr(AttributeName::SRC, 'food.jpg'))],
				'<div class="container"><span>food</span><img src="food.jpg"/></div>',
			],
			'nonexistent element' => [
				'sandwich',
				['provolone', 'russian dressing', 'sauerkraut', 'pastrami'],
				'<sandwich><span>provolone</span><span>russian dressing</span><span>sauerkraut</span><span>pastrami</span></sandwich>',
			],
			'contains elements' => [
				'div',
				[Brick::p('food'), Brick::p('drink')],
				'<div><p>food</p><p>drink</p></div>',
			],
			'contains array elements' => [
				'div',
				[[Tag::P, 'food'], [Tag::P, 'drink', Attribute::factory(AttributeName::DISABLED)]],
				'<div><p>food</p><p disabled>drink</p></div>',
			],
			'contains boolean attribute array' => [
				'div',
				[[AttributeName::DISABLED]],
				'<div disabled></div>',
			],
			'contains attribute array' => [
				'img',
				[[AttributeName::SRC, 'food.jpg']],
				'<img src="food.jpg"/>',
			]
		];
	}

	#[DataProvider( 'provide_variable_arguments_to_el_shortcut')]
	public function test_variable_arguments_to_el_shortcut(string $el, array $args, string $expected): void {
		$result = Brick::$el(...$args);
		self::assertSame($expected, (string) $result);
	}

	public function test_attr_shortcut(): void {
		$result = Brick::attr(AttributeName::SRC, 'food.jpg');
		self::assertSame('src="food.jpg"', (string) $result);
	}

	public function test_sclr_shortcut(): void {
		$result = Brick::sclr('food');
		self::assertSame('food', (string) $result);
	}
}
