<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Ramsey\Uuid\UuidInterface;

final readonly class AggregateIdFactory
{
    /**
     * @param non-empty-array<non-empty-string, class-string<AggregateId>> $map
     *
     * @throws \InvalidArgumentException If the map is empty.
     */
    public function __construct(private array $map)
    {
        if ($map === []) {
            throw new \InvalidArgumentException('Map cannot be empty.');
        }
    }

    /**
     * @throws AggregateIdImplementationNotKnown If the aggregate type is not mapped.
     */
    public function fromUuid(AggregateType $aggregateType, UuidInterface $value): AggregateId
    {
        return $this->aggregateIdClass($aggregateType)::fromUuid($value);
    }

    /**
     * @param non-empty-string $value
     *
     * @throws AggregateIdImplementationNotKnown If the aggregate type is not mapped.
     */
    public function fromBinary(AggregateType $aggregateType, string $value): AggregateId
    {
        return $this->aggregateIdClass($aggregateType)::fromBinary($value);
    }

    /**
     * @param non-empty-string $value
     *
     * @throws AggregateIdImplementationNotKnown If the aggregate type is not mapped.
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
