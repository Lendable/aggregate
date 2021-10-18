<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use Lendable\Aggregate\CannotExtractAggregateId;

/**
 * @covers \Lendable\Aggregate\CannotExtractAggregateId
 */
final class CannotExtractAggregateIdTest extends ExceptionTest
{
    /**
     * @test
     * @dataProvider providePossibleCausesAndPreviousExceptions
     */
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
