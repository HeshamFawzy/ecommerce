<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['guard_name' => 'admin', 'name' => 'superAdmin']);
        Role::create(['guard_name' => 'admin', 'name' => 'Ordered']);
        Role::create(['guard_name' => 'admin', 'name' => 'Chopping']);
        Role::create(['guard_name' => 'admin', 'name' => 'Finishing']);
        Role::create(['guard_name' => 'admin', 'name' => 'Delivered']);
        Role::create(['guard_name' => 'admin', 'name' => 'Done']);
    }
}
