<?php

namespace App\Repositories\Backend\Impls;

use App\DataTables\AdminsDataTable;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Repositories\Backend\Interf\AdminRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AdminRepositoryImpl implements AdminRepository
{
    public function getAll()
    {
        return Admin::with('roles')->latest();
    }

    public function create(AdminRequest $request): Admin
    {
        $admin = Admin::create($request->validated());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $admin->assignRole($roles);
        $admin->assignRole($request->input('roles'));
        return $admin;
    }

    public function update(Admin $Admin, $data): Admin
    {
        $Admin->update($data);
        DB::table('model_has_roles')->where('model_id', $Admin->id)->delete();
        $roles = $data['roles'] ? $data['roles'] : [];
        $Admin->syncRoles($roles);
        return $Admin;
    }

    public function getBySlug($slug)
    {
        return Admin::where('slug',$slug)->first();
    }

    public function delete(int $id)
    {
        Admin::destroy($id);
    }

    public function DataTable(AdminsDataTable $dataTable)
    {
        view()->share(['datatable' => true]);
        return $dataTable->render('backend.admins.index');
    }
}
