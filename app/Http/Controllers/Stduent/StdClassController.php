<?php

namespace App\Http\Controllers\Stduent;

use App\Helpers\EventHelper;
use App\Helpers\AuthorHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Stduent\StdClass;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Repositories\Backend\Interf\AuthorRepository;
use App\Repositories\Backend\Interf\EventCategoryRepository;
use App\Repositories\Backend\Interf\EventRepository;
use App\Repositories\Backend\Interf\StdClassessRepository;
use Image;

class StdClassController extends Controller
{
    use EventHelper;
    use AuthorHelper;
    private StdClassessRepository $stdClassessRepository;
    private EventCategoryRepository $eventCategoryRepository;
    private EventRepository $eventRepository;

    public function __construct(StdClassessRepository $stdClassessRepository)
    {
        $this->middleware('permission:event.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:event.edit', ['only' => ['edit']]);
        $this->middleware('permission:event.view', ['only' => ['index']]);
        $this->stdClassessRepository = $stdClassessRepository;
    }

    public function index()
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $data = StdClass::get();
            return $this->Author_datatable($data, $user);
        }
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('stduent.stdclass.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = Event::all();
        view()->share(['form' => true, 'select' => true]);
        return view('stduent.stdclass.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        StdClass::create($request->all());
        return redirect()
            ->route('stduent.stdclass.index')
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


        $Author = StdClass::where('id', $id)->first();
        if ($Author) {

            $eventCategory = Event::all();
            view()->share(['form' => true, 'select' => true]);
            return view('stduent.stdclass.detail', compact('Author', 'eventCategory'));
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

        $stdclass = StdClass::where('id', $id)->first();
        if ($stdclass) {
            view()->share(['form' => true]);
            return view('stduent.stdclass.edit', compact('stdclass'));
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

        $stdclass = StdClass::where('id',$id)->first();
        if ($stdclass) {

            $this->stdClassessRepository->updateById($stdclass->id, $request->all());
            return redirect()->route('stduent.stdclass.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $eventcategory = $this->stdClassessRepository->where('id', $request->slug)->first();
        if ($eventcategory) {
            $this->stdClassessRepository->deleteById($eventcategory->id);
            return redirect()->route('stduent.stdclass.index')->with('success', 'Event  deleted successfully');
        }
        return view('errorpage.404');
    }

    public function mass_destroy(Request $request)
    {
        $this->stdClassessRepository->deleteMultipleById($request->ids);
        return redirect()->route('stduent.stdclass.index')->with('success', 'Event  deleted successfully');
    }
}
