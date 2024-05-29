<?php

namespace Database\Factories;

use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Volunteer>
 */
class VolunteerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'profession' => fake()->jobTitle(),
            'income' => fake()->randomNumber(5, true),
            'region_id' => Area::all()->random()->id,
            'transportation' => fake()->boolean(),
            'status' => fake()->randomElement(['pending', 'active', 'revoked'])
        ];
    }
}
