<?php

namespace App\Http\Controllers\Stduent;

use App\Exports\StduentExport;
use App\Helpers\StduentHelper;
use App\Http\Controllers\Controller;
use App\Imports\AuthorListImport;
use App\Jobs\StduentAccountMailServiceJob;
use App\Models\Setting;
use App\Models\Stduent\StdClass;
use App\Models\Stduent\Stduent;
use App\Notifications\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Repositories\Backend\Interf\StudentRepository;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class StduentController extends Controller
{
    use StduentHelper;
    private StudentRepository $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->middleware('permission:stduent.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:stduent.edit', ['only' => ['edit']]);
        $this->middleware('permission:stduent.view', ['only' => ['index']]);
        $this->studentRepository = $studentRepository;
    }

    public function index()
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $data = Stduent::with('stdclass')->orderBy('totalNoOfBooks', 'DESC')->get();
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
        $email = $request->email;
        $emailValid = substr($email, -17);
        if ($emailValid == "@ucsloikaw.edu.mm") {
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
                ->with('success', 'Successfully Added');
        } else {

            //return redirect()->back()->with('success', 'Invail Email Address!');

            return redirect()
                ->route('stduent.stduents.create')
                ->with('success', 'Invail Email Address!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $stduent = $this->studentRepository->where('slug', $slug)->first();
        if ($stduent) {
            $categories = StdClass::all();
            view()->share(['form' => true, 'select' => true]);
            return view('stduent.student.detail', compact('stduent', 'categories'));
        } else {
            return view('errorpage.404');
        }
    }

    public function edit($slug)
    {
        $stduent = $this->studentRepository->where('slug', $slug)->first();
        if ($stduent) {
            $stduentCls = StdClass::all();
            view()->share(['form' => true, 'select' => true]);
            return view('stduent.student.edit', compact('stduent', 'stduentCls'));
        } else {
            return view('errorpage.404');
        }
    }
    public function update(Request $request, $slug)
    {
        $stduent = $this->studentRepository->where('slug', $slug)->first();
        if ($stduent) {

            $email = $request->email;
            $emailValid = substr($email, -17);
            if ($emailValid == "@ucsloikaw.edu.mm") {
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
                redirect()->back()->with('success', 'Invail Email Address!');
            }
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
            $sned_email_to_user_account = Setting::where('key', 'sned_email_to_user_account')->first();
            if ($contactListdata->status == ON) {
                $contactListdata->update(['status' => OFF]);
            } else {
                $contactListdata->update(['status' => ON]);
            }
            if ($sned_email_to_user_account->value = ON) {
                $curListdata = $this->studentRepository->where('slug', $request->slug)->first();
                if ($curListdata) {
                    if($curListdata->status == 'ON'){
                        $mystatus= 'Approved';
                    }else{
                        $mystatus= 'Rejected';
                    }
                    $curListdata->notify(new SendEmail($curListdata->name,'Notification!'," Your Request Been' $mystatus 'By Admin"));
                }
            }
            return redirect()->route('stduent.stduents.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function mass_approve(Request $request)
    {
        $this->studentRepository->massUpdate($request->ids, ['status' => ON]);
        $sned_email_to_user_account = Setting::where('key', 'sned_email_to_user_account')->first();
        if ($sned_email_to_user_account->value = ON) {
            $curListdata = $this->studentRepository->where('slug', $request->slug)->first();
            if ($curListdata) {
                StduentAccountMailServiceJob::dispatch($curListdata->name, "Announcement! , Your Request Been Admin");
            }
        }
        return redirect()->route('stduent.stduents.index')->with('success', 'Stduents Approved successfully');
    }
    public function excelexport()
    {
        return Excel::download(new StduentExport(), 'Stduent_List.xlsx');
    }
}
