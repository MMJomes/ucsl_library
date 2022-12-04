<?php

namespace App\Http\Controllers\Backend;


use App\Helpers\EventHelper;
use App\Models\EventCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Repositories\Backend\Interf\EventCategoryRepository;
use App\Repositories\Backend\Interf\EventRepository;


class EventController extends Controller
{
    use EventHelper;
    private EventCategoryRepository $eventCategoryRepository;
    private EventRepository $eventRepository;

    public function __construct(EventCategoryRepository   $eventCategoryRepository,EventRepository $eventRepository)
    {
        $this->middleware('permission:event.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:event.edit', ['only' => ['edit']]);
        $this->middleware('permission:event.view', ['only' => ['index']]);
        $this->eventCategoryRepository = $eventCategoryRepository;
        $this->eventRepository = $eventRepository;

    }

    public function index()
    {

        if (request()->ajax()) {
            $user = auth()->user();
            $data = $this->eventRepository->all();
            return $this->event_datatable($data, $user);
        }
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('backend.event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eventCategory= EventCategory::all();
        view()->share(['form' => true, 'select' => true]);
        return view('backend.event.create',compact('eventCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $this->eventRepository->create($request->validated());
        return redirect()
            ->route('backend.event.index')
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
        $event = $this->eventRepository->where('slug', $slug)->first();
        if ($event) {

            $eventCategory= EventCategory::all();
            view()->share(['form' => true, 'select' => true]);
            return view('backend.event.detail', compact('event','eventCategory'));
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
        $event = $this->eventRepository->where('slug', $slug)->first();
        if ($event) {
            $eventCategory= EventCategory::all();
            view()->share(['form' => true, 'select' => true]);
            return view('backend.event.edit', compact('event','eventCategory'));
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
    public function update(EventRequest $request, $slug)
    {
        $currentTime = Carbon::now();
        $request->merge([
            'updatedat' => $currentTime,
        ]);
        $event = $this->eventRepository->where('slug', $slug)->first();
        if ($event) {

            $this->eventRepository->updateById($event->id,$request->validated());
             return redirect()->route('backend.event.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $eventcategory = $this->eventRepository->where('slug', $request->slug)->first();
        if ($eventcategory) {
            $this->eventRepository->deleteById($eventcategory->id);
            return redirect()->route('backend.event.index')->with('success', 'Event  deleted successfully');
        }
        return view('errorpage.404');
    }

    public function mass_destroy(Request $request)
    {
        $this->eventRepository->deleteMultipleById($request->ids);
        return redirect()->route('backend.event.index')->with('success', 'Event  deleted successfully');
    }
}

