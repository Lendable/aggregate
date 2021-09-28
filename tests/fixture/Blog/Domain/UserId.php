<?php

declare(strict_types=1);

namespace Tests\Fixture\Lendable\Aggregate\Blog\Domain;

use Ramsey\Uuid\Rfc4122\FieldsInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class UserId
{
    private UuidInterface $uuid;

    private function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function fromString(string $uuid): self
    {
        return self::fromUuid4(Uuid::fromString($uuid));
    }

    public static function fromUuid4(UuidInterface $uuid): self
    {
        $fields = $uuid->getFields();

        if (!$fields instanceof FieldsInterface || $fields->getVersion() !== 4) {
            throw new \InvalidArgumentException(
                \Safe\sprintf(
                    'UUID must be V4, the provided string %s does not conform.',
                    $uuid->toString()
                )
            );
        }

        return new self($uuid);
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4());
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }
}
