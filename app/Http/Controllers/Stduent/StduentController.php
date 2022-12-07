<?php

namespace App\Http\Controllers\Stduent;


use App\Helpers\StduentHelper;
use App\Helpers\AuthorHelper;
use App\Http\Controllers\Controller;
use App\Imports\AuthorListImport;
use App\Models\Author;
use App\Models\EventCategory;
use App\Models\Stduent\Bookrent;
use App\Models\Stduent\StdClass;
use App\Models\Stduent\Stduent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use App\Repositories\Backend\Interf\StudentRepository;
use Illuminate\Support\Facades\DB;
use Image;
use Maatwebsite\Excel\Facades\Excel;

class StduentController extends Controller
{
    use StduentHelper;
    private StudentRepository $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->middleware('permission:event.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:event.edit', ['only' => ['edit']]);
        $this->middleware('permission:event.view', ['only' => ['index']]);
        $this->studentRepository = $studentRepository;
    }

    public function index()
    {

        if (request()->ajax()) {
            $user = auth()->user();
            $data = Stduent::with('stdclass')->get();
            return $this->Stduent_datatable($data, $user);
        }
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('stduent.student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories  = StdClass::all();
        view()->share(['form' => true, 'select' => true]);
        return view('stduent.student.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data1 = DB::table('stduents')->latest('id')->first();
        if ($data1 == null) {
            $last_id = 1;
        } else {
            $id = Stduent::latest()->first()->id;
            $last_id = $id + 1;
        }
        if ($request->hasfile('logos')) {
            $img = $request->file('logos');
            $upload_path = public_path() . '/upload/stduents/';
            $file = $img->getClientOriginalName();
            $name = $last_id . $file;
            $img->move($upload_path, $name);
            $path = '/upload/stduents/' . $name;
        } else {
            $path = "/default-user.png";
        }
        $request->merge([
            'image' => $path,
            'status' => 'on',
        ]);
        $this->studentRepository->create($request->all());
        return redirect()
            ->route('stduent.stduents.index')
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


        $Author = $this->studentRepository->where('slug', $slug)->first();
        if ($Author) {
            $eventCategory = EventCategory::all();
            view()->share(['form' => true, 'select' => true]);
            return view('stduent.student.detail', compact('Author', 'eventCategory'));
        } else {
            return view('errorpage.404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $stduent = $this->studentRepository->where('slug', $slug)->first();
        if ($stduent) {
            $categories = StdClass::all();
            view()->share(['form' => true, 'select' => true]);
            return view('stduent.student.edit', compact('stduent', 'categories'));
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


        $stduent = $this->studentRepository->where('slug', $slug)->first();
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
            $this->studentRepository->updateById($stduent->id, $request->all());
            return redirect()->route('stduent.stduents.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $eventcategory = $this->studentRepository->where('slug', $request->slug)->first();
        if ($eventcategory) {
            $this->studentRepository->deleteById($eventcategory->id);
            return redirect()->route('stduent.stduents.index')->with('success', 'Event  deleted successfully');
        }
        return view('errorpage.404');
    }

    public function multilecreate()
    {
        return view('stduent.student.author_mulitiple_create');
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
        return redirect()->route('stduent.stduents.index')->with(['success' => 'Successfully Upload!']);
    }
    public function mass_destroy(Request $request)
    {
        $this->studentRepository->deleteMultipleById($request->ids);
        return redirect()->route('stduent.stduents.index')->with('success', 'Author  deleted successfully');
    }

    public function approve(Request $request)
    {
        $contactListdata = $this->studentRepository->where('slug', $request->slug)->first();
        if ($contactListdata) {
            if ($contactListdata->status == ON) {
                $contactListdata->update(['status' => OFF]);
            } else {
                $contactListdata->update(['status' => ON]);
            }
            return redirect()->route('stduent.stduents.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }

    public function mass_approve(Request $request)
    {
        $this->studentRepository->massUpdate($request->ids, ['status' => ON]);
        return redirect()->route('stduent.stduents.index')->with('success', 'Stduents Approved successfully');
    }
}
