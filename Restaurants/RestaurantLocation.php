<?php

namespace Restaurants;
use Users\Employee;
use Shared\Interfaces\FileConvertible;

class RestaurantLocation implements FileConvertible {
    private string $name;
    private string $address;
    private string $city;
    private string $state;
    private string $zipCode;
    private bool $isOpen;
    private array $employees = [];

    public function __construct(
        string $name, string $address, string $city,
        string $state, string $zipCode, ?Employee $employee,
        bool $isOpen
    ) {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->isOpen = $isOpen;

        if ($employee !== null) {
            $this->addEmployee($employee);
        }
    }


    public function toString(): string {
        $employeeSummary = count($this->employees) === 0
            ? 'None'
            : implode(' | ', array_map(fn(Employee $e) => $e->toString(), $this->employees));

        return sprintf(
            "Location Name: %s, Address: %s, City: %s, State: %s, Zip Code: %s, Employees: [%s], Is Open: %s",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $employeeSummary,
            $this->isOpen ? 'Yes' : 'No'
        );
    }

    public function toHTML(): string {
        $employeeHtml = count($this->employees) === 0
            ? "<em>No employees</em>"
            : implode('', array_map(fn(Employee $e) => $e->toHTML(), $this->employees));

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
            $employeeHtml,
            $this->isOpen ? 'Yes' : 'No'
        );
    }

    public function toMarkdown(): string {
        $employeeMd = count($this->employees) === 0
            ? "- Employees: None\n"
            : "- Employees:\n" . implode("\n", array_map(fn(Employee $e) => $e->toMarkdown(), $this->employees));

        return sprintf(
            "## Location Name: %s\n- Address: %s\n- City: %s\n- State: %s\n- Zip Code: %s\n%s\n- Is Open: %s\n",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $employeeMd,
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
            'employees' => array_map(fn(Employee $e) => $e->toArray(), $this->employees),
            'isOpen' => $this->isOpen
        ];
    }

    public function addEmployee(Employee $employee): void {
        $this->employees[] = $employee;
    }

    public function getEmployees(): array {
        return $this->employees;
    }
}