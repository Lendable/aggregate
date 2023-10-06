<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @mixin AggregateId
 */
trait UuidAggregateIdTrait
{
    abstract public static function generate(): static;

    private function __construct(protected readonly UuidInterface $uuid)
    {
        $this->validate($uuid);
    }

    /**
     * @throws \InvalidArgumentException If the UUID is the wrong version.
     */
    abstract protected function validate(UuidInterface $uuid): void;

    public static function fromString(string $uuid): static
    {
        return new static(Uuid::fromString($uuid));
    }

    public static function fromBinary(string $binaryUuid): static
    {
        return new static(Uuid::fromBytes($binaryUuid));
    }

    public static function fromUuid(UuidInterface $uuid): static
    {
        return new static($uuid);
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
        return $other instanceof $this
            && $this->uuid->equals($other->uuid);
    }
}
