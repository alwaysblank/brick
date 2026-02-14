<?php

namespace AlwaysBlank\Brick\Interface;

use Stringable;

interface HasContent {
	/**
	 * @return list<Stringable>
	 */
	public function get_content(): array;

	/**
	 * @param list<Stringable> $content
	 *
	 * @return static
	 */
	public function replace_content(array $content): static;
}
