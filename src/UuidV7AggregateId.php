<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Ramsey\Uuid\Rfc4122\Fields;
use Ramsey\Uuid\UuidInterface;

/**
 * Universally unique identifier for an aggregate.
 */
final class UuidV7AggregateId implements AggregateId
{
    use UuidV7AggregateIdTrait;

    protected function validate(UuidInterface $uuid): void
    {
        $fields = $uuid->getFields();

        if ($fields instanceof Fields && $fields->getVersion() !== 4) {
            throw InvalidUuidVersion::forUuid($uuid, 4);
        }
    }
}
