<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

/**
 * Extracts an AggregateVersion from a given aggregate instance.
 *
 * @phpstan-template TAggregate of object
 */
interface AggregateVersionExtractor
{
    /**
     * @phpstan-param TAggregate $aggregate
     */
    public function extract(object $aggregate): AggregateVersion;
}
