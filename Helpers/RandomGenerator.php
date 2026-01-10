<?php
namespace Helpers;

use Faker\Factory;
use Users\User;
use Users\BasicUser;
use Users\Employee;
use Companies\Company;
use Restaurants\RestaurantLocation;
use Restaurants\RestaurantChain;
use DateTime;

class RandomGenerator {
    public static function createUserData(): array{
        $faker = Factory::create();

        return [
            'id' => $faker->randomNumber(),
            'firstName' => $faker->firstName(),
            'lastName' => $faker->lastName(),
            'email' => $faker->email,
            'password' => $faker->password,
            'phoneNumber' => $faker->phoneNumber,
            'address' => $faker->address,
            'birthDate' => new DateTime($faker->date('Y-m-d')),
            'isActive' => $faker->boolean(),
            'membershipExpirationDate' => new DateTime($faker->date('Y-m-d', '+20 years')),
        ];
    }

    public static function user(): BasicUser {
        $user  = self::createUserData();
        $user['role'] = 'user';
        return new BasicUser(
            $user['id'],
            $user['firstName'],
            $user['lastName'],
            $user['email'],
            $user['password'],
            $user['phoneNumber'],
            $user['address'],
            $user['birthDate'],
            $user['isActive'],
            $user['membershipExpirationDate']
        );
    }

    public static function users(int $min, int $max): array {
        $faker = Factory::create();
        $users = [];
        $numOfUsers = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfUsers; $i++) {
            $users[] = self::user();
        }

        return $users;
    }

    public static function employee(): Employee {
        $faker = Factory::create();

        $employee = self::createUserData();

        $employee['role'] = 'employee';
        $employee['jobTitle'] = $faker->jobTitle();
        $employee['salary'] = $faker->randomFloat(2, 30000, 120000);
        $employee['startDate'] = $faker->date();
        $employee['awards'] = implode(', ', $faker->words($faker->numberBetween(0, 5)));

        return new Employee(
            $employee['id'],
            $employee['firstName'],
            $employee['lastName'],
            $employee['email'],
            $employee['password'],
            $employee['phoneNumber'],
            $employee['address'],
            $employee['birthDate'],
            $employee['isActive'],
            $employee['membershipExpirationDate'],
            $employee['jobTitle'],
            $employee['salary'],
            $employee['startDate'],
            $employee['awards']
        );
    }

    public static function employees(int $min, int $max): array {
        $faker = Factory::create();
        $employees = [];
        $numOfEmployees = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfEmployees; $i++) {
            $employees[] = self::employee();
        }

        return $employees;
    }

    public static function createCompanyData(): array{
        $faker = Factory::create();

            return  [
            'name' => $faker->company(),
            'foundingYear' => $faker->year(),
            'description' => $faker->catchPhrase(),
            'website' => $faker->url(),
            'phone' => $faker->phoneNumber(),
            'ceo' => $faker->name(),
            'industry' => $faker->word(),
            'isPubliclyTraded' => $faker->boolean(),
            'country' => $faker->country(),
            'founder' => $faker->name(),
            'totalEmployees' => $faker->numberBetween(50, 10000),
        ];
    }

    public static function company(): Company {
        $company  = self::createCompanyData();

        return new Company(
            $company['name'],
            $company['foundingYear'],
            $company['description'],
            $company['website'],
            $company['phone'],
            $company['ceo'],
            $company['industry'],
            $company['isPubliclyTraded'],
            $company['country'],
            $company['founder'],
            $company['totalEmployees']
        );
    }

    public static function companies(int $min, int $max): array {
        $faker = Factory::create();
        $companies = [];
        $numOfCompanies = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfCompanies; $i++) {
            $companies[] = self::company();
        }

        return $companies;
    }

    public static function restaurantLocation(): RestaurantLocation {
        $faker = Factory::create();
        
        $restaurantLocation['name'] = $faker->company();
        $restaurantLocation['address'] = $faker->address();
        $restaurantLocation['city'] = $faker->city();
        $restaurantLocation['state'] = $faker->state();
        $restaurantLocation['zipCode'] = $faker->postcode();
        $restaurantLocation['employee'] = self::employee();
        $restaurantLocation['isOpen'] = $faker->boolean();

        return new RestaurantLocation(
            $restaurantLocation['name'],
            $restaurantLocation['address'],
            $restaurantLocation['city'],
            $restaurantLocation['state'],
            $restaurantLocation['zipCode'],
            $restaurantLocation['employee'],
            $restaurantLocation['isOpen']
        );
    }

    public static function restaurantLocations(int $min, int $max): array {
        $faker = Factory::create();
        $restaurantLocations = [];
        $numOfLocations = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfLocations; $i++) {
            $restaurantLocations[] = self::restaurantLocation();
        }

        return $restaurantLocations;
    }

    public static function restaurantChain(): RestaurantChain{
        $faker = Factory::create();

        $restaurantChain = self::createCompanyData();

        $restaurantChain['chainId'] = $faker->randomNumber();
        $restaurantChain['restaurantLocation'] = null;
        $restaurantChain['cuisineType'] = $faker->word();
        $restaurantChain['numberOfLocations'] = 0;
        $restaurantChain['hasDriveThru'] = $faker->boolean();
        $restaurantChain['yearFounded'] = $faker->year();
        $restaurantChain['parentCompany'] = $faker->company();

        return new RestaurantChain(
            $restaurantChain['name'],
            $restaurantChain['foundingYear'],
            $restaurantChain['description'],
            $restaurantChain['website'],
            $restaurantChain['phone'],
            $restaurantChain['industry'],
            $restaurantChain['ceo'],
            $restaurantChain['isPubliclyTraded'],
            $restaurantChain['country'],
            $restaurantChain['founder'],
            $restaurantChain['totalEmployees'],
            $restaurantChain['chainId'],
            $restaurantChain['restaurantLocation'],
            $restaurantChain['cuisineType'],
            $restaurantChain['numberOfLocations'],
            $restaurantChain['hasDriveThru'],
            $restaurantChain['yearFounded'],
            $restaurantChain['parentCompany']
        );
    }

public static function restaurantChains(int $min, int $max): array
{
    $count = rand($min, $max);
    $chains = [];

    for ($i = 0; $i < $count; $i++) {
        $chain = self::restaurantChain();

        $locCount = rand(1, 3);
        for ($j = 0; $j < $locCount; $j++) {
            $loc = self::restaurantLocation();

            $empCount = rand(1, 3);
            for ($k = 0; $k < $empCount; $k++) {
                $loc->addEmployee(self::employee()); 
            }

            $chain->addLocation($loc);
        }

        $chains[] = $chain;
    }

    return $chains;
}
}