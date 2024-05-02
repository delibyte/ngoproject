<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_names=['volunteer', 'donor', 'administrator', 'coordinator', 'indigent'];
        foreach($role_names as $role_name)
        {
            $role = new Role;
            $role->name = $role_name;
            $role->save();
        }
    }
}
