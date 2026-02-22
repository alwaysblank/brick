<?php

namespace AlwaysBlank\Brick\Tests;

use AlwaysBlank\Brick\Brick\Attribute;
use AlwaysBlank\Brick\Brick\Element;
use AlwaysBlank\Brick\Brick\Scalar;
use AlwaysBlank\Brick\Crawler;
use AlwaysBlank\Brick\Tag\AttributeName;
use AlwaysBlank\Brick\Tag\Tag;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Traversable;

#[CoversClass( Crawler::class)]
class CrawlerTest extends \PHPUnit\Framework\TestCase {
	public static function provide_find(): array {
		return [
			'simple' => ( function(){
				$search_for = Element::factory(Tag::P, [Scalar::factory('food')]);
				$element = Element::factory(Tag::DIV, [
					$search_for,
					new StopTest(),
				], [Attribute::factory(AttributeName::CL, 'sandwich')]);
				$callback = fn($content) => $content instanceof Element && $content->tag === Tag::P;

				return [$element, $search_for, $callback, true];
			})(),
		];
	}

	#[DataProvider('provide_find')]
	public function test_find(Element $element, $search_for, callable $search_method, bool $expect_to_find) {
		$crawler = Crawler::factory($element);
		$result = $crawler->find(function($content) use ($search_method) {
			self::assertNotInstanceOf(StopTest::class, $content);
			return $search_method($content);
		});
		self::assertSame($expect_to_find, $search_for->is_same($result));
	}
}

class StopTest {

	protected function __toArray() : array {
		return [];
	}

	public function offsetExists( mixed $offset ) : bool {
		TestCase::assertTrue(false, 'This object should not be reached during a search.');
		return false;
	}

	public function offsetGet( mixed $offset ) : mixed {
		TestCase::assertTrue(false, 'This object should not be reached during a search.');
		return null;
	}

	public function hash() : string {
		return spl_object_hash($this);
	}

	public function getIterator() : Traversable {
		return new \ArrayIterator([]);
	}

	public function offsetSet( mixed $offset, mixed $value ) : void {
		TestCase::assertTrue(false, 'This object should not be reached during a search.');
	}

	public function offsetUnset( mixed $offset ) : void {
		TestCase::assertTrue(false, 'This object should not be reached during a search.');
	}

	public function __toString() {
		return 'ERROR';
	}
}
