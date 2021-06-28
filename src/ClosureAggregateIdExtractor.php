<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

/**
 * @phpstan-template T of object
 * @template-implements AggregateIdExtractor<T>
 */
final class ClosureAggregateIdExtractor implements AggregateIdExtractor
{
    /**
     * @phpstan-var \Closure(T): AggregateId
     */
    private \Closure $closure;

    /**
     * @phpstan-param \Closure(T): AggregateId $closure
     */
    public function __construct(\Closure $closure)
    {
        $this->closure = $closure;
    }

    /**
     * @phpstan-param T $aggregate
     */
    public function extract(object $aggregate): AggregateId
    {
        try {
            return ($this->closure)($aggregate);
        } catch (CannotExtractAggregateId $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            throw CannotExtractAggregateId::from($aggregate, 'Uncaught exception in closure, see parent.', $exception);
        }
    }
}
