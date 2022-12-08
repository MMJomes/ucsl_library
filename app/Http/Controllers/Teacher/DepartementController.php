<?php

namespace App\Http\Controllers\Teacher;


use App\Helpers\AuthorHelper;
use App\Http\Controllers\Controller;
use App\Models\Teacher\Departement;
use Illuminate\Http\Request;
use App\Repositories\Backend\Interf\EventCategoryRepository;
use App\Repositories\Backend\Interf\StfDepartmentRepository;

class DepartementController extends Controller
{
    use AuthorHelper;
    private EventCategoryRepository $eventCategoryRepository;

    public function __construct(StfDepartmentRepository $StfDepartmentRepository)
    {
        $this->middleware('permission:event.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:event.edit', ['only' => ['edit']]);
        $this->middleware('permission:event.view', ['only' => ['index']]);
        $this->StfDepartmentRepository = $StfDepartmentRepository;
    }

    public function index()
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $data = Departement::get();
            return $this->Author_datatable($data, $user);
        }
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('staff.stfclass.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        view()->share(['form' => true, 'select' => true]);
        return view('staff.stfclass.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Departement::create($request->all());
        return redirect()
            ->route('staff.stfClass.index')
            ->with(['success' => 'Successfully Added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $Author = Departement::where('id', $id)->first();
        if ($Author) {

            $eventCategory = Departement::all();
            view()->share(['form' => true, 'select' => true]);
            return view('staff.stfclass.detail', compact('Author', 'eventCategory'));
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
    public function edit($id)
    {

        $stdclass = Departement::where('id', $id)->first();
        if ($stdclass) {
            view()->share(['form' => true]);
            return view('staff.stfclass.edit', compact('stdclass'));
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
    public function update(Request $request,$id)
    {

        $stdclass = Departement::where('id',$id)->first();
        if ($stdclass) {

            $this->StfDepartmentRepository->updateById($stdclass->id, $request->all());
            return redirect()->route('staff.stfClass.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $eventcategory = $this->StfDepartmentRepository->where('id', $request->slug)->first();
        if ($eventcategory) {
            $this->StfDepartmentRepository->deleteById($eventcategory->id);
            return redirect()->route('staff.stfClass.index')->with('success', 'Event  deleted successfully');
        }
        return view('errorpage.404');
    }

    public function mass_destroy(Request $request)
    {
        $this->StfDepartmentRepository->deleteMultipleById($request->ids);
        return redirect()->route('staff.stfClass.index')->with('success', 'Event  deleted successfully');
    }
}

