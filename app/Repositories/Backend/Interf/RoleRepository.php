<?php

namespace App\Repositories\Backend\Interf;

use App\DataTables\RolesDataTable;
use App\Http\Requests\RoleRequest;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

interface  RoleRepository
{
    public function getAll();
    public function create(RoleRequest $request): Role;
    public function update(Role $Role, $data): Role;
    public function delete(int $id);
    public function massdelete(array $ids);
    public function roles(): Array;
    public function permissionGroupWithPermissions(): Collection;
    public function serializeActivePermissionsBy($Role): Collection;
    public function getById($id): Role;
    public function DataTable(RolesDataTable $dataTable);
}
