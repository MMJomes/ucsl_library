<?php

namespace App\Http\Controllers\Backend;


use App\Helpers\EventCategoryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventCategoryRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Repositories\Backend\Interf\EventCategoryRepository;

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
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('backend.eventcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        view()->share(['form' => true]);
        return view('backend.eventcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventCategoryRequest $request)
    {

        $this->eventCategoryRepository->create($request->validated());
        return redirect()
            ->route('backend.eventcategory.index')
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
            return view('backend.eventcategory.detail', compact('eventCategory'));
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
            return view('backend.eventcategory.edit', compact('eventcategory'));
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

            $this->eventCategoryRepository->updateById($eventcategory->id,$request->validated());
             return redirect()->route('backend.eventcategory.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $eventcategory = $this->eventCategoryRepository->where('slug', $request->slug)->first();
        if ($eventcategory) {
            $this->eventCategoryRepository->deleteById($eventcategory->id);
            return redirect()->route('backend.eventcategory.index')->with('success', 'Event Category deleted successfully');
        }
        return view('errorpage.404');
    }

    public function mass_destroy(Request $request)
    {
        $this->eventCategoryRepository->deleteMultipleById($request->ids);
        return redirect()->route('backend.eventcategory.index')->with('success', 'Event Category deleted successfully');
    }
}
