<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\EventHelper;
use App\Helpers\AuthorHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorsRequest;
use App\Imports\AuthorListImport;
use App\Models\Author;
use App\Models\EventCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use App\Repositories\Backend\Interf\AuthorRepository;
use App\Repositories\Backend\Interf\EventCategoryRepository;
use App\Repositories\Backend\Interf\EventRepository;
use Maatwebsite\Excel\Facades\Excel;

class AuthorController extends Controller
{
    use EventHelper;
    use AuthorHelper;
    private AuthorRepository $AuthorRepository;
    private EventCategoryRepository $eventCategoryRepository;
    private EventRepository $eventRepository;

    public function __construct(EventCategoryRepository   $eventCategoryRepository, EventRepository $eventRepository, AuthorRepository $AuthorRepository)
    {
        $this->middleware('permission:event.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:event.edit', ['only' => ['edit']]);
        $this->middleware('permission:event.view', ['only' => ['index']]);
        $this->eventCategoryRepository = $eventCategoryRepository;
        $this->eventRepository = $eventRepository;
        $this->AuthorRepository = $AuthorRepository;
    }

    public function index()
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $data = Author::with('category')->get();
            return $this->Author_datatable($data, $user);
        }
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('backend.author.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories  = EventCategory::all();
        view()->share(['form' => true, 'select' => true]);
        return view('backend.author.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorsRequest $request)
    {
        $this->AuthorRepository->create($request->all());
        return redirect()
            ->route('backend.author.index')
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


        $Author = $this->AuthorRepository->where('slug', $slug)->first();
        if ($Author) {

            $eventCategory = EventCategory::all();
            view()->share(['form' => true, 'select' => true]);
            return view('backend.author.detail', compact('Author', 'eventCategory'));
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
        $author = $this->AuthorRepository->where('slug', $slug)->first();
        if ($author) {
            $categories = EventCategory::all();
            view()->share(['form' => true, 'select' => true]);
            return view('backend.author.edit', compact('author', 'categories'));
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
        $Author = $this->AuthorRepository->where('slug', $slug)->first();
        if ($Author) {
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
                $data = $Author->image;
                $request->merge([
                    'image' => $Author->image,
                    'updatedat' => $currentTime,
                ]);
            }
            $this->AuthorRepository->updateById($Author->id, $request->all());
            return redirect()->route('backend.author.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $eventcategory = $this->AuthorRepository->where('slug', $request->slug)->first();
        if ($eventcategory) {
            $this->AuthorRepository->deleteById($eventcategory->id);
            return redirect()->route('backend.author.index')->with('success', 'Event  deleted successfully');
        }
        return view('errorpage.404');
    }

    public function multilecreate()
    {
        return view('backend.author.author_mulitiple_create');
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
        return redirect()->route('backend.author.index')->with(['success' => 'Successfully Upload!']);
    }
    public function mass_destroy(Request $request)
    {
        $this->AuthorRepository->deleteMultipleById($request->ids);
        return redirect()->route('backend.author.index')->with('success', 'Author  deleted successfully');
    }
}
