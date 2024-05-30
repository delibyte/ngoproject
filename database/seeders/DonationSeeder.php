<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\Donor;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $donors = Donor::where('status', 'active')->get();

        foreach ($donors as $donor) {
            Donation::factory()->count(20)->create([
                    'donor_id' => $donor->id
            ]);
        }
    }
}
