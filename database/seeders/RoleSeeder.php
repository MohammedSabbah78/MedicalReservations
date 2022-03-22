<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Role::create(['name'=>'Super-Admin','guard_name'=>'admin']);
        Role::create(['name' => 'Content Manegment', 'guard_name' => 'admin']);
        Role::create(['name' => 'HR', 'guard_name' => 'admin']);

    }
}
