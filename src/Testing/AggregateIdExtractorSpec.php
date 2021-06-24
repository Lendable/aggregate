<?php

declare(strict_types=1);

namespace Lendable\Aggregate\Testing;

use Lendable\Aggregate\AggregateId;
use Lendable\Aggregate\AggregateIdExtractor;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Lendable\Aggregate\T;

/**
 * @phpstan-template T of object
 */
abstract class AggregateIdExtractorSpec extends TestCase
{
    protected const DEFAULT_V4_UUID = 'b96e8609-e6ef-4d62-a29e-45012fdd6d5a';

    /**
     * @phpstan-return AggregateIdExtractor<T>
     */
    abstract protected function createExtractor(): AggregateIdExtractor;

    abstract protected function createExpectedAggregateId(): AggregateId;

    /**
     * @phpstan-return T
     */
    abstract protected function createAggregateWithExpectedAggregateId(): object;

    /**
     * @test
     */
    public function it_extracts_an_aggregate_id_from_a_supported_aggregate(): void
    {
        $extractor = $this->createExtractor();
        $aggregate = $this->createAggregateWithExpectedAggregateId();
        $expectedAggregateId = $this->createExpectedAggregateId();
        $extractedAggregateId = $extractor->extract($aggregate);

        $this->assertTrue($expectedAggregateId->equals($extractedAggregateId));
    }
}
