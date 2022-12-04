<?php

namespace App\Repositories\Backend\Interf;

use App\DataTables\AdminsDataTable;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Collection;

interface  AdminRepository
{
    public function getAll();
    public function create(AdminRequest $request): Admin;
    public function update(Admin $admin,$data): Admin;
    public function getBySlug($slug);
    public function delete(int $id);
    public function DataTable(AdminsDataTable $dataTable);
}
