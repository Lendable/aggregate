<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use Lendable\Aggregate\AggregateType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Lendable\Aggregate\AggregateType
 */
final class AggregateTypeTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_be_constructed_with_a_valid_type_string(): void
    {
        $fixture = AggregateType::fromString('foobar');

        $this->assertSame('foobar', $fixture->toString());
    }

    /**
     * @test
     */
    public function it_throws_if_constructed_with_an_empty_type_string(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Aggregate type cannot be empty.');

        AggregateType::fromString('');
    }
}
