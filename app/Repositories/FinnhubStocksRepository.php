<?php

namespace App\Repositories;

use App\Models\Company;
use Finnhub\Api\DefaultApi;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Ramsey\Collection\Collection;

class FinnhubStocksRepository implements StocksRepository
{
    private DefaultApi $client;

    public function __construct(DefaultApi $client)
    {
        $this->client = $client;
    }

    public function searchCompanies(string $name) : Collection
    {
        $companies= $this->client->symbolSearch($name);

        $collection = new Collection(Company::class);
        foreach ($companies['result'] as $company)
        {
            $collection->add(
                new Company(
                    $company['description'],
                    $company['symbol']
                ));
        }
        return $collection;
    }

    public function getPrice(string $companySymbol):float
    {
        return $this->client->quote($companySymbol)['c'];
    }

    public function getCompanyBySymbol(string $symbol): Company
    {
        $symbol = strtoupper($symbol);
        $cacheKey = 'companies.view.' . $symbol;

        if (Cache::has($cacheKey))
        {
            return Cache::get($cacheKey);
        }

        $responseData = $this->client->companyProfile2($symbol);
        $company = new Company(
            $responseData['name'],
            $symbol,
            $responseData,
            $this->getPrice($symbol)
        );

        Cache::put($cacheKey, $company, now()->addMinutes(10));

        return $company;
    }
}
