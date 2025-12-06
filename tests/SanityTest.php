<?php

use HelgeSverre\Telefonkatalog\DataSources\Gulesider;
use HelgeSverre\Telefonkatalog\DataSources\Opplysningen1881;
use HelgeSverre\Telefonkatalog\DataSources\Opplysningen1890;

it('can search Gulesider', function () {
    $lookup = new Gulesider;
    $person = $lookup->find('95965871');

    expect($person)->not()->toBeNull()
        ->and($person->name)->toBe('Helge Sverre Hessevik Liseth')
        ->and($person->address)->toBe('Vognstølen 29')
        ->and($person->city)->toBe('Bergen')
        ->and($person->postalCode)->toBe('5096')
        ->and($person->phone)->toBe('95965871')
        ->and($person->url)->toBe('https://www.gulesider.no/helge+sverre+hessevik+liseth+bergen/77190505/person');
});

it('can search Gulesider by name', function () {
    $lookup = new Gulesider;
    $people = $lookup->search('helge sverre liseth');

    expect($people)->toBeCollection()->and($people)->toHaveCount(1);
});

it('can search Opplysningen 1881', function () {
    $lookup = new Opplysningen1881;
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
    $lookup = new Opplysningen1881;
    $people = $lookup->search('helge sverre liseth');

    expect($people)->toBeCollection()->and($people)->isNotEmpty();
});

it('can search Opplysningen 1890', function () {
    $lookup = new Opplysningen1890;
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
    $lookup = new Opplysningen1890;
    $people = $lookup->search('helge sverre liseth');

    expect($people)->toBeCollection()->and($people)->toHaveCount(1);
});

// Edge case tests for empty/non-existent results

it('returns null for non-existent phone number on Gulesider', function () {
    $lookup = new Gulesider;
    $person = $lookup->find('00000000');

    expect($person)->toBeNull();
});

it('returns empty collection for non-existent name on Gulesider', function () {
    $lookup = new Gulesider;
    $results = $lookup->search('xyznonexistentperson12345');

    expect($results)->toBeCollection()->and($results)->toBeEmpty();
});

it('returns null for non-existent phone number on Opplysningen 1881', function () {
    $lookup = new Opplysningen1881;
    $person = $lookup->find('00000000');

    expect($person)->toBeNull();
});

it('returns empty collection for non-existent name on Opplysningen 1881', function () {
    $lookup = new Opplysningen1881;
    $results = $lookup->search('xyznonexistentperson12345');

    expect($results)->toBeCollection()->and($results)->toBeEmpty();
});

it('handles non-matching queries gracefully on Opplysningen 1890', function () {
    $lookup = new Opplysningen1890;
    // 1890.no does aggressive fuzzy matching, results are unpredictable
    // Just verify it returns valid type without throwing
    $person = $lookup->find('zzzzzzzzzzzzz');

    expect($person === null || $person instanceof \HelgeSverre\Telefonkatalog\Data\Person)->toBeTrue();
});

it('returns empty collection for non-existent name on Opplysningen 1890', function () {
    $lookup = new Opplysningen1890;
    $results = $lookup->search('xyznonexistentperson12345');

    expect($results)->toBeCollection()->and($results)->toBeEmpty();
});
