<?php

namespace Unit;


use App\Domain\Brand;
use Faker\Factory as Faker;
use TestCase;

class BrandTest extends TestCase
{
    private \Faker\Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
    }

    public function testItShouldCreateBrand()
    {
        $payloads = [
            'name' => $this->faker->name,
            'logo' => $this->faker->firstName,
            'banner' => $this->faker->text,
        ];

        $brand = Brand::create($payloads);
        $this->assertInstanceOf(Brand::class, $brand);
    }

    public function testCreateBrandErrorNoName()
    {
        $payloads = [
            'logo' => $this->faker->firstName,
            'banner' => $this->faker->text,
        ];

        $this->expectExceptionMessage('The name field is required.');
        Brand::create($payloads);
    }

    public function testCreateBrandErrorNoLogo()
    {
        $payloads = [
            'name' => $this->faker->name,
            'banner' => $this->faker->text,
        ];

        $this->expectExceptionMessage('The logo field is required.');
        Brand::create($payloads);
    }

    public function testCreateBrandErrorNoBanner()
    {
        $payloads = [
            'name' => $this->faker->name,
            'logo' => $this->faker->firstName,
        ];

        $this->expectExceptionMessage('The banner field is required.');
        Brand::create($payloads);
    }
}
