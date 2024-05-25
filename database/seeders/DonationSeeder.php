<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $donors = User::whereHas('roles', function (Builder $query) {
            $query->where('name', 'donor');
        })->take(5)->get();

        foreach ($donors as $donor) {
            Donation::factory()->count(20)->create([
                    'donor_id' => $donor->id
            ]);
        }
    }
}
