<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use Lendable\Aggregate\AggregateId;
use Lendable\Aggregate\AggregateIdExtractor;
use Lendable\Aggregate\ClosureAggregateIdExtractor;
use Lendable\Aggregate\Testing\AggregateIdExtractorSpec;
use Tests\Fixture\Lendable\Aggregate\Blog\Domain\Email;
use Tests\Fixture\Lendable\Aggregate\Blog\Domain\User;
use Tests\Fixture\Lendable\Aggregate\Blog\Domain\UserId;

/**
 * @template-extends AggregateIdExtractorSpec<User>
 */
final class ClosureAggregateIdExtractorTest extends AggregateIdExtractorSpec
{
    protected function createExtractor(): AggregateIdExtractor
    {
        return new ClosureAggregateIdExtractor(
            static fn (User $user): AggregateId => AggregateId::fromString($user->id()->toString())
        );
    }

    protected function createExpectedAggregateId(): AggregateId
    {
        return AggregateId::fromString(self::DEFAULT_V4_UUID);
    }

    protected function createAggregateWithExpectedAggregateId(): object
    {
        return User::register(
            UserId::fromString($this->createExpectedAggregateId()->toString()),
            Email::fromString('foo@example.com')
        );
    }
}
