<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Identical\FlipTypeControlToUseExclusiveTypeRector;
use Rector\Config\RectorConfig;
use Rector\ValueObject\PhpVersion;

return RectorConfig::configure()
    ->withParallel()
    ->withPaths([
        __DIR__.'/src',
        __DIR__.'/tests',
    ])
    ->withPhpVersion(PhpVersion::PHP_84)
    ->withPHPStanConfigs([__DIR__.'/phpstan-rector.neon'])
    ->withImportNames(importShortClasses: false)
    ->withComposerBased(phpunit: true)
    ->withPhpSets(php84: true)
    ->withPreparedSets(codeQuality: true)
    ->withSkip([
        FlipTypeControlToUseExclusiveTypeRector::class,
    ]);
