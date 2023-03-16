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
            //1
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
            //2
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
            //3
            [
                'group_name' => 'Book',
                'permissions' => [
                    'book.create',
                    'book.view',
                    'book.edit',
                    'book.delete',
                    'book.mass_destroy',
                    'book.approve',
                    'book.mass_approve',

                ]
            ],
            //4
            [
                'group_name' => 'StduentCalss',
                'permissions' => [
                    'stduentCalss.create',
                    'stduentCalss.view',
                    'stduentCalss.edit',
                    'stduentCalss.delete',
                    'stduentCalss.mass_destroy',
                    'stduentCalss.approve',
                    'stduentCalss.mass_approve',

                ]
            ],
            //5
            [
                'group_name' => 'Stduent',
                'permissions' => [
                    'stduent.create',
                    'stduent.view',
                    'stduent.edit',
                    'stduent.delete',
                    'stduent.mass_destroy',
                    'stduent.approve',
                    'stduent.mass_approve',

                ]
            ],


            //6
            [
                'group_name' => 'StduentBookRent',
                'permissions' => [
                    'stduentBookRent.create',
                    'stduentBookRent.view',
                    'stduentBookRent.edit',
                    'stduentBookRent.delete',
                    'stduentBookRent.mass_destroy',
                    'stduentBookRent.approve',
                    'stduentBookRent.mass_approve',
                    'stduentBookRent.continue',
                    'stduentBookRent.rentStatus',

                ]
            ],
            //7
            [
                'group_name' => 'StduentBookPreRent',
                'permissions' => [
                    'stduentBookPreRent.create',
                    'stduentBookPreRent.view',
                    'stduentBookPreRent.edit',
                    'stduentBookPreRent.delete',
                    'stduentBookPreRent.mass_destroy',
                    'stduentBookPreRent.approve',
                    'stduentBookPreRent.mass_approve',
                    'stduentBookPreRent.continue',
                    'stduentBookPreRent.rentStatus',

                ]
            ],
            //8
            [
                'group_name' => 'StaffDepart',
                'permissions' => [
                    'staffDepart.create',
                    'staffDepart.view',
                    'staffDepart.edit',
                    'staffDepart.delete',
                    'staffDepart.mass_destroy',
                    'staffDepart.approve',
                    'staffDepart.mass_approve',

                ]
            ],
            //9
            [
                'group_name' => 'Staff',
                'permissions' => [
                    'staff.create',
                    'staff.view',
                    'staff.edit',
                    'staff.delete',
                    'staff.mass_destroy',
                    'staff.approve',
                    'staff.mass_approve',

                ]
            ],
            //10
            [
                'group_name' => 'StaffBookRent',
                'permissions' => [
                    'staffBookRent.create',
                    'staffBookRent.view',
                    'staffBookRent.edit',
                    'staffBookRent.delete',
                    'staffBookRent.mass_destroy',
                    'staffBookRent.approve',
                    'staffBookRent.mass_approve',
                    'staffBookRent.continue',
                    'staffBookRent.rentStatus',

                ]
            ],
            //11
            [
                'group_name' => 'StaffBookPreRent',
                'permissions' => [
                    'staffBookPreRent.create',
                    'staffBookPreRent.view',
                    'staffBookPreRent.edit',
                    'staffBookPreRent.delete',
                    'staffBookPreRent.mass_destroy',
                    'staffBookPreRent.approve',
                    'staffBookPreRent.mass_approve',
                    'staffBookPreRent.continue',
                    'staffBookPreRent.rentStatus',
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
