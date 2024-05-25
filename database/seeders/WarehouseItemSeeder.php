<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = Donation::all()->random(30);

        foreach ( $items as $item )
        {
            $item->warehouse_id = Warehouse::all()->random()->id;
            $item->approval = "accepted";
            $item->collected = true;
            $item->save();
        }
    }
}
