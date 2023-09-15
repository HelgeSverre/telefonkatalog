<?php

namespace HelgeSverre\Telefonkatalog\Data;

use Livewire\Wireable;
use Spatie\LaravelData\Concerns\WireableData;
use Spatie\LaravelData\Data;

class Person extends Data implements Wireable
{
    use WireableData;

    public function __construct(
        public readonly string $phone,
        public readonly ?string $name = null,
        public readonly ?string $address = null,
        public readonly ?string $city = null,
        public readonly ?string $postalCode = null,
        public readonly ?string $url = null,
        public readonly ?string $source = null,
    ) {
    }
}
