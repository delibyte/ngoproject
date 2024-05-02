<?php

namespace Database\Seeders;

use App\Models\Indigent;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndigentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_indigent = Role::where('name', 'indigent')->first();

        for ( $i = 0; $i < 40; $i++ )
        {
            $user = User::factory()->create();

            $user->roles()->attach($role_indigent->id);

            Indigent::factory()->create([
                'user_id' => $user->id,
                'is_child' => false
            ]);
        }

        for ( $i = 0; $i < 20; $i++ )
        {
            Indigent::factory()->create([
                'is_child' => true,
                'parent_id' => Indigent::where('is_child', false)->get()->random()->id,
            ]);
        }
    }
}
