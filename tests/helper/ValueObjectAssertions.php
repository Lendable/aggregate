<?php


declare(strict_types=1);

namespace Tests\Helper\Lendable\Aggregate;

use Lendable\Aggregate\AggregateId;
use Lendable\Aggregate\AggregateType;
use Lendable\Aggregate\AggregateVersion;

trait ValueObjectAssertions
{
    protected function makeSimpleAssertion(bool $assertion, string $expected, string $actual): void
    {
        $this->assertTrue(
            $assertion,
            \sprintf('Expected "%s", got "%s".', $expected, $actual)
        );
    }

    public function assertAggregateIdEquals(AggregateId $expected, AggregateId $actual): void
    {
        $this->makeSimpleAssertion(
            $actual->equals($expected),
            $expected->toString(),
            $actual->toString()
        );
    }

    public function assertAggregateTypeEquals(AggregateType $expected, AggregateType $actual): void
    {
        $this->makeSimpleAssertion(
            $actual->equals($expected),
            $expected->toString(),
            $actual->toString()
        );
    }

    public function assertAggregateVersionEquals(AggregateVersion $expected, AggregateVersion $actual): void
    {
        $this->makeSimpleAssertion(
            $actual->equals($expected),
            (string) $expected->toInteger(),
            (string) $actual->toInteger()
        );
    }
}
