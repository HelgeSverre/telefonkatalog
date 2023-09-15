<?php

namespace HelgeSverre\Telefonkatalog\Contracts;

use HelgeSverre\Telefonkatalog\Data\Person;
use Illuminate\Support\Collection;

interface DataSource
{
    const REALISTIC_BROWSER_HEADERS = [
        'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
        'Accept-Encoding' => 'gzip, deflate',
        'Accept-Language' => 'nb-NO,nb;q=0.9,no;q=0.8,nn;q=0.7,en-US;q=0.6,en;q=0.5,la;q=0.4,da;q=0.3',
        'Upgrade-Insecure-Requests' => '1',
        'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',
        'Referer' => 'https://www.google.com/',
    ];

    /**
     * @return Collection<Person>
     */
    public function search(string $keyword): Collection;

    public function find(string $keyword): ?Person;
}
