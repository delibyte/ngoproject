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
        $type = ['cash', 'food', 'furniture', 'clothing'];
        $approval = ['pending', 'accepted', 'rejected'];

        return [
            'donor_id' => User::all()->random()->id,
            'type' => array_rand($type, 1),
            'amount' => fake()->numberBetween(3, 15),
            'approval' => array_rand($approval, 1),
            'delivery_type' => 'by_us',
            'collected' => fake()->boolean()
        ];
    }
}
