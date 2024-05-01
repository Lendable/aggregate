<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

/**
 * @phpstan-template T of object
 * @template-implements AggregateVersionExtractor<T>
 */
final readonly class ClosureAggregateVersionExtractor implements AggregateVersionExtractor
{
    /**
     * @phpstan-param \Closure(T): AggregateVersion $closure
     */
    public function __construct(private \Closure $closure) {}

    /**
     * @phpstan-param T $aggregate
     */
    public function extract(object $aggregate): AggregateVersion
    {
        return ($this->closure)($aggregate);
    }
}
