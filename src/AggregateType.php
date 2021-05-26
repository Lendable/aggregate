<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

use Assert\Assertion;
use Assert\AssertionFailedException;

/**
 * A type classification of an aggregate.
 */
final class AggregateType
{
    private string $value;

    /**
     * @throws AssertionFailedException If $value is empty.
     */
    private function __construct(string $value)
    {
        Assertion::notEmpty($value, 'Aggregate type cannot be empty.');

        $this->value = $value;
    }

    /**
     * @throws AssertionFailedException If $value is empty.
     */
    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
