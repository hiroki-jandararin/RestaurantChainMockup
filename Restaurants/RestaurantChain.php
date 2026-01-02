<?php

namespace Restaurants;

use Companies\Company;
use Shared\Interfaces\FileConvertible;

class RestaurantChain extends Company implements FileConvertible {
    private int $chainId;
    private RestaurantLocation $restaurantLocation;
    private string $cuisineType;
    private int $numberOfLocations;
    private bool $hasDriveThru;
    private int $yearFounded;
    private string $parentCompany;

    public function __construct(
        string $name, float $foundingYear, string $description,
        string $website, string $phone, string $industry,
        string $ceo, bool $isPubliclyTraded, string $country,
        string $founder, int $totalEmployees,
        int $chainId, RestaurantLocation $restaurantLocation,
        string $cuisineType, int $numberOfLocations,
        bool $hasDriveThru, int $yearFounded, string $parentCompany
    ) {
        parent::__construct(
            $name, $foundingYear, $description,
            $website, $phone, $industry,
            $ceo, $isPubliclyTraded, $country,
            $founder, $totalEmployees
        );
        $this->chainId = $chainId;
        $this->restaurantLocation = $restaurantLocation;
        $this->cuisineType = $cuisineType;
        $this->numberOfLocations = $numberOfLocations;
        $this->hasDriveThru = $hasDriveThru;
        $this->yearFounded = $yearFounded;
        $this->parentCompany = $parentCompany;
    }

    public function toString(): string {
        return parent::toString() . sprintf(
            ", Chain ID: %d, Cuisine Type: %s, Number of Locations: %d, Has Drive Thru: %s, Year Founded: %d, Parent Company: %s",
            $this->chainId,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->hasDriveThru ? 'Yes' : 'No',
            $this->yearFounded,
            $this->parentCompany
        );
    }

    public function toHTML(): string {
        return parent::toHTML() . sprintf("
            <p>Chain ID: %d</p>
            <p>Cuisine Type: %s</p>
            <p>Number of Locations: %d</p>
            <p>Has Drive Thru: %s</p>
            <p>Year Founded: %d</p>
            <p>Parent Company: %s</p>
        ",
            $this->chainId,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->hasDriveThru ? 'Yes' : 'No',
            $this->yearFounded,
            $this->parentCompany
        );
    }

    public function toMarkdown(): string {
        return parent::toMarkdown() . sprintf(
            "### Chain ID: %d\n- Cuisine Type: %s\n- Number of Locations: %d\n- Has Drive Thru: %s\n- Year Founded: %d\n- Parent Company: %s\n",
            $this->chainId,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->hasDriveThru ? 'Yes' : 'No',
            $this->yearFounded,
            $this->parentCompany
        );
    }

    public function toArray(): array {
        return array_merge(parent::toArray(), [
            'chainId' => $this->chainId,
            'cuisineType' => $this->cuisineType,
            'numberOfLocations' => $this->numberOfLocations,
            'hasDriveThru' => $this->hasDriveThru,
            'yearFounded' => $this->yearFounded,
            'parentCompany' => $this->parentCompany
        ]);
    }
}