<?php

use HelgeSverre\Telefonkatalog\DataSources\Gulesider;
use HelgeSverre\Telefonkatalog\DataSources\Opplysningen1881;
use HelgeSverre\Telefonkatalog\DataSources\Opplysningen1890;

it('can search Gulesider', function () {
    $lookup = new Gulesider();
    $person = $lookup->find('95965871');
    expect($person)->not()->toBeNull()
        ->and($person->name)->toBe('Helge Sverre Hessevik Liseth')
        ->and($person->address)->toBe('Vognstølen 29')
        ->and($person->city)->toBe('Bergen')
        ->and($person->postalCode)->toBe('5096')
        ->and($person->phone)->toBe('95965871')
        ->and($person->url)->toBe('https://www.gulesider.no/oppslag/77190505/person');

    dd($person);

});

it('can search Gulesider by name', function () {
    $lookup = new Gulesider();
    $people = $lookup->search('helge sverre liseth');
    expect($people)->toBeCollection()->and($people)->toHaveCount(1);
});

it('can search Opplysningen 1881', function () {
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

it('can search Opplysningen 1881 by name', function () {
    $lookup = new Opplysningen1881();
    $people = $lookup->search('helge sverre liseth');
    expect($people)->toBeCollection()->and($people)->isNotEmpty();
});

it('can search Opplysningen 1890', function () {
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

it('can search Opplysningen 1890 by name', function () {
    $lookup = new Opplysningen1890();
    $people = $lookup->search('helge sverre liseth');
    expect($people)->toBeCollection()->and($people)->toHaveCount(1);
});
