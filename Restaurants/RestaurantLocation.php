<?php

namespace Restaurants;
use Employees\Employee;

class RestaurantLovcation{
    private string $name;
    private string $address;
    private string $city;
    private string $state;
    private string $zipCode;
    private Employee $employee;
    private bool $isOpen;

    public function __construct(
        string $name, string $address, string $city,
        string $state, string $zipCode, Employee $employee,
        bool $isOpen
    ) {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->employee = $employee;
        $this->isOpen = $isOpen;
    }
}