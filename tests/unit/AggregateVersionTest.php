<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use Lendable\Aggregate\AggregateVersion;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Lendable\Aggregate\AggregateVersion
 */
final class AggregateVersionTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_constructed_from_an_integer_that_is_greater_than_or_equal_to_1(): void
    {
        $fixture = AggregateVersion::fromInteger(1);

        $this->assertSame(1, $fixture->toInteger());
    }

    /**
     * @return iterable<string, array<int, mixed>>
     */
    public function provideNegativeIntegerSet(): iterable
    {
        yield '0' => [0];
        yield '-1' => [-1];
        yield '-PHP_INT_MAX' => [-\PHP_INT_MAX];
    }

    /**
     * @test
     * @dataProvider provideNegativeIntegerSet
     */
    public function it_throws_when_constructing_from_integer_less_than_one(int $lessThanOne): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Aggregate version must be >= 1.');

        AggregateVersion::fromInteger($lessThanOne);
    }

    /**
     * @test
     */
    public function it_can_provide_the_next_aggregate_version_that_follows_it(): void
    {
        $v1 = AggregateVersion::fromInteger(1);
        $this->assertSame(2, $v1->next()->toInteger());
        $this->assertSame(1, $v1->toInteger());
    }

    /**
     * @test
     */
    public function it_can_be_compare_with_other_versions_for_order(): void
    {
        $one = AggregateVersion::fromInteger(1);
        $two = AggregateVersion::fromInteger(2);
        $three = AggregateVersion::fromInteger(3);

        $this->assertTrue($one->before($two));
        $this->assertTrue($one->before($three));
        $this->assertFalse($two->before($one));
        $this->assertFalse($two->before($two));
        $this->assertTrue($two->before($three));
        $this->assertFalse($three->before($one));
        $this->assertFalse($three->before($two));
        $this->assertFalse($three->before($three));

        $this->assertFalse($one->after($one));
        $this->assertFalse($one->after($two));
        $this->assertFalse($one->after($three));
        $this->assertTrue($two->after($one));
        $this->assertFalse($two->after($two));
        $this->assertFalse($two->after($three));
        $this->assertTrue($three->after($one));
        $this->assertTrue($three->after($two));
        $this->assertFalse($three->after($three));

        $this->assertTrue($one->beforeOrEquals($one));
        $this->assertTrue($one->beforeOrEquals($two));
        $this->assertTrue($one->beforeOrEquals($three));
        $this->assertTrue($one->afterOrEquals($one));
        $this->assertFalse($one->afterOrEquals($two));
        $this->assertFalse($one->afterOrEquals($three));
    }

    /**
     * @test
     */
    public function it_equals_other_versions_of_the_same_value(): void
    {
        $instance = AggregateVersion::fromInteger(1);
        $sameValue = AggregateVersion::fromInteger(1);
        $differentValue = AggregateVersion::fromInteger(2);

        $this->assertTrue($instance->equals($sameValue));
        $this->assertTrue($sameValue->equals($instance));
        $this->assertFalse($instance->equals($differentValue));
        $this->assertFalse($differentValue->equals($instance));
    }
}
