<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

/**
 * @phpstan-template TAggregateRoot of object
 *
 * @template-implements AggregateTypeResolver<TAggregateRoot>
 */
final readonly class MapAggregateTypeResolver implements AggregateTypeResolver
{
    /**
     * @param array<class-string<TAggregateRoot>, AggregateType> $map
     */
    public function __construct(private array $map) {}

    public function resolve(object $aggregate): AggregateType
    {
        return $this->map[$aggregate::class] ?? throw CannotResolveAggregateType::of($aggregate, 'Class is not mapped');
    }
}
