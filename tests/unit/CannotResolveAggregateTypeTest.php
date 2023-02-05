<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Lendable\Aggregate\CannotResolveAggregateType;

#[CoversClass(CannotResolveAggregateType::class)]
final class CannotResolveAggregateTypeTest extends ExceptionTestCase
{
    #[DataProvider('providePossibleCausesAndPreviousExceptions')]
    #[Test]
    public function constructs_with_a_formatted_message_from_input(string $cause, ?\Throwable $previous): void
    {
        $aggregateRoot = new \stdClass();
        $fixture = CannotResolveAggregateType::of($aggregateRoot, $cause, $previous);

        $this->assertSame($this->createExpectedExceptionMessage($aggregateRoot, $cause), $fixture->getMessage());
        $this->assertSame(0, $fixture->getCode());
        $this->assertSame($previous, $fixture->getPrevious());
    }

    private function createExpectedExceptionMessage(object $aggregateRoot, string $cause): string
    {
        return \sprintf(
            'Cannot resolve an aggregate type for aggregate root %s<%s>.',
            $aggregateRoot::class,
            \spl_object_hash($aggregateRoot)
        ).($cause === '' ? '' : ' '.$cause);
    }
}
