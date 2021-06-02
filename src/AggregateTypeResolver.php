<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

/**
 * Resolves the type of supported aggregates.
 *
 * @phpstan-template TAggregateRoot of object
 */
interface AggregateTypeResolver
{
    /**
     * @phpstan-param TAggregateRoot $aggregate
     *
     * @throws CannotResolveAggregateType
     */
    public function resolve(object $aggregate): AggregateType;
}
