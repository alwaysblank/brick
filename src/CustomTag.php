<?php

namespace AlwaysBlank\Brick;

use AlwaysBlank\Brick\Interface\IsTag;

readonly class CustomTag implements IsTag, \Stringable {
	protected string $tag;

	protected function __construct(string $tag, protected bool $is_void = false) {
		$tag = strtolower($tag);
		if ( 3 > strlen($tag) || ! ctype_alpha( $tag[0] ) || ! str_contains($tag, '-')) {
			throw new \InvalidArgumentException('Invalid tag name: ' . $tag);
		}
		$this->tag = $tag;
	}

	/**
	 * @inheritDoc
	 */
	public function is_void() : bool {
		return $this->is_void;
	}

	public function tag() : string {
		return $this->tag;
	}

	public static function factory(string $tag, bool $is_void = false) : static {
		return new static($tag, $is_void);
	}

	public function __toString() : string {
		return $this->tag;
	}
}
