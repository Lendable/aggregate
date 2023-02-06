<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Lendable\Aggregate\AggregateType;
use Lendable\Aggregate\CannotResolveAggregateType;
use Lendable\Aggregate\MapAggregateTypeResolver;
use PHPUnit\Framework\TestCase;

#[CoversClass(MapAggregateTypeResolver::class)]
final class MapAggregateTypeResolverTest extends TestCase
{
    #[Test]
    public function it_can_resolve_an_aggregate_type_for_a_mapped_aggregate_root(): void
    {
        $fixture = new MapAggregateTypeResolver([\stdClass::class => AggregateType::fromString('foo')]);

        $this->assertSame('foo', $fixture->resolve(new \stdClass())->toString());
    }

    #[Test]
    public function throws_if_a_mapped_class_does_not_exist(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('All map keys must be class names that exist, FooBarBaz does not exist.');

        // @phpstan-ignore-next-line intentional undefined class.
        new MapAggregateTypeResolver([\FooBarBaz::class => AggregateType::fromString('FooBarBaz')]);
    }

    #[Test]
    public function throws_if_a_mapped_value_is_not_an_aggregate_type(): void
    {
        $badValue = new class () {
        };

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(\sprintf('All map values must be instances of %s, %s is not', AggregateType::class, $badValue::class));

        // @phpstan-ignore-next-line intentionally non-compliant value passed.
        new MapAggregateTypeResolver([\stdClass::class => $badValue]);
    }

    #[Test]
    public function throws_if_cannot_resolve_an_aggregate_as_not_mapped(): void
    {
        $this->expectException(CannotResolveAggregateType::class);

        $fixture = new MapAggregateTypeResolver([\stdClass::class => AggregateType::fromString('foo')]);
        $fixture->resolve(
            // @phpstan-ignore-next-line intentional bad method call violating static analysis for runtime check.
            new class () {
            }
        );
    }
}
