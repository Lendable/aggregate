<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Ramsey\Uuid\Uuid;

/**
 * Universally unique identifier for an aggregate.
 */
trait UuidV7AggregateIdTrait
{
    use UuidAggregateIdTrait;

    public static function generate(): self
    {
        return new self(Uuid::uuid7());
    }
}
