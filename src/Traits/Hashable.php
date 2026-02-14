<?php

namespace AlwaysBlank\Brick\Traits;

trait Hashable {
	/**
	 * Cached hash of this item.
	 *
	 * @var string $hash
	 */
	private string $hash;

	/**
	 * @inheritDoc
	 *
	 * @throws \InvalidArgumentException If an error occurs while attempting to encode this object.
	 */
	public function hash(): string {
		try {
			return $this->hash ??= md5( json_encode( $this, JSON_THROW_ON_ERROR ) );
		} catch (\JsonException $e) {
			throw new \InvalidArgumentException( "Fatal error while attempting to hash this object: {$e->getMessage()}", 0, $e);
		}
	}
}
