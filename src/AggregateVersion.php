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
    /**
     * @var int<1, max>
     */
    private int $version;

    /**
     * @throws \InvalidArgumentException If the version is <= 0.
     */
    private function __construct(int $version)
    {
        if ($version <= 0) {
            throw new \InvalidArgumentException(\sprintf('Aggregate version must be >= 1, %d given.', $version));
        }

        $this->version = $version;
    }

    /**
     * @throws \InvalidArgumentException If the version is <= 0.
     */
    public static function fromInteger(int $version): self
    {
        return new self($version);
    }

    /**
     * @return int<1, max>
     */
    public function toInteger(): int
    {
        return $this->version;
    }

    public function next(): AggregateVersion
    {
        $instance = clone $this;
        $instance->version++;

        return $instance;
    }

    public function equals(self $other): bool
    {
        return $this->version === $other->version;
    }

    public function before(self $other): bool
    {
        return $this->version < $other->version;
    }

    public function beforeOrEquals(self $other): bool
    {
        return $this->version <= $other->version;
    }

    public function after(self $other): bool
    {
        return $this->version > $other->version;
    }

    public function afterOrEquals(self $other): bool
    {
        return $this->version >= $other->version;
    }
}
