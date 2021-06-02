<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

/**
 * @phpstan-template TAggregate of object
 */
interface AggregateVersionExtractor
{
    /**
     * @phpstan-param TAggregate $aggregate
     */
    public function extract(object $aggregate): AggregateVersion;
}
