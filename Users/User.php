<?php
namespace Users;

use DateTime;
use Shared\Interfaces\FileConvertible;

abstract class User implements FileConvertible {
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $hashedPassword;
    private string $phoneNumber;
    private string $address;
    private DateTime $birthDate;
    private bool $isActive = true;
    private DateTime $membershipExpirationDate;
    private string $role;

    public function __construct(
        int $id, string $firstName, string $lastName, string $email,
        string $hashedPassword, string $phoneNumber, string $address,
        DateTime $birthDate, bool $isActive, DateTime $membershipExpirationDate, string $role, bool $skipHash = false
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->hashedPassword = $skipHash ? $hashedPassword : password_hash($hashedPassword, PASSWORD_DEFAULT);
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->birthDate = $birthDate;
        $this->isActive = $isActive;
        $this->membershipExpirationDate = $membershipExpirationDate;
        $this->role = $role;
    }

    public function login(string $hashedPassword): bool {
        // Validate password with the hashed password
        return password_verify($hashedPassword, $this->hashedPassword);
    }

    public function updateProfile(string $address, string $phoneNumber): void {
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
    }

    public function renewMembership(DateTime $expirationDate): void {
        $this->membershipExpirationDate = $expirationDate;
    }

    public function changePassword(string $newPassword): void {
        $this->hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    }

    public function hasMembershipExpired(): bool {
        $currentDate = new DateTime();
        return $currentDate > $this->membershipExpirationDate;
    }

    public function toString(): string {
        return sprintf(
            "User ID: %d\nName: %s %s\nEmail: %s\nHashed Password: %s\nPhone Number: %s\nAddress: %s\nBirth Date: %s\nIs Active: %s\nMembership Expiration Date: %s\nRole: %s\n",
            $this->id,
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->hashedPassword,
            $this->phoneNumber,
            $this->address,
            $this->birthDate->format('Y-m-d'),
            $this->isActive ? 'Active' : 'Inactive',
            $this->membershipExpirationDate->format('Y-m-d'),
            $this->role
        );
    }

    public function toHTML(): string{
        return sprintf("
            <div class='user-card'>
                <div class='avatar'>User</div>
                <h2>%s %s</h2>
                <p>%s</p>
                <p>%s</p>
                <p>%s</p>
                <p>%s</p>
                <p>Birth Date: %s</p>
                <p>Is Active: %s</p>
                <p>Membership Expiration Date: %s</p>
                <p>Role: %s</p>
            </div>",
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->hashedPassword,
            $this->phoneNumber,
            $this->address,
            $this->birthDate->format('Y-m-d'),
            $this->isActive ? 'Active' : 'Inactive',
            $this->membershipExpirationDate->format('Y-m-d'),
            $this->role
        );
    }

    public function toMarkdown() : string {
        return "## User: {$this->firstName} {$this->lastName}
                 - Email: {$this->email}
                 - Hashed Password: {$this->hashedPassword}
                 - Phone Number: {$this->phoneNumber}
                 - Address: {$this->address}
                 - Birth Date: {$this->birthDate->format('Y-m-d')}
                 - Is Active: " . ($this->isActive ? 'Active' : 'Inactive') . "
                 - Membership Expiration Date: {$this->membershipExpirationDate->format('Y-m-d')}
                 - Role: {$this->role}";
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'hashedPassword' => $this->hashedPassword,
            'phoneNumber' => $this->phoneNumber,
            'address' => $this->address,
            'birthDate' => $this->birthDate,
            'isActive' => $this->isActive,
            'membershipExpirationDate' => $this->membershipExpirationDate,
            'role' => $this->role
        ];
    }
}

class BasicUser extends User
{
    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        string $hashedPassword,
        string $phoneNumber,
        string $address,
        DateTime $birthDate,
        bool $isActive,
        DateTime $membershipExpirationDate,
        bool $skipHash = false
    ) {
        parent::__construct(
            $id,
            $firstName,
            $lastName,
            $email,
            $hashedPassword,
            $phoneNumber,
            $address,
            $birthDate,
            $isActive,
            $membershipExpirationDate,
            'user',
            $skipHash
        );
    }
}