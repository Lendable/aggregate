<?php

declare(strict_types=1);

namespace Tests\Helper\Lendable\Aggregate;

use Ramsey\Uuid\Uuid;

final class UuidUtil
{
    private function __construct()
    {
    }

    public static function stringToBinaryString(string $uuid): string
    {
        return Uuid::fromString($uuid)->getBytes();
    }

    public static function binaryStringToString(string $binaryUuid): string
    {
        return Uuid::fromBytes($binaryUuid)->toString();
    }
}
