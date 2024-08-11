<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array of roles to seed
        $roles = ['Admin', 'Employee', 'Leader'];

        // Loop through each role
        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
                'guard_name' => 'web', // Set guard_name to 'web'
            ]);
        }
    }
}
