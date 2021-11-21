<?php

namespace Unit;


use App\Domain\Outlet;
use Faker\Factory as Faker;
use TestCase;

class OutletTest extends TestCase
{
    private \Faker\Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
    }

    public function testItShouldCreateOutlet()
    {
        $payloads = [
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'address' => $this->faker->address,
            'longitude' => $this->faker->longitude,
            'latitude' => $this->faker->latitude,
        ];

        $brand = Outlet::create($payloads);
        $this->assertInstanceOf(Outlet::class, $brand);
    }

    public function testCreateOutletErrorNoName()
    {
        $payloads = [
            'picture' => $this->faker->firstName,
            'address' => $this->faker->address,
            'longitude' => $this->faker->longitude,
            'latitude' => $this->faker->latitude,
        ];

        $this->expectExceptionMessage('The name field is required.');
        Outlet::create($payloads);
    }

    public function testCreateOutletErrorNoPicture()
    {
        $payloads = [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'longitude' => $this->faker->longitude,
            'latitude' => $this->faker->latitude,
        ];

        $this->expectExceptionMessage('The picture field is required.');
        Outlet::create($payloads);
    }

    public function testCreateOutletErrorNoAddress()
    {
        $payloads = [
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'longitude' => $this->faker->longitude,
            'latitude' => $this->faker->latitude,
        ];

        $this->expectExceptionMessage('The address field is required.');
        Outlet::create($payloads);
    }

    public function testCreateOutletErrorNoLongitude()
    {
        $payloads = [
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
        ];

        $this->expectExceptionMessage('The longitude field is required.');
        Outlet::create($payloads);
    }

    public function testCreateOutletErrorNoLatitude()
    {
        $payloads = [
            'name' => $this->faker->name,
            'picture' => $this->faker->firstName,
            'address' => $this->faker->address,
            'longitude' => $this->faker->longitude,
        ];

        $this->expectExceptionMessage('The latitude field is required.');
        Outlet::create($payloads);
    }
}
