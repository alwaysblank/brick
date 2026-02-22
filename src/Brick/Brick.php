<?php

namespace AlwaysBlank\Brick\Brick;

use AlwaysBlank\Brick\{Interface\ElementAttributeName,
	Tag\AttributeName,
	Tag\CustomElementAttributeName,
	Tag\CustomTag,
	Tag\Tag};
use JSONSerializable;
use function AlwaysBlank\Brick\is_attribute_array;
use function AlwaysBlank\Brick\is_element_array;
use function AlwaysBlank\Brick\is_scalar_value;

/**
 * @method static Element a( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element abbr( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element address( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element area( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element article( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element aside( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element audio( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element b( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element base( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element bdi( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element bdo( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element blockquote( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element body( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element br( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element button( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element canvas( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element caption( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element cite( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element code( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element col( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element colgroup( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element data( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element datalist( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element dd( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element del( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element details( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element dfn( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element dialog( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element div( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element dl( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element dt( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element em( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element embed( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element fieldset( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element figcaption( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element figure( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element footer( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element form( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element h1( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element h2( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element h3( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element h4( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element h5( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element h6( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element head( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element header( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element hgroup( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element hr( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element html( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element i( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element iframe( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element img( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element input( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element ins( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element kbd( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element label( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element legend( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element li( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element link( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element main( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element map( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element mark( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element menu( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element meta( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element meter( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element nav( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element noscript( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element object( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element ol( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element optgroup( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element option( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element output( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element p( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element picture( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element pre( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element progress( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element q( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element rp( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element rt( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element ruby( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element s( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element samp( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element script( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element search( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element section( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element select( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element small( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element source( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element span( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element strong( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element style( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element sub( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element summary( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element sup( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element table( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element tbody( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element td( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element template( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element textarea( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element tfoot( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element th( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element thead( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element time( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element title( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element tr( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element track( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element u( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element ul( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element var( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element video( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 * @method static Element wbr( Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue ...$arguments )
 */
class Brick {
	/**
	 * Create an {@see Element} with the tag of `$name`.
	 *
	 * @param string $name
	 * @param array<Element|Scalar|Attribute|ElementArray|AttributeArray|ScalarValue> $arguments
	 *
	 * @return Element
	 */
	public static function __callStatic( string $name, array $arguments ): Element {
		// Determine tag.
		$tag = Tag::tryFrom(strtolower($name));
		if (!$tag instanceof Tag) {
			$tag = CustomTag::factory($name);
		}

		// Determine content.
		$content = array_filter(array_map( function(mixed $c) use ($arguments) {
			if($c instanceof Element || $c instanceof Scalar) {
				return $c;
			}
			if(is_scalar_value($c)) {
				if (count($arguments[1]) ===1) {
					// If this is the *only* scalar, then it doesn't need a span.
					return Scalar::factory($c);
				}

				// It's very unlikely the user wants these as a set of imploded strings, so be nice and wrap them in spans.
				return Element::factory(Tag::SPAN, [Scalar::factory($c)]);
			}
			if (is_element_array($c)) {
				return Element::factory(...$c);
			}
			return null; // Unsupported.
		}, $arguments[1] ?? []));

		// Determine attributes.
		$attributes = array_filter(array_map( function(mixed $a) use ($arguments) {
			if ($a instanceof Attribute) {
				return $a;
			}
			if (is_string($a)) {
				$attribute = AttributeName::tryFrom(strtolower($a));
				if (null === $attribute) {
					$attribute = CustomElementAttributeName::factory($a);
				}
				return Attribute::factory($attribute);
			}
			if (is_array($a) && isset($a[0])) {
				$attribute = AttributeName::tryFrom(strtolower($a[0]));
				if (null === $attribute) {
					$attribute = CustomElementAttributeName::factory($a[0]);
				}
				return Attribute::factory($attribute, $a[1] ?? null);
			}
			return null;
		}, $arguments[2] ?? []));

		return Element::factory($tag, $content, $attributes);
	}

	/**
	 * Create an {@see ElementAttributeName}.
	 */
	public static function attr(ElementAttributeName $name, float|int|JsonSerializable|\Stringable|string|null $value = null): Attribute {
		return Attribute::factory($name, $value);
	}

	/**
	 * Create a {@see Scalar}.
	 */
	public static function sclr(int|float|string|bool ...$str): Scalar {
		return Scalar::factory(...$str);
	}
}
