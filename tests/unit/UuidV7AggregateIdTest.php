<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use Lendable\Aggregate\Testing\AggregateIdSpec;
use Lendable\Aggregate\UuidV7AggregateId;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(UuidV7AggregateId::class)]
final class UuidV7AggregateIdTest extends AggregateIdSpec
{
    protected function idClass(): string
    {
        return UuidV7AggregateId::class;
    }

    protected function exampleString(): string
    {
        return '01833ce0-3486-7bfd-84a1-ad157cf64005';
    }

    protected function uuidVersion(): int
    {
        return 7;
    }
}
