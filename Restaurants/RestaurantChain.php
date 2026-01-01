<?php

namespace Restaurants;

use Companies\Company;

class RestaurantChain extends Company {
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
}