<?php

declare(strict_types=1);

namespace Tests\Fixture\Lendable\Aggregate\Blog\Domain;

use Tests\Fixture\Lendable\Aggregate\Blog\Domain\Event\Event;
use Tests\Fixture\Lendable\Aggregate\Blog\Domain\Event\UserRegistered;

final class UserState
{
    private UserId $id;

    private Email $email;

    private function __construct()
    {
    }

    public static function empty(): self
    {
        return new self();
    }

    /**
     * @param Event<self> $event
     */
    public function apply(Event $event): void
    {
        if ($event instanceof UserRegistered) {
            $this->applyUserRegistered($event);
        }
    }

    private function applyUserRegistered(UserRegistered $event): void
    {
        $this->id = $event->id();
        $this->email = $event->email();
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }
}
