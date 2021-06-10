<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

/**
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
