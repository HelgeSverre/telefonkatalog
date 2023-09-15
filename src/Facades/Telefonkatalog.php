<?php

namespace HelgeSverre\Telefonkatalog\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HelgeSverre\Telefonkatalog\Telefonkatalog
 */
class Telefonkatalog extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \HelgeSverre\Telefonkatalog\Telefonkatalog::class;
    }
}
