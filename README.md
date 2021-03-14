## About

Api wich allows you to register customers and get their details.

## Technologies

- Laravel 8
- Eloquent
- Sanctum

## Installation

- Clone the project
- Rename `.env.example` to `.env` and set your database connection and details. Database should be with utf8mb4_unicode_ci collation
- `composer install`
- `php artisan key:generate`
- `php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"`
- `php artisan migrate:fresh`
- `php artisan serve`

## Usage

- You have to be authorized to use the application. You could register or login to system:
- Example requests: <br />
    &nbsp; register: post request to `127.0.0.1:8000/api/register` with params `email`, `password` and `name` <br />
    &nbsp; login: post request to `127.0.0.1:8000/api/login` with params `email` and `password`
- After successful login you will receive a token which you have to send in every requests headers to use the application: <br />
    &nbsp; Authorization : Bearer {your token}
- Send post request to 127.0.0.1:8000/api/customer to add new customer
- Send get request to 127.0.0.1:8000/api/customer with optional filters (`name`, `city`, `company_name`, `iso_2`) to get list of customers
- Send get request to 127.0.0.1:8000/api/customer/{id} with customer's id to get specific customer details