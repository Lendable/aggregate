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
        $this->assertSame(2, AggregateVersion::fromInteger(1)->next()->toInteger());
    }
}
