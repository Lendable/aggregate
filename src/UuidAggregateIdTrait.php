<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Universally unique identifier for an aggregate.
 */
trait UuidAggregateIdTrait
{
    abstract public static function generate(): self;

    private function __construct(protected readonly UuidInterface $uuid)
    {
    }

    public static function fromString(string $uuid): self
    {
        return new self(Uuid::fromString($uuid));
    }

    public static function fromBinary(string $binaryUuid): self
    {
        return new self(Uuid::fromBytes($binaryUuid));
    }

    public static function fromUuid(UuidInterface $uuid): self
    {
        return new self($uuid);
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public function toBinary(): string
    {
        return $this->uuid->getBytes();
    }

    public function equals(AggregateId $other): bool
    {
        return $this->uuid->toString() === $other->toString();
    }
}
