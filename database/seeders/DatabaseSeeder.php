<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();



        //     Permission::create(['name' => 'Create-City', 'guard_name' => 'admin']);
        //     Permission::create(['name' => 'Read-Cities', 'guard_name' => 'admin']);
        //     Permission::create(['name' => 'Update-City', 'guard_name' => 'admin']);
        //     Permission::create(['name' => 'Delete-City', 'guard_name' => 'admin']);

        //     Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        //     Permission::create(['name' => 'Read-Admins', 'guard_name' => 'admin']);
        //     Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        //     Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);


        //     Permission::create(['name' => 'Create-User', 'guard_name' => 'admin']);
        //     Permission::create(['name' => 'Read-Users', 'guard_name' => 'admin']);
        //     Permission::create(['name' => 'Update-User', 'guard_name' => 'admin']);
        //     Permission::create(['name' => 'Delete-User', 'guard_name' => 'admin']);


        //     Permission::create(['name' => 'Create-Permissions', 'guard_name' => 'admin']);
        //     Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);
        //     Permission::create(['name' => 'Update-Permissions', 'guard_name' => 'admin']);
        //     Permission::create(['name' => 'Delete-Permissions', 'guard_name' => 'admin']);


        //     Permission::create(['name' => 'Create-City', 'guard_name' => 'user']);
        //     Permission::create(['name' => 'Read-Cities', 'guard_name' => 'user']);
        //     Permission::create(['name' => 'Update-City', 'guard_name' => 'user']);
        //     Permission::create(['name' => 'Delete-City', 'guard_name' => 'user']);
        Permission::create(['name' => 'Create-City', 'guard_name' => 'user-api']);
        Permission::create(['name' => 'Read-Cities', 'guard_name' => 'user-api']);
        Permission::create(['name' => 'Update-City', 'guard_name' => 'user-api']);
        Permission::create(['name' => 'Delete-City', 'guard_name' => 'user-api']);
    }
}
