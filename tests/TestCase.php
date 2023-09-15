<?php

namespace HelgeSverre\Telefonkatalog\Tests;

use HelgeSverre\Telefonkatalog\TelefonkatalogServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'HelgeSverre\\Telefonkatalog\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            TelefonkatalogServiceProvider::class,
        ];
    }
}
