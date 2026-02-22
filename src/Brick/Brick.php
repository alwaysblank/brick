<?php

namespace AlwaysBlank\Brick\Brick;

use JsonSerializable;
use AlwaysBlank\Brick\{Tag\CustomTag, Tag\Tag};
use Stringable;

/**
 * @method static Element a( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element abbr( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element address( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element area( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element article( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element aside( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element audio( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element b( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element base( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element bdi( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element bdo( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element blockquote( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element body( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element br( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element button( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element canvas( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element caption( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element cite( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element code( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element col( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element colgroup( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element data( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element datalist( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element dd( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element del( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element details( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element dfn( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element dialog( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element div( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element dl( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element dt( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element em( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element embed( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element fieldset( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element figcaption( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element figure( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element footer( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element form( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element h1( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element h2( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element h3( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element h4( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element h5( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element h6( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element head( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element header( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element hgroup( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element hr( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element html( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element i( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element iframe( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element img( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element input( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element ins( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element kbd( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element label( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element legend( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element li( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element link( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element main( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element map( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element mark( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element menu( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element meta( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element meter( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element nav( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element noscript( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element object( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element ol( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element optgroup( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element option( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element output( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element p( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element picture( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element pre( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element progress( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element q( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element rp( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element rt( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element ruby( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element s( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element samp( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element script( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element search( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element section( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element select( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element small( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element source( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element span( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element strong( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element style( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element sub( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element summary( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element sup( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element table( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element tbody( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element td( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element template( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element textarea( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element tfoot( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element th( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element thead( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element time( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element title( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element tr( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element track( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element u( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element ul( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element var( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element video( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 * @method static Element wbr( array<int|float|string|bool|array<mixed>|Stringable> $content = [], array<Attribute> $attributes = [] )
 */
class Brick {
	/**
	 * Create an {@see Element} with the tag of `$name`.
	 *
	 * @param string $name
	 * @param array<mixed> $arguments
	 *
	 * @return Element
	 */
	public static function __callStatic( string $name, array $arguments ): Element {
		$tag_name = strtolower($name);
		$tag = Tag::tryFrom($name);
		if (!$tag instanceof Tag) {
			$tag = CustomTag::factory($tag_name);
		}
		$content = $arguments[0] ?? [];
		if (!is_array($content)) {
			$content = [$content];
		}
		$content = array_map(function(mixed $c) {
			if (Scalar::is_scalar($c)) {
				// It's very unlikely the user wants these as a set of imploded strings, so be nice and wrap them in spans.
				return Element::factory(Tag::SPAN, [Scalar::factory($c)]);
			}
			if (Element::is_element($c)) {
				return Element::factory(...$c);
			}
			return $c;
		}, $content);
		$content = array_values(array_filter($content, fn($el) => $el instanceof Stringable));
		$attributes = $arguments[1] ?? [];
		if (!is_array($attributes)) {
			$attributes = [$attributes];
		}
		$attributes = array_values(array_filter($attributes, fn($el) => $el instanceof Attribute));
		return Element::factory($tag, $content, $attributes);
	}

	/**
	 * Create an {@see Attribute}.
	 */
	public static function attr(string $name, float|int|JsonSerializable|string|null $value = null): Attribute {
		return Attribute::factory($name, $value);
	}

	/**
	 * Create a {@see Scalar}.
	 */
	public static function str(int|float|string|bool ...$str): Scalar {
		return Scalar::factory(...$str);
	}
}
