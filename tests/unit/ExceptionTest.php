<?php

declare(strict_types=1);

namespace Tests\Unit\Lendable\Aggregate;

use PHPUnit\Framework\TestCase;

abstract class ExceptionTest extends TestCase
{
    /**
     * @return iterable<string, array<int, mixed>>
     */
    public function providePossiblePreviousExceptions(): iterable
    {
        yield 'with previous exception' => [new \RuntimeException('previous')];
        yield 'without previous exception' => [null];
    }

    /**
     * @return iterable<string, array<int, mixed>>
     */
    public function providePossibleCausesAndPreviousExceptions(): iterable
    {
        foreach ($this->providePossiblePreviousExceptions() as $label => [$previousException]) {
            yield 'empty cause and '.$label => ['', $previousException];
            yield 'cause and '.$label => ['foo', $previousException];
        }
    }
}
