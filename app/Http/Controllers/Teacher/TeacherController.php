<?php

namespace App\Http\Controllers\Teacher;
use App\Helpers\StduentHelper;
use App\Http\Controllers\Controller;
use App\Imports\AuthorListImport;
use App\Models\Teacher\Departement;
use App\Models\Teacher\Teacher;
use App\Repositories\Backend\Interf\StaffRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    use StduentHelper;
    private StaffRepository $StaffRepository;

    public function __construct(StaffRepository $StaffRepository)
    {
        $this->middleware('permission:event.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:event.edit', ['only' => ['edit']]);
        $this->middleware('permission:event.view', ['only' => ['index']]);
        $this->StaffRepository = $StaffRepository;
    }

    public function index()
    {
        $data = Teacher::with('department')->orderBy('totalNoOfBooks', 'DESC')->get();
        if (request()->ajax()) {
            $user = auth()->user();
            $data = Teacher::with('department')->orderBy('totalNoOfBooks', 'DESC')->get();
            return $this->Stduent_datatable($data, $user);
        }
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('staff.staff.index');
    }
    public function create()
    {
        $categories  = Departement::all();
        view()->share(['form' => true, 'select' => true]);
        return view('staff.staff.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $data1 = DB::table('teachers')->latest('id')->first();
        if ($data1 == null) {
            $last_id = 1;
        } else {
            $id = Teacher::latest()->first()->id;
            $last_id = $id + 1;
        }
        if ($request->hasfile('logos')) {
            $img = $request->file('logos');
            $upload_path = public_path() . '/upload/staff/';
            $file = $img->getClientOriginalName();
            $name = $last_id . $file;
            $img->move($upload_path, $name);
            $path = '/upload/staff/' . $name;
        } else {
            $path = "/default-user.png";
        }
        $request->merge([
            'image' => $path,
            'status' => 'on',
        ]);
        $this->StaffRepository->create($request->all());
        return redirect()
            ->route('staff.staffs.index')
            ->with(['success' => 'Successfully Added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $stduent = $this->StaffRepository->where('slug', $slug)->first();
        if ($stduent) {
            $categories = Departement::all();
            view()->share(['form' => true, 'select' => true]);
            return view('staff.staff.detail', compact('stduent', 'categories'));
        } else {
            return view('errorpage.404');
        }
    }

    public function edit($slug)
    {
        $stduent = $this->StaffRepository->where('slug', $slug)->first();
        if ($stduent) {
            $categories = Departement::all();
            view()->share(['form' => true, 'select' => true]);
            return view('staff.staff.edit', compact('stduent', 'categories'));
        } else {
            return view('errorpage.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {


        $stduent = $this->StaffRepository->where('slug', $slug)->first();
        if ($stduent) {
            if ($request->hasfile('logos')) {
                $img = $request->file('logos');
                $upload_path = public_path() . '/upload/stduent/';
                $file = $img->getClientOriginalName();
                $name = $stduent->id . $file;
                $img->move($upload_path, $name);
                $path = '/upload/stduent/' . $name;
            } else {
                $path = $request->oldimg;
            }
            $request->merge([
                'logo' => $path,
            ]);
            $request->merge(['image' => $path]);
            $this->StaffRepository->updateById($stduent->id, $request->all());
            return redirect()->route('staff.staffs.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $eventcategory = $this->StaffRepository->where('slug', $request->slug)->first();
        if ($eventcategory) {
            $this->StaffRepository->deleteById($eventcategory->id);
            return redirect()->route('staff.staffs.index')->with('success', 'Event  deleted successfully');
        }
        return view('errorpage.404');
    }

    public function multilecreate()
    {
        return view('staff.staff.author_mulitiple_create');
    }


    public function template()
    {
        $file = public_path() . "/author_list_templated.xlsx";

        if (file_exists($file)) {
            return Response
                ::download($file, 'author_list_templated.xlsx');
        } else {
            return 'file not found';
        }
    }

    public function importData(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);
        try {
            Excel::import(new AuthorListImport, $request->import_file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return redirect()->back()->withErrors($failures);
        }
        return redirect()->route('staff.staffs.index')->with(['success' => 'Successfully Upload!']);
    }
    public function mass_destroy(Request $request)
    {
        $this->StaffRepository->deleteMultipleById($request->ids);
        return redirect()->route('staff.staffs.index')->with('success', 'Author  deleted successfully');
    }

    public function approve(Request $request)
    {
        $contactListdata = $this->StaffRepository->where('slug', $request->slug)->first();
        if ($contactListdata) {
            if ($contactListdata->status == ON) {
                $contactListdata->update(['status' => OFF]);
            } else {
                $contactListdata->update(['status' => ON]);
            }
            return redirect()->route('staff.staffs.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }

    public function mass_approve(Request $request)
    {
        $this->StaffRepository->massUpdate($request->ids, ['status' => ON]);
        return redirect()->route('staff.staffs.index')->with('success', 'Stduents Approved successfully');
    }
}
