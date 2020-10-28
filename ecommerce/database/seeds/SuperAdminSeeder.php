<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Admin::create([
            'name' => 'Admin',
            'email' => 'Admin@cashmere-ey.com',
            'password' => Hash::make('123456789')
        ]);

        $role = Role::findByName('superAdmin', 'admin');

        $superAdmin->assignRole($role);
    }
}
