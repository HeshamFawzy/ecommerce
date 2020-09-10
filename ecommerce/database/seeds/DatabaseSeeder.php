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
        //create superAdmin
        $superAdmin = Admin::create([
            'name' => 'Admin',
            'email' => 'Admin@test.com',
            'password' => Hash::make('123456789')
        ]);

        $superAdminRole = Role::create(['guard_name' => 'admin', 'name' => 'superAdmin']);
        $superAdmin->assignRole($superAdminRole);

        //seed colors
        $this->call(ColorsSeeder::class);
        //seed sizes
        $this->call(SizesSeeder::class);


        //seed systemUsers
        $this->call(AdminsTableSeeder::class);
        //seed users
        $this->call(UsersTableSeeder::class);

        //seed categories
        $this->call(CategoriesTableSeeder::class);
    }
}
