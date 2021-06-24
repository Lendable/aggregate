<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

/**
 * @phpstan-template T of object
 * @template-implements AggregateTypeResolver<T>
 */
final class ClosureAggregateTypeResolver implements AggregateTypeResolver
{
    /**
     * @phpstan-var \Closure(T): AggregateType
     */
    private \Closure $closure;

    /**
     * @phpstan-param \Closure(T): AggregateType $closure
     */
    public function __construct(\Closure $closure)
    {
        $this->closure = $closure;
    }

    /**
     * @phpstan-param T $aggregate
     */
    public function resolve(object $aggregate): AggregateType
    {
        try {
            return ($this->closure)($aggregate);
        } catch (CannotResolveAggregateType $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            throw CannotResolveAggregateType::of($aggregate, 'Uncaught exception in closure, see parent.', $exception);
        }
    }
}
