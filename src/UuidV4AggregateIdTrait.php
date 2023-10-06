<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Ramsey\Uuid\Rfc4122\Fields;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @mixin AggregateId
 */
trait UuidV4AggregateIdTrait
{
    use UuidAggregateIdTrait;

    public static function generate(): static
    {
        return new static(Uuid::uuid4());
    }

    protected function validate(UuidInterface $uuid): void
    {
        $fields = $uuid->getFields();

        if ($fields instanceof Fields && $fields->getVersion() !== 4) {
            throw InvalidUuidVersion::forUuid($uuid, 4);
        }
    }
}
