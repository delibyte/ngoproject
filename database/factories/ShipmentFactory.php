<?php

namespace Database\Factories;

use App\Models\Donation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipment>
 */
class ShipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'donation_id' => Donation::all()->random()->id,
            'receiver_id' => User::all()->random()->id, // TODO: Change User with Indigent
            'dispatcher_id' => User::all()->random()->id, // TODO: Change User with Volunteer
            'dispatcher_location' => fake()->address(),
            'estimated_delivery_time' => fake()->numberBetween(20,100)
        ];
    }
}
