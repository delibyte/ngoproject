<?php

namespace Database\Factories;

use App\Models\BankLog;
use App\Models\Donation;
use App\Models\DonationType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BankLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $previousAttr = [];
        $amount = fake()->numberBetween(50, 200);

        $donation = Donation::create([
            'donor_id' => User::all()->random()->id,
            'type_id' => DonationType::where('name', 'cash')->first()->id,
            'amount' => $amount,
            'approval' => 'accepted',
            'delivery_type' => 'to-us',
            'collected' => true
        ]);

        $attributes = [
            'donation_id' => $donation->id,
            'shipment_id' => null,
            'amount' => $amount,
            'balance' => $previousAttr ? $previousAttr["balance"] + $amount : 0,
            'type' => 'incoming'
        ];

        $previousAttr = $attributes;

        return $attributes;
    }
}
