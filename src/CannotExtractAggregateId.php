<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

/**
 * @phpstan-template TAggregateRoot of object
 */
final class CannotExtractAggregateId extends \RuntimeException
{
    /**
     * @phpstan-param TAggregateRoot $aggregateRoot
     */
    private function __construct(object $aggregateRoot, string $cause = '', ?\Throwable $previous = null)
    {
        parent::__construct(
            \sprintf(
                'Cannot extract an aggregate id from aggregate root %s<%s>.',
                $aggregateRoot::class,
                \spl_object_hash($aggregateRoot)
            ).($cause === '' ? '' : ' '.$cause),
            0,
            $previous
        );
    }

    /**
     * @phpstan-param TAggregateRoot $aggregateRoot
     *
     * @phpstan-return self<TAggregateRoot>
     */
    public static function from(object $aggregateRoot, string $cause = '', ?\Throwable $previous = null): self
    {
        return new self($aggregateRoot, $cause, $previous);
    }
}
