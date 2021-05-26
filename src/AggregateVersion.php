<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Assert\Assertion;
use Assert\AssertionFailedException;

/**
 * The version of an aggregate.
 *
 * An aggregates version changes every time its state changes.
 */
final class AggregateVersion
{
    private int $version;

    /**
     * @throws AssertionFailedException If the version is <= 0.
     */
    private function __construct(int $version)
    {
        Assertion::greaterOrEqualThan($version, 1, 'Aggregate version must be >= 1.');

        $this->version = $version;
    }

    /**
     * @throws AssertionFailedException If the version is <= 0.
     */
    public static function fromInteger(int $version): self
    {
        return new self($version);
    }

    public function toInteger(): int
    {
        return $this->version;
    }

    public function next(): AggregateVersion
    {
        return self::fromInteger($this->version + 1);
    }

    public function equals(self $other): bool
    {
        return $this->version === $other->version;
    }
}
