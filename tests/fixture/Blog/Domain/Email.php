<?php

declare(strict_types=1);

namespace Tests\Fixture\Lendable\Aggregate\Blog\Domain;

final class Email
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function toString(): string
    {
        return $this->value;
    }
}
