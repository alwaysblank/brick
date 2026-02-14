<?php

namespace AlwaysBlank\Brick\Tests;

use AlwaysBlank\Brick\Brick;
use AlwaysBlank\Brick\CustomTag;
use AlwaysBlank\Brick\Element as E;
use AlwaysBlank\Brick\Scalar as S;
use AlwaysBlank\Brick\Attribute as A;

use AlwaysBlank\Brick\Tag;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class Element extends TestCase {
	public static function provide_render(): array {
		return [
			[
				E::factory(Tag::DIV,E::factory(Tag::IMG, A::factory('src', 'foo.png'))),
				'<div><img src="foo.png"></div>',
			],
			[
				E::factory(CustomTag::factory('good-sandwiches'), S::factory('reuben'), S::factory(', '), S::factory('grinder')),
				'<good-sandwiches>reuben, grinder</good-sandwiches>',
			]
		];
	}

	#[DataProvider('provide_render')]
	public function test_render(Brick $brick, string $expected_html) {
		$this->assertEquals( $expected_html, $brick->render() );
	}
}
