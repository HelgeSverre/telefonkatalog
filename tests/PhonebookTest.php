<?php

namespace HelgeSverre\Telefonkatalog\Tests;

use HelgeSverre\Telefonkatalog\DataSources\Gulesider;
use HelgeSverre\Telefonkatalog\DataSources\Opplysningen1881;
use HelgeSverre\Telefonkatalog\DataSources\Opplysningen1890;
use Tests\TestCase;

class PhonebookTest extends TestCase
{
    /** @test */
    public function can_search_gulesider()
    {
        $lookup = new Gulesider();

        $person = $lookup->find('95965871');

        $this->assertNotNull($person);
        $this->assertEquals('Helge Sverre Hessevik Liseth', $person->name);
        $this->assertEquals('Vognstølen 29', $person->address);
        $this->assertEquals('Bergen', $person->city);
        $this->assertEquals('5096', $person->postalCode);
        $this->assertEquals('95965871', $person->phone);
        $this->assertEquals('https://www.gulesider.no/oppslag/77190505/person', $person->url);
    }

    /** @test */
    public function can_search_opplysningen_1881()
    {
        $lookup = new Opplysningen1881();

        $person = $lookup->find('95965871');

        $this->assertNotNull($person);
        $this->assertEquals('Helge Sverre Hessevik Liseth', $person->name);
        $this->assertEquals('Vognstølen 29', $person->address);
        $this->assertEquals('Bergen', $person->city);
        $this->assertEquals('5096', $person->postalCode);
        $this->assertEquals('95965871', $person->phone);
        $this->assertEquals('https://www.1881.no/person/bergen/bergen/helge-sverre-hessevik-liseth_12982286S2/?query=95965871', $person->url);
    }

    /** @test */
    public function can_search_opplysningen_1890()
    {
        $lookup = new Opplysningen1890();

        $person = $lookup->find('95965871');

        $this->assertNotNull($person);
        $this->assertEquals('Helge Sverre Hessevik Liseth', $person->name);
        $this->assertEquals('Vognstølen 29', $person->address);
        $this->assertEquals('Bergen', $person->city);
        $this->assertEquals('5096', $person->postalCode);
        $this->assertEquals('95965871', $person->phone);
        $this->assertEquals('https://1890.no/id/Helge-Sverre-Hessevik-Liseth-5096', $person->url);
    }
}
