<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use Lendable\Aggregate\UuidV4AggregateId;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(UuidV4AggregateId::class)]
final class UuidV4AggregateIdTest extends AggregateIdTestSpecification
{
    protected function idClass(): string
    {
        return UuidV4AggregateId::class;
    }

    protected function exampleString(): string
    {
        return '73d47cc6-e0c1-433b-9a6a-b68ed94f8ca6';
    }

    protected function uuidVersion(): int
    {
        return 4;
    }
}
