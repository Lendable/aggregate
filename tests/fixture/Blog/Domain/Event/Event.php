<?php

declare(strict_types=1);

namespace Tests\Fixture\Lendable\Aggregate\Blog\Domain\Event;

/**
 * @phpstan-template T of object
 */
interface Event
{
    /**
     * @phpstan-param T $state
     */
    public function applyTo(object $state): void;
}
