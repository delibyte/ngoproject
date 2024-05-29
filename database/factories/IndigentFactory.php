<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\DonationType;
use App\Models\Indigent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Indigent>
 */
class IndigentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'region_id' => Area::all()->random()->id,
            'income' => fake()->randomNumber(5, true),
            'expenditure' => fake()->randomNumber(4, true),
            'parent_id' => null,
            'is_child' => fake()->boolean(),
            'educational_status' => fake()->randomElement(['illiterate', 'literate', 'primary', 'secondary', 'highschool', 'university', 'postgraduate', 'doctorate']),
            'aid_type' => DonationType::all()->random()->id,
            'status' => fake()->randomElement(['pending', 'active', 'revoked'])
       ];
    }
}
