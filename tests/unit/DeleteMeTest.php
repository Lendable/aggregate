<?php

declare(strict_types=1);

namespace Test\Unit\Lendable\LibraryTemplate;

use Lendable\LibraryTemplate\DeleteMe;
use PHPUnit\Framework\TestCase;

class DeleteMeTest extends TestCase
{
    /**
     * @test
     */
    public function should_be_deleted(): void
    {
        $this->assertTrue(\class_exists(DeleteMe::class));
    }
}
