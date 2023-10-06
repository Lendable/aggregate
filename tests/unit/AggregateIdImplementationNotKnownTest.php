<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use PHPUnit\Framework\Attributes\Test;
use Lendable\Aggregate\AggregateIdImplementationNotKnown;
use Lendable\Aggregate\AggregateType;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(AggregateIdImplementationNotKnown::class)]
final class AggregateIdImplementationNotKnownTest extends TestCase
{
    #[Test]
    public function constructs_with_a_formatted_message_from_input(): void
    {
        $exception = AggregateIdImplementationNotKnown::forAggregateType(AggregateType::fromString('foo'));

        $this->assertSame('Aggregate id implementation is not known for aggregate type "foo".', $exception->getMessage());
    }
}
