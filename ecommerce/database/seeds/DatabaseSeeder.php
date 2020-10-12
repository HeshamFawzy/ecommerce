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
        //seed roles
        $this->call(RolesSeeder::class);
        //seed superAdmin
        $this->call(SuperAdminSeeder::class);
        //seed colors
        $this->call(ColorsSeeder::class);
        //seed sizes
        $this->call(SizesSeeder::class);
        //seed parts
        $this->call(PartsSeeder::class);
        //seed categories
        $this->call(CategoriesTableSeeder::class);
    }
}
