<?php

namespace Users;
use Models\User;

class Employee extends User{
    private string $jobTitle;
    private float $salary;
    private string $startDate;
    private string $awards;

    public function __construct(
        int $id, string $firstName, string $lastName, string $email,
        string $password, string $phoneNumber, string $address,
        \DateTime $birthDate, \DateTime $membershipExpirationDate, string $role,
        string $jobTitle, float $salary, string $startDate, string $awards
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
}