<?php

declare(strict_types=1);

namespace Tests\Helper\Lendable\Aggregate;

use Ramsey\Uuid\Uuid;

final class UuidUtil
{
    private function __construct() {}

    /**
     * @param non-empty-string $uuid
     *
     * @return non-empty-string
     */
    public static function stringToBinaryString(string $uuid): string
    {
        return Uuid::fromString($uuid)->getBytes();
    }

    /**
     * @param non-empty-string $binaryUuid
     *
     * @return non-empty-string
     */
    public static function binaryStringToString(string $binaryUuid): string
    {
        return Uuid::fromBytes($binaryUuid)->toString();
    }
}
