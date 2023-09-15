<?php

namespace HelgeSverre\Telefonkatalog;

use HelgeSverre\Telefonkatalog\Contracts\DataSource;
use HelgeSverre\Telefonkatalog\Data\Person;
use Illuminate\Support\Collection;

class Telefonkatalog
{
    /**
     * @var DataSource[]
     */
    protected array $providers;

    public function __construct(array $providers)
    {
        $this->providers = $providers;
    }

    public function search(string $keyword): Collection
    {
        foreach ($this->providers as $provider) {
            $result = rescue(fn () => $provider->search($keyword), report: false);

            if ($result && $result->isNotEmpty()) {
                return $result;
            }
        }

        return collect();
    }

    public function searchAll(string $keyword): Collection
    {
        $results = [];

        foreach ($this->providers as $provider) {
            $result = rescue(fn () => $provider->search($keyword), report: false);

            if ($result && $result->isNotEmpty()) {
                $results = array_merge($results, $result->toArray());
            }
        }

        return collect($results)->filter()->unique(fn (Person $person) => $person->phone)->values();
    }

    public function find(string $keyword): ?Person
    {
        return $this->search($keyword)->first();
    }
}
