<?php

namespace Database\Factories;

use App\Models\Donation;
use App\Models\Indigent;
use App\Models\Volunteer;
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
            'receiver_id' => Indigent::all()->random()->id,
            'dispatcher_id' => Volunteer::all()->random()->id,
            'completion' => fake()->randomElement(['cancelled', 'ongoing', 'completed']),
        ];
    }
}
