<?php

namespace HelgeSverre\Telefonkatalog\DataSources;

use HelgeSverre\Telefonkatalog\Contracts\DataSource;
use HelgeSverre\Telefonkatalog\Data\Person;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class Gulesider implements DataSource
{
    public function search(string $keyword): Collection
    {
        $response = Http::timeout(5)
            ->withHeaders(DataSource::REALISTIC_BROWSER_HEADERS)
            ->get(sprintf('https://www.gulesider.no/%s/personer', urlencode($keyword)));

        $dom = new Crawler($response->body(), $response->effectiveUri());

        $json = json_decode($dom->filter('#__NEXT_DATA__')->innerText(), true);

        $people = Arr::get($json, 'props.pageProps.initialState.persons');

        $concat = fn ($arr) => Str::squish(trim(html_entity_decode(implode(' ', $arr))));

        return collect($people)->map(fn ($person) => new Person(
            phone: Str::of(Arr::get($person, 'phones.0.number'))->squish()->remove(' ')->toString(),
            name: $concat([
                Arr::get($person, 'name.firstName'),
                Arr::get($person, 'name.middleName'),
                Arr::get($person, 'name.lastName'),
            ]),
            address: $concat([
                Arr::get($person, 'addresses.0.streetName'),
                Arr::get($person, 'addresses.0.streetNumber'),
            ]),
            city: Arr::get($person, 'addresses.0.postalArea'),
            postalCode: Arr::get($person, 'addresses.0.postalCode'),
            url: sprintf('https://www.gulesider.no/oppslag/%s/person', Arr::get($person, 'eniroId')),
            source: 'Gulesider.no'
        ));
    }

    public function find($keyword): ?Person
    {
        return $this->search($keyword)->first();
    }
}
