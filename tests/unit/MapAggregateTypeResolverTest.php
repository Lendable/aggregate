<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use Lendable\Aggregate\AggregateType;
use Lendable\Aggregate\MapAggregateTypeResolver;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Lendable\Aggregate\MapAggregateTypeResolver
 */
final class MapAggregateTypeResolverTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_resolve_an_aggregate_type_for_a_mapped_aggregate_root(): void
    {
        $fixture = new MapAggregateTypeResolver([\stdClass::class => AggregateType::fromString('foo')]);

        $this->assertSame('foo', $fixture->resolve(new \stdClass())->toString());
    }
}
