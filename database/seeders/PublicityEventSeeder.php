<?php

namespace Database\Seeders;

use App\Models\PublicityEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicityEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PublicityEvent::factory()->count(3)->create();
    }
}
