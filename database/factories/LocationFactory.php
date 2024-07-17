<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vehicle_tracker_id' => \App\Models\VehicleTracker::factory(),
            'latitude' => $this->faker->latitude($min = -90, $max = 90),
            'longitude' => $this->faker->longitude($min = -180, $max = 180),
        ];
    }
}
