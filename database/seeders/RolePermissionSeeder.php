<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Roles
        $super_admin_role = Role::create(['name' => 'Superadmin']);
        $admin_role = Role::create(['name' => 'Admin']);

        // Permission List as array
        $permissions = [
            [
                'group_name' => 'Dashboard',
                'permissions' => [
                    'dashboard.view',
                ]
            ],
            [
                'group_name' => 'Role',
                'permissions' => [
                    // role Permissions
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.mass_destroy'
                ]
            ],
            [
                'group_name' => 'Admin',
                'permissions' => [
                    // user Permissions
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.mass_destroy'
                ]
            ],
            [
                'group_name' => 'MainBusiness',
                'permissions' => [
                    'mainbusiness.create',
                    'mainbusiness.view',
                    'mainbusiness.edit',
                    'mainbusiness.delete',
                    'mainbusiness.mass_destroy'
                ]
            ],
            [
                'group_name' => 'EventCategory',
                'permissions' => [
                    'eventcategory.create',
                    'eventcategory.view',
                    'eventcategory.edit',
                    'eventcategory.delete',
                    'eventcategory.mass_destroy'
                ]
            ],
            [
                'group_name' => 'Author',
                'permissions' => [
                    'author.create',
                    'author.view',
                    'author.edit',
                    'author.delete',
                    'author.mass_destroy'
                ]
            ],
            [
                'group_name' => 'Event',
                'permissions' => [
                    'event.create',
                    'event.view',
                    'event.edit',
                    'event.delete',
                    'event.mass_destroy'
                ]
            ],
            [
                'group_name' => 'Member',
                'permissions' => [
                    'member.create',
                    'member.view',
                    'member.edit',
                    'member.delete',
                    'member.mass_destroy',
                    'member.approve',
                    'member.mass_approve',

                ]
            ],
            [
                'group_name' => 'BizCategory',
                'permissions' => [
                    'bizcategory.create',
                    'bizcategory.view',
                    'bizcategory.edit',
                    'bizcategory.delete',
                    'bizcategory.mass_destroy',
                ]
            ],
        ];


        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            $group = PermissionGroup::create(['name' => $permissionGroup]);
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_id' => $group->id]);
                $super_admin_role->givePermissionTo($permission);
                $permission->assignRole($super_admin_role);
                $admin_role->givePermissionTo($permission);
                $permission->assignRole($admin_role);
            }
        }
    }
}
