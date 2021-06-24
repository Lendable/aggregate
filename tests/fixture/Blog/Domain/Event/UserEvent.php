<?php

declare(strict_types=1);

namespace Tests\Fixture\Lendable\Aggregate\Blog\Domain\Event;

/**
 * @template-implements Event<\Tests\Fixture\Lendable\Aggregate\Blog\Domain\UserState>
 */
abstract class UserEvent implements Event
{
    public function applyTo(object $state): void
    {
        $state->apply($this);
    }
}
