<?php

namespace Users;
use Models\User;

class Employee extends User{
    private string $jobTitle;
    private float $salary;
    private string $startDate;
    private string $awards;

    public function __construct(
        int $id, 
        string $firstName, 
        string $lastName,
        string $email,
        string $password, 
        string $phoneNumber, 
        string $address,
        \DateTime $birthDate,
         \DateTime $membershipExpirationDate,
        string $jobTitle, 
        float $salary, 
        string $startDate,
        string $awards
    ) {
        parent::__construct(
            $id, $firstName, $lastName, $email,
            $password, $phoneNumber, $address,
            $birthDate, $membershipExpirationDate, 'employee'
        );
        $this->jobTitle = $jobTitle;
        $this->salary = $salary;
        $this->startDate = $startDate;
        $this->awards = $awards;
    }

    public function toString(): string {
        return parent::toString() . sprintf(
            "Job Title: %s\nSalary: %.2f\nStart Date: %s\nAwards: %s\n",
            $this->jobTitle,
            $this->salary,
            $this->startDate,
            $this->awards
        );
    }

    public function toHTML(): string {
        return parent::toHTML() . sprintf("
            <p>Job Title: %s</p>
            <p>Salary: %.2f</p>
            <p>Start Date: %s</p>
            <p>Awards: %s</p>
        ",
            $this->jobTitle,
            $this->salary,
            $this->startDate,
            $this->awards
        );
    }

    public function toMarkdown(): string {
        return parent::toMarkdown() . sprintf(
            "### Job Title: %s\n- Salary: %.2f\n- Start Date: %s\n- Awards: %s\n",
            $this->jobTitle,
            $this->salary,
            $this->startDate,
            $this->awards
        );
    }

    public function toArray(): array {
        return array_merge(parent::toArray(), [
            'jobTitle' => $this->jobTitle,
            'salary' => $this->salary,
            'startDate' => $this->startDate,
            'awards' => $this->awards
        ]);
    }
}