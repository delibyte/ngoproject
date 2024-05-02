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
            UserSeeder::class,
            VolunteerSeeder::class,
            DonationTypeSeeder::class,
            ProjectSeeder::class,
            DonationSeeder::class,
            IndigentSeeder::class,
            ExternalNotificationSeeder::class
        ]);

    }
}
