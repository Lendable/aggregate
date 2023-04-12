<?php

declare(strict_types=1);

namespace Tests\Fixture\Lendable\Aggregate\Blog\Domain;

use Tests\Fixture\Lendable\Aggregate\Blog\Domain\Event\UserEvent;
use Tests\Fixture\Lendable\Aggregate\Blog\Domain\Event\UserRegistered;

final class User
{
    private readonly UserState $state;

    private ?Version $version = null;

    private function __construct()
    {
        $this->state = UserState::empty();
    }

    public static function register(UserId $id, Email $email): self
    {
        $instance = new self();
        $instance->apply(new UserRegistered($id, $email));

        return $instance;
    }

    public function id(): UserId
    {
        return $this->state->id();
    }

    public function version(): Version
    {
        \assert($this->version instanceof Version);

        return $this->version;
    }

    private function apply(UserEvent $event): void
    {
        $event->applyTo($this->state);

        $this->version = $this->version?->next() ?? Version::fromInteger(1);
    }
}
