<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DonationType;

class DonationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $commodities=['clothing', 'cash', 'food', 'furniture'];

        foreach($commodities as $commodity)
        {
            $donationtype = new DonationType;
            $donationtype->name = $commodity;
            $donationtype->min_amount = ( $commodity == 'cash' ) ? 50: 1;
            $donationtype->save();
        }
    }
}
