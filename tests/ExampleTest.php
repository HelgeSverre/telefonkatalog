<?php

use HelgeSverre\Telefonkatalog\DataSources\Gulesider;
use HelgeSverre\Telefonkatalog\DataSources\Opplysningen1881;
use HelgeSverre\Telefonkatalog\DataSources\Opplysningen1890;

it('can search gulesider', function () {
    $lookup = new Gulesider();

    $person = $lookup->find('95965871');

    expect($person)->not()->toBeNull()
        ->and($person->name)->toBe('Helge Sverre Hessevik Liseth')
        ->and($person->address)->toBe('Vognstølen 29')
        ->and($person->city)->toBe('Bergen')
        ->and($person->postalCode)->toBe('5096')
        ->and($person->phone)->toBe('95965871')
        ->and($person->url)->toBe('https://www.gulesider.no/oppslag/77190505/person');
});

it('can search opplysningen 1881', function () {
    $lookup = new Opplysningen1881();

    $person = $lookup->find('95965871');

    expect($person)->not()->toBeNull()
        ->and($person->name)->toBe('Helge Sverre Hessevik Liseth')
        ->and($person->address)->toBe('Vognstølen 29')
        ->and($person->city)->toBe('Bergen')
        ->and($person->postalCode)->toBe('5096')
        ->and($person->phone)->toBe('95965871')
        ->and($person->url)->toBe('https://www.1881.no/person/bergen/bergen/helge-sverre-hessevik-liseth_12982286S2/?query=95965871');
});

it('can search opplysningen 1890', function () {
    $lookup = new Opplysningen1890();

    $person = $lookup->find('95965871');

    expect($person)->not()->toBeNull()
        ->and($person->name)->toBe('Helge Sverre Hessevik Liseth')
        ->and($person->address)->toBe('Vognstølen 29')
        ->and($person->city)->toBe('Bergen')
        ->and($person->postalCode)->toBe('5096')
        ->and($person->phone)->toBe('95965871')
        ->and($person->url)->toBe('https://1890.no/id/Helge-Sverre-Hessevik-Liseth-5096');
});
