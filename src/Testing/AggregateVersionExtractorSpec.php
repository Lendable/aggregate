<?php

declare(strict_types=1);

namespace Lendable\Aggregate\Testing;

use Lendable\Aggregate\AggregateVersion;
use Lendable\Aggregate\AggregateVersionExtractor;
use PHPUnit\Framework\TestCase;

/**
 * @phpstan-template T of object
 */
abstract class AggregateVersionExtractorSpec extends TestCase
{
    use ValueObjectAssertions;

    /**
     * @phpstan-return AggregateVersionExtractor<T>
     */
    abstract protected function createExtractor(): AggregateVersionExtractor;

    abstract protected function createExpectedAggregateVersion(): AggregateVersion;

    /**
     * @phpstan-return T
     */
    abstract protected function createAggregateWithExpectedAggregateVersion(): object;

    /**
     * @test
     */
    final public function extracts_an_aggregate_version_from_a_supported_aggregate(): void
    {
        $extractor = $this->createExtractor();
        $aggregate = $this->createAggregateWithExpectedAggregateVersion();
        $expectedAggregateVersion = $this->createExpectedAggregateVersion();
        $extractedAggregateVersion = $extractor->extract($aggregate);

        $this->assertAggregateVersionEquals($expectedAggregateVersion, $extractedAggregateVersion);
    }
}
