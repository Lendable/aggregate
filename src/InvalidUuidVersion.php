<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Ramsey\Uuid\Rfc4122\Fields;
use Ramsey\Uuid\UuidInterface;

class InvalidUuidVersion extends \InvalidArgumentException
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    /**
     * @param int<1, 8> $expectedVersion
     */
    public static function forUuid(UuidInterface $uuid, int $expectedVersion): self
    {
        $fields = $uuid->getFields();

        $actualVersion = $fields instanceof Fields ? $fields->getVersion() : 'unknown';

        return new self(
            \sprintf(
                'UUID "%s" was version %s, expected version %d.',
                $uuid->toString(),
                $actualVersion,
                $expectedVersion
            )
        );
    }
}
