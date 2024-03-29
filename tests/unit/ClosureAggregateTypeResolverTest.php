<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use PHPUnit\Framework\Attributes\Test;
use Lendable\Aggregate\AggregateType;
use Lendable\Aggregate\AggregateTypeResolver;
use Lendable\Aggregate\CannotResolveAggregateType;
use Lendable\Aggregate\ClosureAggregateTypeResolver;
use Lendable\Aggregate\Testing\AggregateTypeResolverSpec;
use Tests\Fixture\Lendable\Aggregate\Blog\Domain\Email;
use Tests\Fixture\Lendable\Aggregate\Blog\Domain\User;
use Tests\Fixture\Lendable\Aggregate\Blog\Domain\UserId;

/**
 * @template-extends AggregateTypeResolverSpec<object>
 */
final class ClosureAggregateTypeResolverTest extends AggregateTypeResolverSpec
{
    protected function createResolver(): AggregateTypeResolver
    {
        return new ClosureAggregateTypeResolver(
            static function (object $user): AggregateType {
                if (!$user instanceof User) {
                    throw CannotResolveAggregateType::of($user, \sprintf('Not an instance of %s.', User::class));
                }

                return AggregateType::fromString('USER');
            }
        );
    }

    protected function createExpectedAggregateType(): AggregateType
    {
        return AggregateType::fromString('USER');
    }

    protected function createAggregateWithExpectedAggregateType(): object
    {
        return User::register(UserId::generate(), Email::fromString('foo@example.com'));
    }

    #[Test]
    public function rethrows_any_interface_compliant_exception_from_the_closure(): void
    {
        $resolver = new ClosureAggregateTypeResolver(
            static function (object $aggregate): never {
                throw CannotResolveAggregateType::of($aggregate);
            }
        );

        $aggregate = User::register(UserId::generate(), Email::fromString('foo@example.com'));

        try {
            $resolver->resolve($aggregate);
        } catch (CannotResolveAggregateType $exception) {
            $this->assertNull($exception->getPrevious());
        }
    }

    #[Test]
    public function wraps_and_throws_for_any_non_interface_compliant_exception_from_the_closure(): void
    {
        $resolver = new ClosureAggregateTypeResolver(
            static function (object $aggregate): never {
                throw new \RuntimeException('Foo Bar');
            }
        );

        $aggregate = User::register(UserId::generate(), Email::fromString('foo@example.com'));

        try {
            $resolver->resolve($aggregate);
        } catch (CannotResolveAggregateType $exception) {
            $this->assertInstanceOf(\RuntimeException::class, $exception->getPrevious());
            $this->assertSame('Foo Bar', $exception->getPrevious()->getMessage());
        }
    }
}
