<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Ramsey\Uuid\Rfc4122\Fields;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @mixin AggregateId
 */
trait UuidV7AggregateIdTrait
{
    use UuidAggregateIdTrait;

    public static function generate(): static
    {
        return new static(Uuid::uuid7());
    }

    protected function validate(UuidInterface $uuid): void
    {
        $fields = $uuid->getFields();

        if ($fields instanceof Fields && $fields->getVersion() !== 7) {
            throw InvalidUuidVersion::forUuid($uuid, 7);
        }
    }
}
