<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Ramsey\Uuid\UuidInterface;

/**
 * Universally unique identifier for an aggregate.
 */
interface AggregateId
{
    public static function fromString(string $uuid): self;

    public static function fromBinary(string $binaryUuid): self;

    public static function fromUuid(UuidInterface $uuid): self;

    public static function generate(): self;

    public function toString(): string;

    public function toBinary(): string;

    public function equals(self $other): bool;
}
