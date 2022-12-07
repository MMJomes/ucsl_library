<?php

namespace App\Http\Controllers\Stduent;

use App\Helpers\BookRentHelper;
use App\Http\Controllers\Controller;
use App\Imports\AuthorListImport;
use App\Models\Books;
use App\Models\EventCategory;
use App\Models\Setting;
use App\Models\Stduent\Bookrent;
use App\Models\Stduent\Stduent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use App\Repositories\Backend\Interf\BookRentRepository;
use Maatwebsite\Excel\Facades\Excel;

class BookRentController extends Controller
{
    use BookRentHelper;
    private BookRentRepository $BookRentRepository;

    public function __construct(BookRentRepository $BookRentRepository)
    {
        $this->middleware('permission:event.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:event.edit', ['only' => ['edit']]);
        $this->middleware('permission:event.view', ['only' => ['index']]);
        $this->BookRentRepository = $BookRentRepository;
    }

    public function index()
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $datas = Bookrent::with('book', 'stduent')->orderBy('id', 'ASC')->get();
            return $this->BookRent_datatable($datas, $user);
        }
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('stduent.bookrent.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stduents  = Stduent::all();
        $books  = Books::all();
        view()->share(['form' => true, 'select' => true]);
        return view('stduent.bookrent.create', compact('books','stduents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $book_rent_duration = Setting::where('key', 'book_rent_duration')->first()->value;
        $book_return_date = Carbon::parse($request->startdate);
        $enddate = $book_return_date->addDays($book_rent_duration);
        $request->merge(['enddate'=>$enddate]);
        $this->BookRentRepository->create($request->all());
        return redirect()
            ->route('stduent.bookRent.index')
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


        $Author = $this->BookRentRepository->where('slug', $slug)->first();
        if ($Author) {

            $eventCategory = EventCategory::all();
            view()->share(['form' => true, 'select' => true]);
            return view('stduent.bookrent.detail', compact('Author', 'eventCategory'));
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
        $author = $this->BookRentRepository->where('slug', $slug)->first();
        if ($author) {
            $categories = EventCategory::all();
            view()->share(['form' => true, 'select' => true]);
            return view('stduent.bookrent.edit', compact('author', 'categories'));
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
        $Author = $this->BookRentRepository->where('slug', $slug)->first();
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
            $this->BookRentRepository->updateById($Author->id, $request->all());
            return redirect()->route('backend.author.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $eventcategory = $this->BookRentRepository->where('slug', $request->slug)->first();
        if ($eventcategory) {
            $this->BookRentRepository->deleteById($eventcategory->id);
            return redirect()->route('backend.author.index')->with('success', 'Event  deleted successfully');
        }
        return view('errorpage.404');
    }

    public function multilecreate()
    {
        return view('stduent.bookrent.author_mulitiple_create');
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
        $this->BookRentRepository->deleteMultipleById($request->ids);
        return redirect()->route('backend.author.index')->with('success', 'Author  deleted successfully');
    }
}
