<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\SetList;
use Rector\Set\ValueObject\LevelSetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [__DIR__.'/src', __DIR__.'/tests']);
    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_80);
    $parameters->set(Option::PHPSTAN_FOR_RECTOR_PATH, __DIR__.'/phpstan.neon');
    $parameters->set(Option::PARALLEL, true);

    $containerConfigurator->import(SetList::CODE_QUALITY);
    $containerConfigurator->import(LevelSetList::UP_TO_PHP_80);
};
