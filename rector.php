<?php

declare(strict_types=1);

use Rector\Core\Configuration\Option;
use Rector\Laravel\Set\LaravelSetList;
use Rector\Set\ValueObject\LevelSetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    // get parameters
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/config',
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/views',
    ]);

    // Define what rule sets will be applied
    $containerConfigurator->import(LaravelSetList::LARAVEL_60);
    $containerConfigurator->import(LevelSetList::UP_TO_PHP_74);
};
