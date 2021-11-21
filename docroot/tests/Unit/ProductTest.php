<?php

namespace Unit;


use App\Domain\Product;
use Faker\Factory as Faker;
use TestCase;

class ProductTest extends TestCase
{
    private \Faker\Generator $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
    }

    public function testItShouldCreateProduct()
    {
        $payloads = [
            'name' => $this->faker->name,
            'picture' => $this->faker->colorName,
            'price' => $this->faker->randomDigitNotNull,
        ];

        $brand = Product::create($payloads);
        $this->assertInstanceOf(Product::class, $brand);
    }

    public function testCreateProductErrorNoName()
    {
        $payloads = [
            'picture' => $this->faker->colorName,
            'price' => $this->faker->randomDigitNotNull,
        ];

        $this->expectExceptionMessage('The name field is required.');
        Product::create($payloads);
    }

    public function testCreateProductErrorNoPicture()
    {
        $payloads = [
            'name' => $this->faker->name,
            'price' => $this->faker->randomDigitNotNull,
        ];

        $this->expectExceptionMessage('The picture field is required.');
        Product::create($payloads);
    }

    public function testCreateProductErrorNoPrice()
    {
        $payloads = [
            'name' => $this->faker->name,
            'picture' => $this->faker->colorName,
        ];

        $this->expectExceptionMessage('The price field is required.');
        Product::create($payloads);
    }
}
