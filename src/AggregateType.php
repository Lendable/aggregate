<?php

declare(strict_types=1);

namespace Lendable\Aggregate;

/**
 * A type classification of an aggregate.
 */
final readonly class AggregateType
{
    /**
     * @var non-empty-string
     */
    private string $value;

    /**
     * @throws \InvalidArgumentException If $value is empty.
     */
    private function __construct(string $value)
    {
        if (\trim($value) === '') {
            throw new \InvalidArgumentException('Aggregate type cannot be empty.');
        }

        /** @var non-empty-string $value */
        $this->value = $value;
    }

    /**
     * @throws \InvalidArgumentException If $value is empty.
     */
    public static function fromString(string $value): self
    {
        return new self($value);
    }

    /**
     * @return non-empty-string
     */
    public function toString(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
