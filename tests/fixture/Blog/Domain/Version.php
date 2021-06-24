<?php

declare(strict_types=1);

namespace Tests\Fixture\Lendable\Aggregate\Blog\Domain;

final class Version
{
    private int $value;

    private function __construct(int $value)
    {
        if ($value < 1) {
            throw new \InvalidArgumentException(\Safe\sprintf('Value must be > 0, %d given.', $value));
        }

        $this->value = $value;
    }

    public static function fromInteger(int $value): self
    {
        return new self($value);
    }

    public function toInteger(): int
    {
        return $this->value;
    }

    public function next(): self
    {
        $instance = clone $this;
        $instance->value++;

        return $instance;
    }
}
