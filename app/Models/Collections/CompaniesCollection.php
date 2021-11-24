<?php

namespace App\Models\Collections;

use App\Models\Company;

class CompaniesCollection
{
    private array $companies = [];

    public function __construct(array $companies = [])
    {
        foreach ($companies as $company)
        {
            if($company instanceof Company)
            {
                $this->add($company);
            }
        }
    }

    public function add(Company $company): void
    {
        $this->companies[] = $company;
    }

    public function getCompanies(): array
    {
        return $this->companies;
    }
}
