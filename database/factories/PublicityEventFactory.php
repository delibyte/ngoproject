<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PublicityEvent>
 */
class PublicityEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ucwords(fake()->words(2, true)) . ' Event',
            'description' => fake()->paragraphs(2, true),
            'held_at' => fake()->dateTimeBetween( now(), '+2 day' )
        ];
    }
}
