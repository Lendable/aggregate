<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Lendable\Aggregate\AggregateType;
use PHPUnit\Framework\TestCase;

#[CoversClass(AggregateType::class)]
final class AggregateTypeTest extends TestCase
{
    #[Test]
    public function constructable_with_a_non_empty_string(): void
    {
        $fixture = AggregateType::fromString('foobar');

        $this->assertSame('foobar', $fixture->toString());
    }

    #[Test]
    public function throws_if_constructed_with_an_empty_string(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Aggregate type cannot be empty.');

        AggregateType::fromString('');
    }

    #[Test]
    public function only_equals_other_instances_with_equal_value(): void
    {
        $type = AggregateType::fromString('foo');
        $typeSameValue = AggregateType::fromString('foo');
        $otherType = AggregateType::fromString('bar');

        $this->assertTrue($type->equals($type));
        $this->assertTrue($otherType->equals($otherType));
        $this->assertTrue($type->equals($typeSameValue));
        $this->assertTrue($typeSameValue->equals($type));
        $this->assertFalse($type->equals($otherType));
        $this->assertFalse($otherType->equals($type));
    }
}
