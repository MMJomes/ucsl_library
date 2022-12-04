<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\EventHelper;
use App\Helpers\EventImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventImage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Repositories\Backend\Interf\EventImageRepository;
use App\Repositories\Backend\Interf\EventCategoryRepository;
use App\Repositories\Backend\Interf\EventRepository;
use Image;



class EventImageController extends Controller
{
    use EventHelper;
    use EventImageHelper;
    private EventImageRepository $eventImageRepository;
    private EventCategoryRepository $eventCategoryRepository;
    private EventRepository $eventRepository;

    public function __construct(EventCategoryRepository   $eventCategoryRepository, EventRepository $eventRepository, EventImageRepository $eventImageRepository)
    {
        $this->middleware('permission:event.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:event.edit', ['only' => ['edit']]);
        $this->middleware('permission:event.view', ['only' => ['index']]);
        $this->eventCategoryRepository = $eventCategoryRepository;
        $this->eventRepository = $eventRepository;
        $this->eventImageRepository = $eventImageRepository;
    }

    public function index()
    {

        if (request()->ajax()) {
            $user = auth()->user();
            $data = $this->eventImageRepository->all();
            return $this->eventimage_datatable($data, $user);
        }
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('backend.eventimage.index');
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
        return view('backend.eventimage.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $file) {

                $names = rand() . '.' . $file->extension();
                $name = '/upload/eventImage/' . $names;
                $file->move(public_path() . '/upload/eventImage/', $name);
                $data[] = $name;
            }
        }
        $request->merge([
            'image' => json_encode($data, true),
        ]);
        $this->eventImageRepository->create($request->all());
        return redirect()
            ->route('backend.eventimage.index')
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


        $eventimage = $this->eventImageRepository->where('slug', $slug)->first();
        if ($eventimage) {

            $eventCategory = Event::all();
            view()->share(['form' => true, 'select' => true]);
            return view('backend.eventimage.detail', compact('eventimage', 'eventCategory'));
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
        $eventimage = $this->eventImageRepository->where('slug', $slug)->first();
        if ($eventimage) {
            $Event = Event::all();
            view()->share(['form' => true, 'select' => true]);
            return view('backend.eventimage.edit', compact('eventimage', 'Event'));
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
        $eventimage = $this->eventImageRepository->where('slug', $slug)->first();
        if ($eventimage) {
            $currentTime = Carbon::now();
            if ($request->has('images')) {
                foreach ($request->file('images') as $iamge) {
                    $data[] = $iamge;
                }
                $request->merge([
                    'image' => json_encode($data, true),
                    'updatedat' => $currentTime,
                ]);
            } else {
                $data = $eventimage->image;
                $request->merge([
                    'image' => $eventimage->image,
                    'updatedat' => $currentTime,
                ]);
            }
            $this->eventImageRepository->updateById($eventimage->id, $request->all());
            return redirect()->route('backend.eventimage.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $eventcategory = $this->eventImageRepository->where('slug', $request->slug)->first();
        if ($eventcategory) {
            $this->eventImageRepository->deleteById($eventcategory->id);
            return redirect()->route('backend.eventimage.index')->with('success', 'Event  deleted successfully');
        }
        return view('errorpage.404');
    }

    public function mass_destroy(Request $request)
    {
        $this->eventImageRepository->deleteMultipleById($request->ids);
        return redirect()->route('backend.eventimage.index')->with('success', 'Event  deleted successfully');
    }
}
