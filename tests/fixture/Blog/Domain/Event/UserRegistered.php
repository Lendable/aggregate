<?php

declare(strict_types=1);

namespace Tests\Fixture\Lendable\Aggregate\Blog\Domain\Event;

use Tests\Fixture\Lendable\Aggregate\Blog\Domain\Email;
use Tests\Fixture\Lendable\Aggregate\Blog\Domain\UserId;

final class UserRegistered extends UserEvent
{
    private UserId $id;

    private Email $email;

    public function __construct(UserId $id, Email $email)
    {
        $this->id = $id;
        $this->email = $email;
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
