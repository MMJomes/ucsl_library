<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public static function  serializeActivePermissionsBy(Role $role)
    {
        $permissionGroup = PermissionGroup::with('permissions')->get();
        foreach ($permissionGroup as $gKey => $group) {
            $isCheckedGroup = '';
            foreach ($group->permissions as $key => $permission) {
                foreach ($role->permissions as $rolepermission) {
                    if ($rolepermission->id === $permission->id) {
                        $group->permissions[$key]['isChecked'] = 'checked';
                        break;
                    } else {
                        $group->permissions[$key]['isChecked'] = '';
                    }
                }
                if ($group->permissions[$key]['isChecked'] == '') {
                    $isCheckedGroup = '';
                } else {
                    $isCheckedGroup = 'checked';
                }
            }
            $permissionGroup[$gKey]['isChecked'] = $isCheckedGroup;
        }
        return $permissionGroup;
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'group_id', 'id');
    }
}
