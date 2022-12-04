<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Repositories\Backend\Interf\AdminRepository;
use App\Repositories\Backend\Interf\RoleRepository;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    private AdminRepository $repository;
    private RoleRepository $roleRepository;

    public function __construct(AdminRepository $repository, RoleRepository $roleRepository)
    {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
        $this->middleware('permission:admin.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admin.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:admin.view', ['only' => ['index']]);
        $this->middleware('permission:admin.delete', ['only' => ['destroy']]);
    }

    public function index(AdminsDataTable $dataTable)
    {
        return $this->repository->DataTable($dataTable);
    }

    public function create()
    {
        $roles = $this->roleRepository->roles();
        return view('backend.admins.create', compact('roles'));
    }

    public function store(AdminRequest $request)
    {
        $this->repository->create($request);

        return redirect()
            ->route('backend.admins.index')
            ->with(['success' => 'Successfully Added']);
    }

    public function edit($slug)
    {
        $admin = $this->repository->getBySlug($slug);
        $roles = $this->roleRepository->roles();
        $adminroles = $admin->roles->pluck('name')->first();
        return view('backend.admins.edit', compact('admin', 'roles', 'adminroles'));
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $this->repository->update($admin, $request->validated());

        return redirect()->route('backend.admins.index')->with(['success' => 'Successfully Updated!']);
    }

    public function destroy(Request $request)
    {
        $this->repository->delete($request->id);
        return redirect()->back()->with(['success' => 'Successfully Deleted!']);
    }
    public function show(){
        $admin_slug=Admin::findorFail(auth()->id())->slug;
        $admin = $this->repository->getBySlug($admin_slug);
        $roles = $this->roleRepository->roles();
        $adminroles = $admin->roles->pluck('name')->first();
        return view('backend.admins.profile', compact('admin', 'roles', 'adminroles'));
    }
}
