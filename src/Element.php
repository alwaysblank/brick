<?php

namespace AlwaysBlank\Brick;

use AlwaysBlank\Brick\Interface\IsTag;

readonly class Element extends Brick {

	/**
	 * @var \AlwaysBlank\Brick\Brick[] $bricks
	 */
	public array $bricks;

	protected function __construct( public IsTag $tag, Brick ...$bricks ) {
		$this->bricks = $bricks;
	}

	public function render(): string {
		$attributes = [];
		$content = [];
		foreach ( $this->bricks as $brick ) {
			if ( $brick instanceof Attribute ) {
				$attributes[] = $brick;
			} else {
				$content[] = $brick;
			}
		}
		if ($this->tag->is_void()) {
			return sprintf( '<%s %s>', $this->tag->tag(), implode( ' ', $attributes ) );
		}
		return sprintf(
			'<%1$s%2$s>%3$s</%1$s>',
			$this->tag->tag(),
			count( $attributes ) > 0 ? sprintf(' %s', implode( ' ', $attributes )) : '',
			implode( '', $content )
		);
	}

	public function add(Brick ...$bricks): static {
		return new static(...$this, ...$bricks);
	}

	public static function factory( IsTag $tag, Brick ...$bricks ): static {
		return new static( $tag, ...$bricks );
	}

	protected function __toArray() : array {
		return [$this->tag, ...$this->bricks];
	}
}
