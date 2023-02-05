<?php

declare(strict_types=1);

namespace Lendable\Aggregate\Testing;

use Lendable\Aggregate\AggregateType;
use Lendable\Aggregate\AggregateTypeResolver;
use PHPUnit\Framework\TestCase;

/**
 * @phpstan-template T of object
 */
abstract class AggregateTypeResolverSpec extends TestCase
{
    use ValueObjectAssertions;

    /**
     * @phpstan-return AggregateTypeResolver<T>
     */
    abstract protected function createResolver(): AggregateTypeResolver;

    abstract protected function createExpectedAggregateType(): AggregateType;

    /**
     * @phpstan-return T
     */
    abstract protected function createAggregateWithExpectedAggregateType(): object;

    final public function test_resolves_an_aggregate_type_for_a_supported_aggregate(): void
    {
        $resolver = $this->createResolver();
        $aggregate = $this->createAggregateWithExpectedAggregateType();
        $expectedAggregateType = $this->createExpectedAggregateType();
        $resolvedAggregateType = $resolver->resolve($aggregate);

        $this->assertAggregateTypeEquals($expectedAggregateType, $resolvedAggregateType);
    }
}
