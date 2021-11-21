<?php

namespace Database\Factories;

use App\Adapters\Gateways\Database\Mysql\Model\ProductModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'picture' => $this->faker->colorName,
            'price' => $this->faker->randomDigitNotNull,
        ];
    }
}
