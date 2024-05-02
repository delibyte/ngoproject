<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'donor_id' => User::all()->random()->id,
            'type' => fake()->randomElement(['cash', 'food', 'furniture', 'clothing']),
            'amount' => fake()->numberBetween(3, 15),
            'approval' => fake()->randomElement(['pending', 'accepted', 'rejected']),
            'delivery_type' => 'by-us',
            'collected' => false
        ];
    }
}
