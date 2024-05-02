<?php

namespace Database\Seeders;

use App\Models\DonationType;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $donation_cash = DonationType::where('name', 'cash')->first()->id;
        $donation_furniture = DonationType::where('name', 'furniture')->first()->id;
        $donation_food = DonationType::where('name', 'food')->first()->id;
        $donation_clothing = DonationType::where('name', 'clothing')->first()->id;
        $donation_types = [$donation_clothing, $donation_cash, $donation_food, $donation_furniture];

        $projects = Project::factory()->count(4)->create();

        foreach($projects as $project)
        {
            $project->donationtypes()->attach(fake()->randomElements($donation_types, null));
        }
    }
}
