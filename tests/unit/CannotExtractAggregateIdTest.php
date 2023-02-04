<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Lendable\Aggregate\CannotExtractAggregateId;

#[CoversClass(CannotExtractAggregateId::class)]
final class CannotExtractAggregateIdTest extends ExceptionTestCase
{
    #[DataProvider('providePossibleCausesAndPreviousExceptions')]
    #[Test]
    public function it_constructs_as_expected(string $cause, ?\Throwable $previous): void
    {
        $aggregateRoot = new \stdClass();
        $fixture = CannotExtractAggregateId::from($aggregateRoot, $cause, $previous);

        $this->assertSame($this->createExpectedExceptionMessage($aggregateRoot, $cause), $fixture->getMessage());
        $this->assertSame(0, $fixture->getCode());
        $this->assertSame($previous, $fixture->getPrevious());
    }

    private function createExpectedExceptionMessage(object $aggregateRoot, string $cause): string
    {
        return \sprintf(
            'Cannot extract an aggregate id from aggregate root %s<%s>.',
            $aggregateRoot::class,
            \spl_object_hash($aggregateRoot)
        ).($cause === '' ? '' : ' '.$cause);
    }
}
