<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use Lendable\Aggregate\UuidV4AggregateId;
use PHPUnit\Framework\Attributes\Test;
use Lendable\Aggregate\AggregateId;
use Lendable\Aggregate\AggregateIdExtractor;
use Lendable\Aggregate\CannotExtractAggregateId;
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
            static fn (User $user): AggregateId => UuidV4AggregateId::fromString($user->id()->toString())
        );
    }

    protected function createExpectedAggregateId(): AggregateId
    {
        return UuidV4AggregateId::fromString(self::DEFAULT_V4_UUID);
    }

    protected function createAggregateWithExpectedAggregateId(): object
    {
        return User::register(
            UserId::fromString($this->createExpectedAggregateId()->toString()),
            Email::fromString('foo@example.com')
        );
    }

    #[Test]
    public function rethrows_any_interface_compliant_exception_from_the_closure(): void
    {
        $aggregate = new class () {};
        $exception = CannotExtractAggregateId::from($aggregate);

        $extractor = new ClosureAggregateIdExtractor(static function (object $aggregate) use ($exception): never {
            throw $exception;
        });

        $this->expectExceptionObject($exception);

        $extractor->extract($aggregate);
    }

    #[Test]
    public function wraps_and_throws_for_any_non_interface_compliant_exception_from_the_closure(): void
    {
        $aggregate = new class () {};
        $exception = new \Exception();

        $extractor = new ClosureAggregateIdExtractor(static function (object $aggregate) use ($exception): never {
            throw $exception;
        });
        $wasAnExceptionThrown = false;

        try {
            $extractor->extract($aggregate);
        } catch (CannotExtractAggregateId $thrown) {
            $wasAnExceptionThrown = true;
            $this->assertSame($exception, $thrown->getPrevious());
        }

        $this->assertTrue($wasAnExceptionThrown);
    }
}
