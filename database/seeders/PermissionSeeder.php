<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array berisi permission yang akan dibuat
        $permissions = [
            'Edit',
            'Delete',
            'Create',
            'Assign',
        ];

        // Loop melalui setiap permission dan buat satu persatu
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
