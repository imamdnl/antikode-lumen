# Lumen PHP Framework - Project Antikode

- SQL query file can be found on `docroot/query.sql`
- PHP version 7.4.20
- MySql version 5.7.32

### Setup
- clone the repository
- install all dependecy by running `composer install`
- copy the `.env.example` file `cp .env.example .env`
- copy the `.env.testing.example` file `cp .env.testing.example .env.testing` to run the unit test
- edit the `.env` and `.env.testing` file value (primarily for database host and database password)
- create database with collation `utf8mb4` and run `php artisan migrate` to migrate the database
- run `php -S localhost:8008 -t public` to serve on localhost

### Code Structure

- `routes` are defined under `routes/web.php`
- `models` are located under the `App/Adapters/Gateways/Database` namespace
- `controllers` are located under the `App/Http/Controllers` namespace
- `usecase` are located under the `App/UseCase` namespace

### Tests

- test files are located under the `tests` directory
- unit test can be used to generate fake data
