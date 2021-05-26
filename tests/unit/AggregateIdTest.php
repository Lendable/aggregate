<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use Lendable\Aggregate\AggregateId;
use PHPUnit\Framework\TestCase;
use Tests\Helper\Lendable\Aggregate\UuidUtil;

/**
 * @covers \Lendable\Aggregate\AggregateId
 */
final class AggregateIdTest extends TestCase
{
    private const UUID_V4_STRING = '73d47cc6-e0c1-433b-9a6a-b68ed94f8ca6';

    /**
     * @test
     */
    public function it_can_be_constructed_statically_from_a_uuid_string(): void
    {
        $fixture = AggregateId::fromString(self::UUID_V4_STRING);

        $this->assertSame(self::UUID_V4_STRING, $fixture->toString());
        $this->assertSame(UuidUtil::stringToBinaryString(self::UUID_V4_STRING), $fixture->toBinary());
    }

    /**
     * @test
     */
    public function it_can_be_constructed_from_binary_via_static_factory(): void
    {
        $binaryUuid = UuidUtil::stringToBinaryString(self::UUID_V4_STRING);
        $fixture = AggregateId::fromBinary($binaryUuid);

        $this->assertSame(self::UUID_V4_STRING, $fixture->toString());
        $this->assertSame($binaryUuid, $fixture->toBinary());
    }
}
