<?php

namespace AlwaysBlank\Brick\Tests;

use AlwaysBlank\Brick\Brick\Attribute;
use AlwaysBlank\Brick\Interface\ElementAttributeName;
use AlwaysBlank\Brick\Tag\AttributeName;
use AlwaysBlank\Brick\Tag\CustomElementAttributeName;
use AlwaysBlank\Brick\Tag\DataAttributeName;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass( Attribute::class )]
class AttributeTest extends \PHPUnit\Framework\TestCase {
	public static function provide_creation_and_stringability(): array {
		return [
			'use enum' => [
				AttributeName::SRC,
				'img.jpg',
				'src="img.jpg"',
			],
			'use custom name' => [
				CustomElementAttributeName::factory('sandwich'),
				'ham',
				'sandwich="ham"',
			],
			'use extends ElementAttributeName' => (function(): array {
				return [
					new class () implements ElementAttributeName {
						public function name() : string {
							return 'starship';
						}
					},
					'enterprise',
					'starship="enterprise"',
					];
			})(),
			'value containing a tag' => [
				AttributeName::NAME,
				'<div>some content</div>',
				'name="&lt;div&gt;some content&lt;/div&gt;"',
			],
			'do not double-encode' => [
				AttributeName::SPAN,
				'me &amp; you',
				'span="me &amp; you"',
			],
			'Stringable value' => [
				AttributeName::CITE,
				new class implements \Stringable {
					public function __toString(): string {
						return 'socrates & "so crates"';
					}
				},
				'cite="socrates &amp; &quot;so crates&quot;"',
			],
			'Serializable value' => [
				AttributeName::DATA,
				new class implements \JsonSerializable {
					public function jsonSerialize(): mixed {
						return [
							'ships' => [
								'cerritos',
								'enterprise',
							]
						];
					}
				},
				'data="{&quot;ships&quot;:[&quot;cerritos&quot;,&quot;enterprise&quot;]}"',
			],
			'boolean' => [
				AttributeName::DISABLED,
				null,
				'disabled',
			]
		];
	}

	#[DataProvider( 'provide_creation_and_stringability' )]
	public function test_creation_and_stringability( ElementAttributeName $name, int|float|string|null|\Stringable|\JsonSerializable $value, string $expected): void {
		$attr = Attribute::factory($name, $value);
		self::assertSame($expected, (string) $attr);
		self::assertSame($expected, $attr->build());
	}

	public function test_json_error_handling(): void {
		$caughtWarning = null;

		set_error_handler(
			static function(int $errno, string $errstr) use (&$caughtWarning): bool {
				if ($errno === E_USER_WARNING) {
					$caughtWarning = $errstr;
					return true; // handled
				}
				return false;
			}
		);

		try {
			$attr = Attribute::factory(
				AttributeName::DATA,
				new class implements \JsonSerializable {
					public function jsonSerialize(): mixed {
						// Malformed UTF-8 -> json_encode(JSON_THROW_ON_ERROR) throws JsonException.
						return "\xB1\x31";
					}
				}
			);

			$this->assertSame('', $attr->build());
			$this->assertIsString($caughtWarning);
			$this->assertStringContainsString('Failed to encode attribute value:', (string) $caughtWarning);
		} finally {
			restore_error_handler();
		}
	}

	public function test_is_equivalent(): void {
		$attr1 = Attribute::factory(AttributeName::SRC, 'img.jpg');
		$attr2 = Attribute::factory(AttributeName::SRC, 'img.jpg');
		$attr3 = Attribute::factory(AttributeName::SRC, 'frog.jpg');
		$this->assertTrue($attr1->is_equivalent($attr2));
		$this->assertFalse($attr1->is_equivalent($attr3));
		$this->assertTrue($attr2->is_equivalent($attr1));
		$this->assertFalse($attr3->is_equivalent($attr1));
	}

	public function test_is_same(): void {
		$attr1 = Attribute::factory(AttributeName::SRC, 'img.jpg');
		$attr2 = Attribute::factory(AttributeName::SRC, 'img.jpg');
		$this->assertFalse($attr1->is_same($attr2));
		$this->assertFalse($attr2->is_same($attr1));
		$this->assertTrue($attr1->is_same($attr1));
	}

}
