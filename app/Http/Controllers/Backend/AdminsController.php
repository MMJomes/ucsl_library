<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AdminsDataTable;
use App\Helpers\AuthorHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Repositories\Backend\Interf\AdminRepository;
use App\Repositories\Backend\Interf\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{

    use AuthorHelper;
    private AdminRepository $repository;
    private RoleRepository $roleRepository;

    public function __construct(AdminRepository $repository, RoleRepository $roleRepository)
    {
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
        $this->middleware('permission:admin.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:admin.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:admin.view', ['only' => ['index']]);
        $this->middleware('permission:admin.delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $data = Admin::get();
            return $this->Author_datatable($data, $user);
        }

        $roles = $this->roleRepository->roles();
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('backend.admins.index', compact('roles'));
    }
    public function create()
    {
        $roles = $this->roleRepository->roles();
        return view('backend.admins.create', compact('roles'));
    }

    public function store(AdminRequest $request)
    {
        $admin = Admin::create($request->validated());
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $admin->assignRole($roles);
        $admin->assignRole($request->input('roles'));
        return redirect()
            ->route('backend.admins.index')
            ->with(['success' => 'Successfully Added']);
    }

    public function edit($id)
    {
        $admin = $this->repository->where('id', $id)->first();
        $roles = $this->roleRepository->roles();
        $adminroles = $admin->roles->pluck('name')->first();
        return view('backend.admins.edit', compact('admin', 'roles', 'adminroles'));
    }

    public function update(Request $request, $id)
    {
        $admin = $this->repository->where('id', $id)->first();
        if ($admin) {
            if ($admin == null) {
                $last_id = 1;
            } else {
                $id = Admin::latest()->first()->id;
                $last_id = $id + 1;
            }
            if ($request->hasfile('logos')) {
                $img = $request->file('logos');
                $upload_path = public_path() . '/upload/admin/';
                $file = $img->getClientOriginalName();
                $name = $last_id . $file;
                $img->move($upload_path, $name);
                $path = '/upload/admin/' . $name;
            } else {
                $path = "/default-user.png";
            }
            if ($request->password) {
                $password = $admin->password;
            } else {
                $password = Hash::make($request->password);
            }
            $request->merge(['image' => $path, 'password' => $password]);
           $data= $this->repository->updateById($admin->id, $request->all());
           if($data){
            DB::table('model_has_roles')->where('model_id', $data->id)->delete();
            $roles = $request->input('roles') ? $request->input('roles') : [];
            $admin->assignRole($roles);
            $admin->assignRole($request->input('roles'));
           }
            return redirect()->route('backend.admins.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }

    public function destroy(Request $request)
    {
        $this->repository->delete($request->id);
        return redirect()->back()->with(['success' => 'Successfully Deleted!']);
    }
    public function profile()
    {

        $admin = $this->repository->where('id', auth()->id())->first();
        $roles = $this->roleRepository->roles();
        $adminroles = $admin->roles->pluck('name')->first();
        return view('backend.admins.profile', compact('admin', 'roles', 'adminroles'));
    }
}
