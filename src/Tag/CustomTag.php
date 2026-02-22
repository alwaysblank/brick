<?php

namespace AlwaysBlank\Brick\Tag;

use AlwaysBlank\Brick\Interface\ElementTag;

readonly class CustomTag implements ElementTag {
	protected string $tag;

	final protected function __construct(string $tag, protected bool $is_void = false) {
		$this->tag = strtolower($tag);
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
}
