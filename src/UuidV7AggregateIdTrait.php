<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Ramsey\Uuid\Uuid;

/**
 * @mixin AggregateId
 */
trait UuidV7AggregateIdTrait
{
    use UuidAggregateIdTrait;

    public static function generate(): static
    {
        return new self(Uuid::uuid7());
    }
}
