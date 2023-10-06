<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

final class AggregateIdImplementationNotKnown extends \InvalidArgumentException
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function forAggregateType(AggregateType $aggregateType): self
    {
        return new self(
            \sprintf('Aggregate id implementation is not known for aggregate type "%s".', $aggregateType->toString())
        );
    }
}
