<?php

namespace Companies;

use Shared\Interfaces\FileConvertible;

abstract class Company implements FileConvertible {
    private string $name;
    private float $foundingYear;
    private string $description;
    private string $website;
    private string $phone;
    private string $industry;
    private string $ceo;
    private bool $isPubliclyTraded;
    private string $country;
    private string $founder;
    private int $totalEmployees;

    public function __construct(
        string $name, float $foundingYear, string $description,
        string $website, string $phone, string $industry,
        string $ceo, bool $isPubliclyTraded, string $country,
        string $founder, int $totalEmployees
    ) {
        $this->name = $name;
        $this->foundingYear = $foundingYear;
        $this->description = $description;
        $this->website = $website;
        $this->phone = $phone;
        $this->industry = $industry;
        $this->ceo = $ceo;
        $this->isPubliclyTraded = $isPubliclyTraded;
        $this->country = $country;
        $this->founder = $founder;
        $this->totalEmployees = $totalEmployees;
    }

    public function toString(): string {
        return sprintf(
            "Company Name: %s, Founded: %.1f, Description: %s, Website: %s, Phone Number: %s,  CEO: %s, Industry: %s IsPubliclyTraded: %s, Country: %s, Founder: %s, Total Employees: %d",
            $this->name, 
            $this->foundingYear, 
            $this->description, 
            $this->website, 
            $this->phone, 
            $this->ceo, 
            $this->industry, 
            $this->isPubliclyTraded, 
            $this->country, 
            $this->founder, 
            $this->totalEmployees
        );
    }

    public function toHTML(): string {
        return sprintf(
            "<div class='company-card'>
                <h2>%s</h2>
                <p>Founded: %.1f</p>
                <p>Description: %s</p>
                <p>Website: %s</p>
                <p>Phone Number: %s</p>
                <p>CEO: %s</p>
                <p>Industry: %s</p>
                <p>Is Publicly Traded: %s</p>
                <p>Country: %s</p>
                <p>Founder: %s</p>
                <p>Total Employees: %d</p>
            </div>",
            $this->name, 
            $this->foundingYear, 
            $this->description, 
            $this->website, 
            $this->phone, 
            $this->ceo, 
            $this->industry, 
            $this->isPubliclyTraded ? 'Yes' : 'No', 
            $this->country, 
            $this->founder, 
            $this->totalEmployees
        );
    }

    public function toMarkdown(): string {
        return "## Company: {$this->name}
                 - Founded: {$this->foundingYear}
                 - Description: {$this->description}
                 - Website: {$this->website}
                 - Phone Number: {$this->phone}
                 - CEO: {$this->ceo}
                 - Industry: {$this->industry}
                 - Is Publicly Traded: " . ($this->isPubliclyTraded ? 'Yes' : 'No') . "
                 - Country: {$this->country}
                 - Founder: {$this->founder}
                 - Total Employees: {$this->totalEmployees}";
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'foundingYear' => $this->foundingYear,
            'description' => $this->description,
            'website' => $this->website,
            'phone' => $this->phone,
            'industry' => $this->industry,
            'ceo' => $this->ceo,
            'isPubliclyTraded' => $this->isPubliclyTraded,
            'country' => $this->country,
            'founder' => $this->founder,
            'totalEmployees' => $this->totalEmployees,
        ];
    }
}