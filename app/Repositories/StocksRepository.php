<?php

namespace App\Repositories;

use App\Models\Company;
use Ramsey\Collection\Collection;

interface StocksRepository
{
    public function searchCompanies(string $name): Collection;
    public function getPrice(string $companySymbol): float;
    public function getCompanyBySymbol(string $companySymbol): Company;
}
