<?php

use Illuminate\Database\Seeder;
use App\Admin;
use Spatie\Permission\Models\Role;
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
        // $this->call(UsersTableSeeder::class);
        //create superAdmin
        $superAdmin = Admin::create([
            'name' => 'Admin',
            'email' => 'Admin@test.com',
            'password' => Hash::make('123456789')
        ]);

        $superAdminRole = Role::create(['guard_name' => 'admin', 'name' => 'superAdmin']);
        $superAdmin->assignRole($superAdminRole);
    }
}
