<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ExportCategoryList;
use App\Helpers\EventCategoryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventCategoryRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Repositories\Backend\Interf\EventCategoryRepository;
use App\Exports\ExportMemberList;
use App\Imports\CategoryListImport;
use App\Imports\ContactListImport;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class EventCategoryController extends Controller
{
    use EventCategoryHelper;
    private EventCategoryRepository $eventCategoryRepository;

    public function __construct(EventCategoryRepository   $eventCategoryRepository)
    {
        $this->middleware('permission:eventcategory.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:eventcategory.edit', ['only' => ['edit']]);
        $this->middleware('permission:eventcategory.view', ['only' => ['index']]);
        $this->eventCategoryRepository = $eventCategoryRepository;
    }

    public function index()
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $data = $this->eventCategoryRepository->all();
            return $this->eventcategory_datatable($data, $user);
        }
        Session::put('admininfo', 'Your Excel Import Format must be same with Category Excel Import Format.If Not,Please Download First!.');
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('backend.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        view()->share(['form' => true]);
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventCategoryRequest $request)
    {
        $this->eventCategoryRepository->create($request->all());
        return redirect()
            ->route('backend.category.index')
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
        $eventCategory = $this->eventCategoryRepository->where('slug', $slug)->first();
        if ($eventCategory) {

            view()->share(['form' => true]);
            return view('backend.category.detail', compact('eventCategory'));
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
        $eventcategory = $this->eventCategoryRepository->where('slug', $slug)->first();
        if ($eventcategory) {

            view()->share(['form' => true]);
            return view('backend.category.edit', compact('eventcategory'));
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
    public function update(EventCategoryRequest $request, $biztype_slug)
    {
        $currentTime = Carbon::now();

        $request->merge([
            'updatedat' => $currentTime,
        ]);

        $eventcategory = $this->eventCategoryRepository->where('slug', $biztype_slug)->first();
        if ($eventcategory) {

            $this->eventCategoryRepository->updateById($eventcategory->id, $request->validated());
            return redirect()->route('backend.category.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $eventcategory = $this->eventCategoryRepository->where('slug', $request->slug)->first();
        if ($eventcategory) {
            $this->eventCategoryRepository->deleteById($eventcategory->id);
            return redirect()->route('backend.category.index')->with('success', 'Event Category deleted successfully');
        }
        return view('errorpage.404');
    }

    public function multilecreate()
    {
        return view('backend.category.category_mulitiple_create');
    }


    public function template()
    {
        $file = public_path() . "/category_list_templated.xlsx";

        if (file_exists($file)) {
            return Response
                ::download($file, 'category_list_templated.xlsx');
        } else {
            return 'file not found';
        }
    }
    public function importData(Request $request)
    {
        $dat = strtolower($request->import_file->getClientOriginalExtension());
        if ($dat != 'xlsx') {
            Session::put('importError', 'Invaild  Excel Import Format. Please Correct Excel Format!.');
            return redirect()->back();
        } else {
            $request->validate([
                'import_file' => 'required'
            ]);
            try {
                Excel::import(new CategoryListImport, $request->import_file);
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                Session::put('importError', 'Invaild Data, Please Check Your Excel Data');
                return redirect()->back();
            }
            return redirect()->route('backend.category.index')->with(['success' => 'Successfully Upload!']);
        }
    }

    public function excelexport()
    {
        return Excel::download(new ExportCategoryList(), 'category_List.xlsx');
    }

    public function mass_destroy(Request $request)
    {
        $this->eventCategoryRepository->deleteMultipleById($request->ids);
        return redirect()->route('backend.category.index')->with('success', ' Category deleted successfully');
    }
}
