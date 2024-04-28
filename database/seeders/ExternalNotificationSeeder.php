<?php

namespace Database\Seeders;

use App\Models\ExternalNotification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExternalNotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExternalNotification::factory()->count(10)->create();
    }
}
