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
    protected array $dataSources;

    public function __construct(array $dataSources)
    {
        $this->dataSources = $dataSources;
    }

    public function registerDataSource(DataSource $dataSource): void
    {
        $this->dataSources[] = $dataSource;
    }

    public function search(string $keyword): Collection
    {
        foreach ($this->dataSources as $dataSource) {
            $result = $this->fetchResults($dataSource, $keyword);

            if ($result && $result->isNotEmpty()) {
                return $result;
            }
        }

        return collect();
    }

    public function searchAll(string $keyword): Collection
    {
        $allResults = [];

        foreach ($this->dataSources as $dataSource) {
            $result = $this->fetchResults($dataSource, $keyword);

            if ($result) {
                $allResults = array_merge($allResults, $result->toArray());
            }
        }

        return collect($allResults)->filter()
            ->unique(fn (Person $person) => $person->phone)
            ->values();
    }

    public function find(string $keyword): ?Person
    {
        return $this->search($keyword)->first();
    }

    private function fetchResults(DataSource $dataSource, string $keyword): ?Collection
    {
        return rescue(fn () => $dataSource->search($keyword), null, report: false);
    }
}
