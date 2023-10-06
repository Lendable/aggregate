<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use Lendable\Aggregate\AggregateIdFactory;
use Lendable\Aggregate\AggregateType;
use Lendable\Aggregate\UuidV4AggregateId;
use Lendable\Aggregate\UuidV7AggregateId;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

#[CoversClass(AggregateIdFactory::class)]
final class AggregateIdFactoryTest extends TestCase
{
    #[Test]
    public function creates_from_binary(): void
    {
        $factory = new AggregateIdFactory(['foo' => UuidV4AggregateId::class, 'bar' => UuidV7AggregateId::class]);

        $fooUuid = Uuid::uuid4();
        $fooId = $factory->fromBinary(
            AggregateType::fromString('foo'),
            $fooUuid->getBytes()
        );

        $this->assertInstanceOf(UuidV4AggregateId::class, $fooId);
        $this->assertSame($fooUuid->toString(), $fooId->toString());

        $barUuid = Uuid::uuid7();
        $barId = $factory->fromBinary(
            AggregateType::fromString('bar'),
            $barUuid->getBytes()
        );

        $this->assertInstanceOf(UuidV7AggregateId::class, $barId);
        $this->assertSame($barUuid->toString(), $barId->toString());
    }

    #[Test]
    public function creates_from_string(): void
    {
        $factory = new AggregateIdFactory(['foo' => UuidV4AggregateId::class, 'bar' => UuidV7AggregateId::class]);

        $fooUuid = Uuid::uuid4();
        $fooId = $factory->fromString(
            AggregateType::fromString('foo'),
            $fooUuid->toString()
        );

        $this->assertInstanceOf(UuidV4AggregateId::class, $fooId);
        $this->assertSame($fooUuid->toString(), $fooId->toString());

        $barUuid = Uuid::uuid7();
        $barId = $factory->fromString(
            AggregateType::fromString('bar'),
            $barUuid->toString()
        );

        $this->assertInstanceOf(UuidV7AggregateId::class, $barId);
        $this->assertSame($barUuid->toString(), $barId->toString());
    }

    #[Test]
    public function creates_from_uuid(): void
    {
        $factory = new AggregateIdFactory(['foo' => UuidV4AggregateId::class, 'bar' => UuidV7AggregateId::class]);

        $fooUuid = Uuid::uuid4();
        $fooId = $factory->fromUuid(
            AggregateType::fromString('foo'),
            $fooUuid
        );

        $this->assertSame($fooUuid->toString(), $fooId->toString());

        $barUuid = Uuid::uuid7();
        $barId = $factory->fromUuid(
            AggregateType::fromString('bar'),
            $barUuid
        );

        $this->assertSame($barUuid->toString(), $barId->toString());
    }

    #[Test]
    public function throws_when_creating_from_binary_if_not_mapped(): void
    {
        $factory = new AggregateIdFactory(['foo' => UuidV4AggregateId::class]);

        $this->expectExceptionObject(new \InvalidArgumentException('Aggregate id implementation is not known for aggregate type "bar".'));

        $factory->fromBinary(AggregateType::fromString('bar'), Uuid::uuid4()->getBytes());
    }

    #[Test]
    public function throws_when_creating_from_string_if_not_mapped(): void
    {
        $factory = new AggregateIdFactory(['foo' => UuidV4AggregateId::class]);

        $this->expectExceptionObject(new \InvalidArgumentException('Aggregate id implementation is not known for aggregate type "bar".'));

        $factory->fromString(AggregateType::fromString('bar'), Uuid::uuid4()->toString());
    }

    #[Test]
    public function throws_when_creating_from_uuid_if_not_mapped(): void
    {
        $factory = new AggregateIdFactory(['foo' => UuidV4AggregateId::class]);

        $this->expectExceptionObject(new \InvalidArgumentException('Aggregate id implementation is not known for aggregate type "bar".'));

        $factory->fromUuid(AggregateType::fromString('bar'), Uuid::uuid4());
    }

    #[Test]
    public function throws_if_constructed_with_empty_map(): void
    {
        $this->expectExceptionObject(new \InvalidArgumentException('Map cannot be empty.'));

        new AggregateIdFactory([]);
    }
}
