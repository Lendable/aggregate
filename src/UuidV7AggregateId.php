<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

/**
 * Universally unique identifier for an aggregate.
 */
final class UuidV7AggregateId implements AggregateId
{
    use UuidV7AggregateIdTrait;
}
