<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Availability>
 */
class AvailabilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_time = fake()->time('H:i');
        $end_time = fake()->time('H:i');

        if ( $start_time > $end_time )
        {
            $temp = $start_time;
            $start_time = $end_time;
            $end_time = $temp;
        }

        return [
            'week' => fake()->randomElement([1, 2, 3, 4, 5]),
            'day' => fake()->randomElement(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']),
            'start_time' => $start_time,
            'end_time' => $end_time,
        ];
    }
}
