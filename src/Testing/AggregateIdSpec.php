<?php

declare(strict_types=1);

namespace Lendable\Aggregate\Testing;

use Lendable\Aggregate\AggregateId;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Rfc4122\FieldsInterface;
use Ramsey\Uuid\Uuid;
use Tests\Fixture\Lendable\Aggregate\FooAggregateId;
use Tests\Helper\Lendable\Aggregate\UuidUtil;

abstract class AggregateIdSpec extends TestCase
{
    /**
     * @return class-string<AggregateId>
     */
    abstract protected function idClass(): string;

    /**
     * @return non-empty-string
     */
    abstract protected function exampleString(): string;

    abstract protected function uuidVersion(): int;

    #[Test]
    final public function constructable_from_a_uuid_string(): void
    {
        $fixture = $this->idClass()::fromString($this->exampleString());

        $this->assertSame($this->exampleString(), $fixture->toString());
        $this->assertSame(UuidUtil::stringToBinaryString($this->exampleString()), $fixture->toBinary());
    }

    #[Test]
    final public function constructable_from_binary(): void
    {
        $binaryUuid = UuidUtil::stringToBinaryString($this->exampleString());
        $fixture = $this->idClass()::fromBinary($binaryUuid);

        $this->assertSame($this->exampleString(), $fixture->toString());
        $this->assertSame($binaryUuid, $fixture->toBinary());
    }

    #[Test]
    final public function constructable_from_ramsey_uuid(): void
    {
        $fixture = $this->idClass()::fromUuid(Uuid::fromString($this->exampleString()));

        $this->assertSame($this->exampleString(), $fixture->toString());
        $this->assertSame(UuidUtil::stringToBinaryString($this->exampleString()), $fixture->toBinary());
    }

    #[Test]
    final public function generatable(): void
    {
        $instance = $this->idClass()::generate();
        $rawUuid = Uuid::fromString($instance->toString());
        $fields = $rawUuid->getFields();
        \assert($fields instanceof FieldsInterface);
        $this->assertSame($this->uuidVersion(), $fields->getVersion());
    }

    #[Test]
    final public function equals_other_aggregate_ids_with_an_equal_value(): void
    {
        $id = $this->idClass()::fromString($this->exampleString());
        $idSameValue = $this->idClass()::fromString($this->exampleString());
        $idDifferentValue = $this->idClass()::fromString('37d40242-e110-4c9c-a712-15c2a9edbb7a');

        $this->assertTrue($id->equals($id));
        $this->assertTrue($id->equals($idSameValue));
        $this->assertTrue($idSameValue->equals($id));
        $this->assertFalse($id->equals($idDifferentValue));
        $this->assertFalse($idDifferentValue->equals($id));
    }

    #[Test]
    public function does_not_equals_other_aggregate_ids_of_different_class_with_an_equal_value(): void
    {
        $id = $this->idClass()::fromString($this->exampleString());
        $idSameValue = FooAggregateId::fromString($this->exampleString());
        $this->assertFalse($id->equals($idSameValue));
        /* @phpstan-ignore-next-line */
        $this->assertFalse($idSameValue->equals($id));
    }
}
