<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Assert\Assertion;

/**
 * @phpstan-template TAggregateRoot of object
 *
 * @template-implements AggregateTypeResolver<TAggregateRoot>
 */
final class MapAggregateTypeResolver implements AggregateTypeResolver
{
    /**
     * @param array<class-string<TAggregateRoot>, AggregateType> $map
     */
    public function __construct(private readonly array $map)
    {
        Assertion::allClassExists(\array_keys($map), 'All map keys must be class names that exist, %s does not exist.');
        Assertion::allIsInstanceOf($map, AggregateType::class, 'All map values must be instances of '.AggregateType::class.', %s is not.');
    }

    public function resolve(object $aggregate): AggregateType
    {
        return $this->map[$aggregate::class] ?? throw CannotResolveAggregateType::of($aggregate, 'Class is not mapped');
    }
}
