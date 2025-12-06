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
        $pageUrl = sprintf('https://www.gulesider.no/%s/personer', urlencode($keyword));

        $response = Http::timeout(5)
            ->withHeaders(DataSource::REALISTIC_BROWSER_HEADERS)
            ->get($pageUrl);

        $dom = new Crawler($response->body(), $response->effectiveUri());

        // Extract JSON-LD structured data
        $jsonLdNode = $dom->filter('script[type="application/ld+json"]');

        if ($jsonLdNode->count() === 0) {
            return collect();
        }

        $json = json_decode($jsonLdNode->text(), true);
        $items = Arr::get($json, 'mainEntity.itemListElement', []);

        return collect($items)->map(function ($listItem) {
            $person = Arr::get($listItem, 'item', []);

            return new Person(
                phone: Str::of(Arr::get($person, 'telephone', ''))->remove(' ')->toString(),
                name: Arr::get($person, 'name', ''),
                address: Arr::get($person, 'address.streetAddress', ''),
                city: Arr::get($person, 'address.addressLocality', ''),
                postalCode: Arr::get($person, 'address.postalCode', ''),
                url: Arr::get($person, 'url', ''),
                source: 'Gulesider.no'
            );
        });
    }

    public function find(string $keyword): ?Person
    {
        return $this->search($keyword)->first();
    }
}
