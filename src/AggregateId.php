<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Universally unique identifier for an aggregate.
 */
final class AggregateId
{
    private function __construct(private readonly UuidInterface $uuid)
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

    public static function generate(): self
    {
        return new self(Uuid::uuid4());
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public function toBinary(): string
    {
        return $this->uuid->getBytes();
    }

    public function equals(self $other): bool
    {
        return $this->uuid->equals($other->uuid);
    }
}
