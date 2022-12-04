<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =  Admin::create([
            'name' => "Super Admin",
            'email' => "superadmin@admin.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now()
        ]);

        $role = Role::first();
        $permissions = Permission::all();

        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

    }
}
