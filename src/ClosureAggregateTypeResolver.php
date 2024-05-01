<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

/**
 * @phpstan-template T of object
 * @template-implements AggregateTypeResolver<T>
 */
final readonly class ClosureAggregateTypeResolver implements AggregateTypeResolver
{
    /**
     * @phpstan-param \Closure(T): AggregateType $closure
     */
    public function __construct(private \Closure $closure) {}

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
