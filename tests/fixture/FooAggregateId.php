<?php

declare(strict_types=1);

namespace Tests\Fixture\Lendable\Aggregate;

use Lendable\Aggregate\AggregateId;
use Lendable\Aggregate\UuidAggregateIdTrait;
use Ramsey\Uuid\Uuid;

final class FooAggregateId implements AggregateId
{
    use UuidAggregateIdTrait;

    public static function generate(): static
    {
        return new self(Uuid::uuid4());
    }
}
