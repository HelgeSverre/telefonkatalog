<?php

namespace HelgeSverre\Telefonkatalog;

use HelgeSverre\Telefonkatalog\DataSources\Gulesider;
use HelgeSverre\Telefonkatalog\DataSources\Opplysningen1881;
use HelgeSverre\Telefonkatalog\DataSources\Opplysningen1890;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TelefonkatalogServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('telefonkatalog');
    }

    public function packageBooted()
    {
        $this->app->bind(Telefonkatalog::class, function () {
            return new Telefonkatalog([
                new Gulesider(),
                new Opplysningen1881(),
                new Opplysningen1890(),
            ]);
        });
    }
}
