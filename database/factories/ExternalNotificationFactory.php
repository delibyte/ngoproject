<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExternalNotification>
 */
class ExternalNotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = ['email', 'sms'];

        return [
            'type' => $type[array_rand($type, 1)],
            'receiver_id' => User::all()->random()->id,
            'subject' => fake()->text()
        ];
    }
}
