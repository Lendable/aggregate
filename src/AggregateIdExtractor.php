<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

/**
 * Extracts an AggregateId that identifies a given aggregate instance.
 *
 * @phpstan-template TAggregate of object
 */
interface AggregateIdExtractor
{
    /**
     * @phpstan-param TAggregate $aggregate
     *
     * @throws CannotExtractAggregateId
     */
    public function extract(object $aggregate): AggregateId;
}
