<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AreaSeeder::class,
            WarehouseSeeder::class,
            RoleSeeder::class,
            DonationTypeSeeder::class,
            UserSeeder::class,
            VolunteerSeeder::class,
            DonorSeeder::class,
            DonationSeeder::class,
            WarehouseItemSeeder::class,
            IndigentSeeder::class,
            ExternalNotificationSeeder::class,
            BankLogSeeder::class
        ]);

    }
}
