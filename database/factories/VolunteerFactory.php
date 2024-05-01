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
        $availability = '{ "week1": { "Tuesday":"17:30-18:30", "Thursday":"23:00-24:00" } }';
        $status = ['pending', 'active', 'revoked'];

        return [
            'profession' => fake()->jobTitle(),
            'income' => fake()->randomNumber(5, true),
            'region_id' => Area::all()->random(),
            'transportation' => fake()->boolean(),
            'availability' => $availability,
            'status' => $status[array_rand($status)]
        ];
    }
}
