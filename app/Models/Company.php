<?php

namespace App\Models;

class Company
{
    private string $name;
    private string $symbol;
    private ?float $price;
    private ?object $companyProfile;

    public function __construct(string  $name,
                                string  $symbol,
                                ?object $companyProfile = null,
                                ?float  $price = null)
    {
        $this->name = $name;
        $this->symbol = $symbol;
        $this->price = $price;
        $this->companyProfile = $companyProfile;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getProfile(): object
    {
        return $this->companyProfile;
    }
}
