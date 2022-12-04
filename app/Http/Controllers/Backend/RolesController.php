<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\RolesDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RoleRequest;
use App\Repositories\Backend\Interf\RoleRepository;

class RolesController extends Controller
{
    private RoleRepository $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('permission:role.create', ['only' => ['create','store']]);
        $this->middleware('permission:role.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role.view', ['only' => ['index']]);
        $this->middleware('permission:role.delete', ['only' => ['destroy']]);
    }

    public function index(RolesDataTable $dataTable)
    {
        return $this->repository->DataTable($dataTable);
    }

    public function create()
    {
        $permissionGroup = $this->repository->permissionGroupWithPermissions();
        view()->share(['rolesJS' => true]);
        return view('backend.roles.create', compact('permissionGroup'));
    }

    public function store(RoleRequest $request)
    {
        $this->repository->create($request);
        return redirect()->route('backend.roles.index')->with(['success' => 'Successfully Added!']);
    }

    public function edit($id)
    {
        $role = $this->repository->getById($id);
        if ($role) {
            $permissionGroup = $this->repository->serializeActivePermissionsBy($role);
            view()->share(['rolesJS' => true]);
            return view('backend.roles.edit', compact('permissionGroup', 'role'));
        }
        return redirect('404');
    }

    public function update(RoleRequest $request, Role $role)
    {
        $this->repository->update($role, $request->validated());
        return redirect()->route('backend.roles.index')->with(['success' => 'Successfully Updated!']);
    }

    public function destroy(Request $request)
    {
        $this->repository->delete($request->id);
        return redirect()->back()->with(['success' => 'Successfully Deleted!']);
    }
}
