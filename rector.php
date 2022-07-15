<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Core\Configuration\Option;
use Rector\Laravel\Set\LaravelSetList;
use Rector\Php70\Rector\StaticCall\StaticCallOnNonStaticToInstanceCallRector;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $parameters = $rectorConfig->parameters();

    $parameters->set(Option::PATHS, [
        __DIR__ . '/config',
        __DIR__ . '/src',
        __DIR__ . '/tests',
        __DIR__ . '/views',
    ]);

    $parameters->set(Option::SKIP, [
        StaticCallOnNonStaticToInstanceCallRector::class => [
            __DIR__ . '/tests/ShareTest.php',
        ],
    ]);

    $rectorConfig->import(LaravelSetList::LARAVEL_60);
    $rectorConfig->import(LevelSetList::UP_TO_PHP_74);
};
