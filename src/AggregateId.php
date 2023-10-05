<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Ramsey\Uuid\UuidInterface;

/**
 * Universally unique identifier for an aggregate.
 */
interface AggregateId
{
    public static function fromString(string $uuid): static;

    public static function fromBinary(string $binaryUuid): static;

    public static function fromUuid(UuidInterface $uuid): static;

    public static function generate(): static;

    public function toString(): string;

    public function toBinary(): string;

    public function equals(self $other): bool;
}
