<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use Lendable\Aggregate\AggregateVersion;
use Lendable\Aggregate\AggregateVersionExtractor;
use Lendable\Aggregate\ClosureAggregateVersionExtractor;
use Lendable\Aggregate\Testing\AggregateVersionExtractorSpec;
use Tests\Fixture\Lendable\Aggregate\Blog\Domain\Email;
use Tests\Fixture\Lendable\Aggregate\Blog\Domain\User;
use Tests\Fixture\Lendable\Aggregate\Blog\Domain\UserId;

/**
 * @template-extends AggregateVersionExtractorSpec<User>
 */
final class ClosureAggregateVersionExtractorTest extends AggregateVersionExtractorSpec
{
    protected function createExtractor(): AggregateVersionExtractor
    {
        return new ClosureAggregateVersionExtractor(
            static fn(User $user): AggregateVersion => AggregateVersion::fromInteger($user->version()->toInteger())
        );
    }

    protected function createExpectedAggregateVersion(): AggregateVersion
    {
        return AggregateVersion::fromInteger(1);
    }

    protected function createAggregateWithExpectedAggregateVersion(): object
    {
        return User::register(UserId::generate(), Email::fromString('foo@example.com'));
    }
}
