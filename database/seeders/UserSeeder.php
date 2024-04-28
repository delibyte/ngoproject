<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;

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
        $role_admin = Role::where('name', 'administrator')->first();
        $role_volunteer = Role::where('name', 'volunteer')->first();
        $role_donor = Role::where('name', 'donor')->first();
        $role_coordinator = Role::where('name', 'coordinator')->first();
        $role_indigent = Role::where('name', 'indigent')->first();

        for ( $i = 0; $i < 10; $i++ )
        {
            User::factory()->create([
                'name' => 'Faker '.Str::random(10),
                'email' => Str::random(10).'@example.com',
                'password' => Hash::make('password'),
                'status' => 'pending',
                'phone' => fake()->e164PhoneNumber(),
                'address' => fake()->address()
            ]);
        }

        $user_admin = User::factory()->create([
            'name' => 'Admin Williams',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'status' => 'active',
            'phone' => fake()->e164PhoneNumber(),
            'address' => fake()->address()
        ]);


        $user_volunteer = User::factory()->create([
            'name' => 'Volunteer Williams',
            'email' => 'volunteer@gmail.com',
            'password' => Hash::make('password'),
            'status' => 'active',
            'phone' => fake()->e164PhoneNumber(),
            'address' => fake()->address()
        ]);

        $user_admin->roles()->attach($role_admin->id);
        $user_volunteer->roles()->attach($role_volunteer->id);
    }
}
