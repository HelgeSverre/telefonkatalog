<?php

namespace HelgeSverre\Telefonkatalog\DataSources;

use HelgeSverre\Telefonkatalog\Contracts\DataSource;
use HelgeSverre\Telefonkatalog\Data\Person;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class Opplysningen1881 implements DataSource
{
    public function search(string $keyword): Collection
    {
        $response = Http::timeout(5)
            ->withHeaders(DataSource::REALISTIC_BROWSER_HEADERS)
            ->get('https://www.1881.no/', [
                'query' => $keyword,
            ]);

        $dom = new Crawler($response->body(), $response->effectiveUri());

        // Detail page for exact phone number match
        if (Str::contains($response->effectiveUri(), '/person/')) {
            $address = $dom->filter('.listing-address')->text();

            return collect([
                new Person(
                    phone: Str::of($dom->filter('.button-call__number')->text())->squish()->remove(' ')->toString(),
                    name: $dom->filter('.details-name')->text(),
                    address: Str::of($address)->beforeLast(',')->trim()->toString(),
                    city: Str::of($address)->after(',')->trim()->after(' ')->trim()->toString(),
                    postalCode: Str::of($address)->after(',')->trim()->before(' ')->trim()->toString(),
                    url: $response->effectiveUri(),
                ),
            ]);
        }

        // Regular search result listings
        $people = $dom->filter('.listing')->each(function (Crawler $node) {
            $address = $node->filter('.listing-address')->text();

            return new Person(
                phone: Str::of($node->filter('.button-call__number')->text())->squish()->remove(' ')->toString(),
                name: $node->filter('.listing-name')->text(),
                address: Str::of($address)->beforeLast(',')->trim()->toString(),
                city: Str::of($address)->after(',')->trim()->after(' ')->trim()->toString(),
                postalCode: Str::of($address)->after(',')->trim()->before(' ')->trim()->toString(),
                url: $node->filter('a')->link()->getUri(),
                source: '1881.no'
            );
        });

        return collect($people)->filter()->values();
    }

    public function find($keyword): ?Person
    {
        return $this->search($keyword)->first();
    }
}
