<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleTracker>
 */
class VehicleTrackerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $manufacturer = $this->faker->randomElement(['Toyota', 'Mercedez Benz', 'Honda']);
        $model = $this->faker->randomElement(['Camry', 'Corolla', 'HighLander']);
        $year = $this->faker->randomElement(['2017', '2016', '2014']);
        return [
            'user_id' => User::factory(),
            'manufacturer' => $manufacturer,
            'model' => $model,
            'year' => $year,
        ];
    }
}
