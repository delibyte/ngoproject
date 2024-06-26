<?php

namespace Database\Factories;

use App\Models\DonationType;
use App\Models\Donor;
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
            'donor_id' => Donor::all()->random()->id,
            'type_id' => DonationType::all()->random()->id,
            'amount' => fake()->numberBetween(3, 15),
            'approval' => fake()->randomElement(['pending', 'accepted', 'rejected']),
            'delivery_type' => 'by-us',
            'collected' => false
        ];
    }
}
