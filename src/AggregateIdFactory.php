<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Ramsey\Uuid\UuidInterface;

final class AggregateIdFactory
{
    /**
     * @param array<non-empty-string, class-string<AggregateId>> $map
     */
    public function __construct(private readonly array $map)
    {
    }

    /**
     * @throws AggregateIdImplementationNotKnown
     */
    public function fromUuid(AggregateType $aggregateType, UuidInterface $value): AggregateId
    {
        return $this->aggregateIdClass($aggregateType)::fromUuid($value);
    }

    /**
     * @param non-empty-string $value
     *
     * @throws AggregateIdImplementationNotKnown
     */
    public function fromBinary(AggregateType $aggregateType, string $value): AggregateId
    {
        return $this->aggregateIdClass($aggregateType)::fromBinary($value);
    }

    /**
     * @param non-empty-string $value
     *
     * @throws AggregateIdImplementationNotKnown
     */
    public function fromString(AggregateType $aggregateType, string $value): AggregateId
    {
        return $this->aggregateIdClass($aggregateType)::fromString($value);
    }

    /**
     * @return class-string<AggregateId>
     *
     * @throws AggregateIdImplementationNotKnown
     */
    private function aggregateIdClass(AggregateType $aggregateType): string
    {
        return $this->map[$aggregateType->toString()]
            ?? throw AggregateIdImplementationNotKnown::forAggregateType($aggregateType);
    }
}
