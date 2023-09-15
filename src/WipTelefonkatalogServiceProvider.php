<?php

namespace HelgeSverre\Telefonkatalog;

use HelgeSverre\Telefonkatalog\DataSources\Gulesider;
use HelgeSverre\Telefonkatalog\DataSources\Opplysningen1881;
use HelgeSverre\Telefonkatalog\DataSources\Opplysningen1890;
use Illuminate\Support\ServiceProvider;

class WipTelefonkatalogServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Telefonkatalog::class, function () {
            return new Telefonkatalog([
                new Gulesider(),
                new Opplysningen1881(),
                new Opplysningen1890(),
            ]);
        });
    }

    public function boot()
    {
    }
}
