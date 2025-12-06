<?php

namespace HelgeSverre\Telefonkatalog\DataSources;

use HelgeSverre\Telefonkatalog\Contracts\DataSource;
use HelgeSverre\Telefonkatalog\Data\Person;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class Opplysningen1890 implements DataSource
{
    public function search(string $keyword): Collection
    {
        $response = Http::timeout(5)
            ->withHeaders(DataSource::REALISTIC_BROWSER_HEADERS)
            ->get('https://1890.no/', [
                'query' => $keyword,
                'sector' => 'consumer',
            ]);

        $dom = new Crawler($response->body(), $response->effectiveUri());

        // Regular search result listings
        $people = $dom->filter('.search-result-item')->each(function (Crawler $node) {
            $phoneNode = $node->filter('.search-item-phone .mobile');
            $addressNode = $node->filter('.search-item-address');
            $nameNode = $node->filter('h3');
            $linkNode = $node->filter('a');

            // Skip results without phone numbers
            if ($phoneNode->count() === 0) {
                return null;
            }

            $address = $addressNode->count() > 0 ? $addressNode->text() : '';

            return new Person(
                phone: Str::of($phoneNode->text())->squish()->remove(' ')->toString(),
                name: $nameNode->count() > 0 ? $nameNode->text() : '',
                address: Str::of($address)->beforeLast(',')->trim()->toString(),
                city: Str::of($address)->after(',')->trim()->after(' ')->trim()->toString(),
                postalCode: Str::of($address)->after(',')->trim()->before(' ')->trim()->toString(),
                url: $linkNode->count() > 0 ? $linkNode->link()->getUri() : '',
                source: '1890.no'
            );
        });

        return collect($people)->filter()->values();
    }

    public function find($keyword): ?Person
    {
        return $this->search($keyword)->first();
    }
}
