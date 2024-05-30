<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Donor;
use App\Models\Role;
use App\Models\User;

class DonorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_donor = Role::where('name', 'donor')->first();

        for ( $i = 0; $i < 10; $i++ )
        {
            $user = User::factory()->create();

            $user->roles()->attach($role_donor->id);

            Donor::factory()->create([
                'user_id' => $user->id
            ]);
        }
    }
}
