<?php

namespace App\Repositories\Backend\Impls;

use App\DataTables\RolesDataTable;
use App\Http\Requests\RoleRequest;
use App\Models\PermissionGroup;
use App\Repositories\Backend\Interf\RoleRepository;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

class RoleRepositoryImpl implements RoleRepository
{
    public function getAll()
    {
        return Role::where('id','!=',1)->with('permissions')->latest();
    }
    public function create(RoleRequest $request): Role
    {
        $role = Role::create($request->safe(['name']));
        $role->syncPermissions($request->permissions);
        return $role;
    }

    public function update(Role $Role, $data): Role
    {
        $Role->update($data);
        $Role->syncPermissions($data['permissions']);
        return $Role;
    }

    public function delete(int $id)
    {
        Role::destroy($id);
    }

    public function massdelete(array $ids)
    {
        $entries = Role::whereIn('id', $ids)->get();

        foreach ($entries as $entry) {
            $entry->delete();
        }
    }

    public function roles(): Array
    {
        return Role::pluck('name','name')->all();
    }

    public function permissionGroupWithPermissions(): Collection
    {
        return PermissionGroup::with('permissions')->get();
    }

    public function serializeActivePermissionsBy($Role): Collection
    {
        return PermissionGroup::serializeActivePermissionsBy($Role);
    }

    public function getById($id): Role
    {
        return Role::with(['permissions'])->findOrFail($id);
    }

    public function DataTable(RolesDataTable $dataTable)
    {
        view()->share(['datatable' => true]);
        return $dataTable->render('backend.roles.index');
    }
}
