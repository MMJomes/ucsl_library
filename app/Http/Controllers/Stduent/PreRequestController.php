<?php

namespace App\Http\Controllers\Stduent;

use App\Helpers\BookRentHelper;
use App\Http\Controllers\Controller;
use App\Imports\AuthorListImport;
use App\Models\Books;
use App\Models\EventCategory;
use App\Models\Setting;
use App\Models\Stduent\PreRequest;
use App\Models\Stduent\Stduent;
use App\Repositories\Backend\Interf\BookRentRepository;
use App\Repositories\Backend\Interf\PreQuestRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class PreRequestController extends Controller
{
    use BookRentHelper;
    private PreQuestRepository $PreQuestRepository;
    private BookRentRepository $BookRentRepository;

    public function __construct(PreQuestRepository $PreQuestRepository, BookRentRepository $BookRentRepository)
    {
        $this->middleware('permission:event.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:event.edit', ['only' => ['edit']]);
        $this->middleware('permission:event.view', ['only' => ['index']]);
        $this->PreQuestRepository = $PreQuestRepository;
        $this->BookRentRepository = $BookRentRepository;
    }

    public function index()
    {

        $datas = PreRequest::with('book', 'stduent')->orderBy('id', 'ASC')->get();
        if (request()->ajax()) {
            $user = auth()->user();
            $datas = PreRequest::with('book', 'stduent')->orderBy('id', 'ASC')->get();
            return $this->BookRent_datatable($datas, $user);
        }
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('stduent.prequestbook.index');
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
        return view('stduent.prequestbook.create', compact('books', 'stduents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->PreQuestRepository->create($request->all());
        return redirect()
            ->route('stduent.preRequestBooks.index')
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
        $Author = $this->PreQuestRepository->where('id', $id)->first();
        if ($Author) {
            $stduents  = Stduent::all();
            $books  = Books::all();
            view()->share(['form' => true, 'select' => true]);
            return view('stduent.prequestbook.detail', compact('Author', 'books', 'stduents'));
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
        $author = $this->PreQuestRepository->where('slug', $slug)->first();
        if ($author) {
            $categories = EventCategory::all();
            view()->share(['form' => true, 'select' => true]);
            return view('stduent.prequestbook.edit', compact('author', 'categories'));
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
        $Author = $this->PreQuestRepository->where('slug', $slug)->first();
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
            $this->PreQuestRepository->updateById($Author->id, $request->all());
            return redirect()->route('backend.author.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $eventcategory = $this->PreQuestRepository->where('slug', $request->slug)->first();
        if ($eventcategory) {
            $this->PreQuestRepository->deleteById($eventcategory->id);
            return redirect()->route('backend.author.index')->with('success', 'Event  deleted successfully');
        }
        return view('errorpage.404');
    }

    public function multilecreate()
    {
        return view('stduent.prequestbook.author_mulitiple_create');
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
        $this->PreQuestRepository->deleteMultipleById($request->ids);
        return redirect()->route('backend.author.index')->with('success', 'Author  deleted successfully');
    }
    public function approve(Request $request, $id)
    {
        $contactListdata = $this->PreQuestRepository->where('id', $id)->first();
        if ($contactListdata) {
            if ($contactListdata->status = OFF) {
                $book_rent_duration = Setting::where('key', 'book_rent_duration')->first()->value;
                $current_date = Carbon::now();
                $book_return_date = Carbon::parse($current_date);
                $enddate = $book_return_date->addDays($book_rent_duration);
                $studentid = $contactListdata->stduents_id;
                $bookid = $contactListdata->books_id;
                $datas = $request->merge(['books_id' => $studentid, 'stduents_id' => $bookid, 'startdate' => $current_date, 'enddate' => $enddate, 'remark' => 'PreRequest Book.']);
                $data = $this->BookRentRepository->create($datas->all());
                $stdeunt = Stduent::where('id', $studentid)->first();
                if ($stdeunt) {
                    $totalbok = $stdeunt->totalNoOfBooks + 1;
                    $stdeunt->totalNoOfBooks = $totalbok;
                    $stdeunt->save();
                }
            }
            if ($contactListdata->status == ON) {
                $contactListdata->status  = 'off';
                $contactListdata->save();
                $contactListdata->update(['status' => OFF]);
            } else {
                $contactListdata->status  = 'on';
                $contactListdata->save();
            }
            return redirect()->route('stduent.preRequestBooks.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }

    public function mass_approve(Request $request)
    {
        $this->PreQuestRepository->massUpdate($request->ids, ['status' => ON]);
        return redirect()->route('stduent.preRequestBooks.index')->with('success', 'Stduents Approved successfully');
    }
}
