<?php

namespace Restaurants;
use Employees\Employee;
use Shared\Interfaces\FileConvertible;

class RestaurantLocation implements FileConvertible {
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


    public function toString(): string {
        return sprintf(
            "Location Name: %s, Address: %s, City: %s, State: %s, Zip Code: %s, Employee: [%s], Is Open: %s",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $this->employee->toString(),
            $this->isOpen ? 'Yes' : 'No'
        );
    }

    public function toHTML(): string {
        return sprintf("
            <div class='restaurant-location-card'>
                <h2>%s</h2>
                <p>Address: %s</p>
                <p>City: %s</p>
                <p>State: %s</p>
                <p>Zip Code: %s</p>
                <div class='employee-info'>%s</div>
                <p>Is Open: %s</p>
            </div>",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $this->employee->toHTML(),
            $this->isOpen ? 'Yes' : 'No'
        );
    }

    public function toMarkdown(): string {
        return sprintf(
            "## Location Name: %s\n- Address: %s\n- City: %s\n- State: %s\n- Zip Code: %s\n- Employee:\n%s\n- Is Open: %s\n",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $this->employee->toMarkdown(),
            $this->isOpen ? 'Yes' : 'No'
        );
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zipCode' => $this->zipCode,
            'employee' => $this->employee->toArray(),
            'isOpen' => $this->isOpen
        ];
    }
}