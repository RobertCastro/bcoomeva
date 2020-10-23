<?php

namespace Database\Factories;

use App\Models\Data;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Data::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $date = new DateTime();
        $now = $date->getTimestamp();
        
        return [
            "name" => $this->faker->name,
            "dni" => $this->faker->numberBetween(1111111111, 9999999999),
            // "number_table" => $this->faker->numberBetween(1,99),
            "key" => $this->faker->numberBetween(1111111111, 9999999999),
        ];
    }
}
