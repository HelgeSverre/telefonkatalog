<?php

namespace HelgeSverre\Telefonkatalog;

use App\Modules\Phonebook\Providers\Gulesider;
use App\Modules\Phonebook\Providers\Opplysningen1881;
use App\Modules\Phonebook\Providers\Opplysningen1890;
use Illuminate\Support\ServiceProvider;

class WipTelefonkatalogServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Phonebook::class, function () {
            return new Phonebook([
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
