<?php

namespace Database\Factories;

use App\Adapters\Gateways\Database\Mysql\Model\BrandModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BrandModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'logo' => $this->faker->firstName,
            'banner' => $this->faker->text(),
        ];
    }
}
