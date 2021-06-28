<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

/**
 * @phpstan-template T of object
 * @template-implements AggregateVersionExtractor<T>
 */
final class ClosureAggregateVersionExtractor implements AggregateVersionExtractor
{
    /**
     * @phpstan-var \Closure(T): AggregateVersion
     */
    private \Closure $closure;

    /**
     * @phpstan-param \Closure(T): AggregateVersion $closure
     */
    public function __construct(\Closure $closure)
    {
        $this->closure = $closure;
    }

    /**
     * @phpstan-param T $aggregate
     */
    public function extract(object $aggregate): AggregateVersion
    {
        return ($this->closure)($aggregate);
    }
}
