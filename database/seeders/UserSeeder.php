<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\DonationType;
use App\Models\Donor;
use App\Models\Indigent;
use App\Models\Role;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve Roles
        $role_admin = Role::where('name', 'administrator')->first();
        $role_volunteer = Role::where('name', 'volunteer')->first();
        $role_donor = Role::where('name', 'donor')->first();
        $role_coordinator = Role::where('name', 'coordinator')->first();
        $role_indigent = Role::where('name', 'indigent')->first();

        // Create Generic User Accounts
        User::factory()->count(10)->create();

        // Create Donors
        for ( $i = 0; $i < 10; $i++ )
        {
            $user = User::factory()->create();
            $user->roles()->attach($role_donor->id);
        }

        // Create Administator User
        $user_admin = User::factory()->create([
            'name' => 'Admin Williams',
            'email' => 'admin@ngo.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
        $user_admin->roles()->attach($role_admin->id);

        // Create Coordinator User
        $user_coordinator = User::factory()->create([
            'name' => 'Coordinator Williams',
            'email' => 'coordinator@ngo.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
        $user_coordinator->roles()->attach($role_coordinator->id);

        // Create Volunteer User
        $user_donor = User::factory()->create([
            'name' => 'Donor Williams',
            'email' => 'donor@ngo.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
        $user_donor->roles()->attach($role_donor->id);
        Donor::create([
            'user_id' => $user_donor->id,
            'region_id' => Area::all()->random()->id,
            'income' => 23330,
            'status' => 'active'
        ]);

        // Create Volunteer User
        $user_volunteer = User::factory()->create([
            'name' => 'Volunteer Williams',
            'email' => 'volunteer@ngo.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
        $user_volunteer->roles()->attach($role_volunteer->id);
        Volunteer::create([
            'user_id' => $user_volunteer->id,
            'profession' => 'Tester',
            'region_id' => Area::all()->random()->id,
            'income' => 1000,
            'transportation' => true,
            'status' => 'active'
        ]);


        // Create Indigent User
        $user_indigent = User::factory()->create([
            'name' => 'Indigent Williams',
            'email' => 'indigent@ngo.com',
            'password' => Hash::make('password'),
            'status' => 'active',
        ]);
        $user_indigent->roles()->attach($role_indigent->id);
        Indigent::create([
            'user_id' => $user_indigent->id,
            'region_id' => Area::all()->random()->id,
            'income' => 1000,
            'expenditure' => 800,
            'aid_type' => DonationType::all()->random()->id,
            'status' => 'active'
        ]);
    }
}
