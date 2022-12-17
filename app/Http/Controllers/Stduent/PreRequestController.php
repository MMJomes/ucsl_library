<?php

namespace App\Http\Controllers\Stduent;

use App\Helpers\BookPreRentHelper;
use App\Helpers\BookRentHelper;
use App\Http\Controllers\Controller;
use App\Imports\AuthorListImport;
use App\Models\Books;
use App\Models\EventCategory;
use App\Models\Setting;
use App\Models\Stduent\Bookrent;
use App\Models\Stduent\PreRequest;
use App\Models\Stduent\Stduent;
use App\Repositories\Backend\Interf\BookRentRepository;
use App\Repositories\Backend\Interf\PreQuestRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class PreRequestController extends Controller
{
    use BookPreRentHelper;
    private PreQuestRepository $PreQuestRepository;
    private BookRentRepository $BookRentRepository;

    public function __construct(PreQuestRepository $PreQuestRepository, BookRentRepository $BookRentRepository)
    {
        $this->middleware('permission:stduentBookPreRent.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:stduentBookPreRent.edit', ['only' => ['edit']]);
        $this->middleware('permission:stduentBookPreRent.view', ['only' => ['index']]);
        $this->PreQuestRepository = $PreQuestRepository;
        $this->BookRentRepository = $BookRentRepository;
    }
    public function index()
    {
        $datas = PreRequest::with('book', 'stduent')->orderBy('id', 'ASC')->get();
        if (request()->ajax()) {
            $user = auth()->user();
            $datas = PreRequest::with('book', 'stduent')->orderBy('id', 'ASC')->get();
            return $this->BookPReRent_datatable($datas, $user);
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

        $stduents  = Stduent::with('stdclass')->get();
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
            return redirect()->route('stduent.preRequestBooks.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $eventcategory = $this->PreQuestRepository->where('slug', $request->slug)->first();
        if ($eventcategory) {
            $this->PreQuestRepository->deleteById($eventcategory->id);
            return redirect()->route('stduent.preRequestBooks.index')->with('success', 'Event  deleted successfully');
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
        return redirect()->route('stduent.preRequestBooks.index')->with(['success' => 'Successfully Upload!']);
    }
    public function mass_destroy(Request $request)
    {
        $this->PreQuestRepository->deleteMultipleById($request->ids);
        return redirect()->route('stduent.preRequestBooks.index')->with('success', 'Author  deleted successfully');
    }
    public function approve(Request $request, $id)
    {
        $contactListdata = $this->PreQuestRepository->where('id', $id)->first();
        if($contactListdata) {
        $booktotalBookRented = Bookrent::where('rentstatus', OFF)->where('stduents_id', $contactListdata->stduents_id)->get();
        $stduent_total_number_of_book = Setting::where('key', 'stduent_total_number_of_book')->first()->value;
        $booktotalBookRentedcount = count($booktotalBookRented);
        $stduent_total_number_of_book_count= (int)$stduent_total_number_of_book;
        if ($booktotalBookRentedcount <= $stduent_total_number_of_book_count) {
            if ($contactListdata->status = OFF) {
                $book_rent_duration = Setting::where('key', 'book_rent_duration')->first()->value;
                $current_date = Carbon::now();
                $book_return_date = Carbon::parse($current_date);
                $enddate = $book_return_date->addDays($book_rent_duration);
                $studentid = $contactListdata->stduents_id;
                $bookid = $contactListdata->books_id;
                $datas = $request->merge(['books_id' => $bookid, 'stduents_id' => $studentid, 'startdate' => $current_date, 'enddate' => $enddate, 'remark' => 'PreRequest Book.']);
                $this->BookRentRepository->create($datas->all());
                $prerequestbook = PreRequest::with('book', 'stduent')->where('id', $contactListdata->id)->first();
                $totalBook = Books::where('id', $prerequestbook->books_id)->first();
                if ($totalBook && $totalBook->availablebook > 0) {
                    $current_book = $totalBook->availablebook - 1;
                    $totalBook->availablebook = $current_book;
                    $totalBook->save();
                }
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
                //$contactListdata->update(['status' => OFF]);
            } else {
                $contactListdata->status  = 'on';
                $contactListdata->save();
            }
            Session::put('stdtotalBookApproved','Stduent PreRequest Book Order is Approved Successfully.');
            return redirect()->route('stduent.preRequestBooks.index')->with(['success' => 'Successfully Updated!']);
        }else{
            Session::put('stdtotalBook','The Number Books Availabel for Stduent is Limited!.You can\'t Approved at this time!.');
            return redirect()->back();
        }
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
