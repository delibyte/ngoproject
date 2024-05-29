<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Role;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\Availability;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_volunteer = Role::where('name', 'volunteer')->first();

        for ( $i = 0; $i < 10; $i++ )
        {
            $user = User::factory()->create();

            $user->roles()->attach($role_volunteer->id);

            $volunteer = Volunteer::factory()->create([
                'user_id' => $user->id
            ]);

            Availability::factory()->count(4)->create([
                'volunteer_id' => $volunteer->id
            ]);
        }
    }
}
