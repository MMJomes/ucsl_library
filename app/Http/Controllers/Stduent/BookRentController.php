<?php

namespace App\Http\Controllers\Stduent;

use App\Helpers\BookRentHelper;
use App\Http\Controllers\Controller;
use App\Imports\AuthorListImport;
use App\Models\Books;
use App\Models\Setting;
use App\Models\Stduent\Bookrent;
use App\Models\Stduent\Stduent;
use App\Notifications\SendEmail;
use App\Repositories\Backend\Interf\BookListRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use App\Repositories\Backend\Interf\BookRentRepository;
use Maatwebsite\Excel\Facades\Excel;

class BookRentController extends Controller
{
    use BookRentHelper;
    private BookRentRepository $BookRentRepository;
    private BookListRepository $BookListRepository;

    public function __construct(BookRentRepository $BookRentRepository, BookListRepository $BookListRepository)
    {
        $this->middleware('permission:event.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:event.edit', ['only' => ['edit']]);
        $this->middleware('permission:event.view', ['only' => ['index']]);
        $this->BookRentRepository = $BookRentRepository;
        $this->BookListRepository = $BookListRepository;
    }

    public function index()
    {
        // $bookid= Books::pluck('id');

        // $datas = Bookrent::with('book', 'stduent')->orderBy('id', 'ASC')->get();
        // dd($datas);
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
        $stduents  = Stduent::with('stdclass')->get();
        $books  = Books::all();
        view()->share(['form' => true, 'select' => true]);
        return view('stduent.bookrent.create', compact('books', 'stduents'));
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
        $request->merge(['enddate' => $enddate]);
        $data = $this->BookRentRepository->create($request->all());
        $book = Books::where('id', $data->books_id)->first();
        if ($book) {
            $totalbooks = $book->totalbook;
            if ($totalbooks > 0) {
                $bookrentstatus = Bookrent::where('id', $data->id)->where('books_id', $data->books_id)->first();
                if ($bookrentstatus) {
                    if ($bookrentstatus->rentstatus == OFF) {
                        $currentavailablebook  = $book->availablebook - 1;
                        $book->availablebook = $currentavailablebook;
                        $book->save();
                    }
                }
            }
        }
        $stdeunt = Stduent::where('id', $data->stduents_id)->first();
        if ($stdeunt) {
            $totalbok = $stdeunt->totalNoOfBooks + 1;
            $stdeunt->totalNoOfBooks = $totalbok;
            $stdeunt->save();
        }
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
    public function show($id)
    {
        $Author = $this->BookRentRepository->where('id', $id)->first();
        if ($Author) {
            $stduents  = Stduent::all();
            $books  = Books::all();
            view()->share(['form' => true, 'select' => true]);
            return view('stduent.bookrent.detail', compact('Author', 'stduents', 'books'));
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
        $author = $this->BookRentRepository->where('id', $id)->first();
        if ($author) {
            $stduents  = Stduent::get();
            $books  = Books::get();
            view()->share(['form' => true, 'select' => true]);
            return view('stduent.bookrent.edit', compact('author', 'stduents', 'books'));
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
    public function update(Request $request, $id)
    {
        $Author = $this->BookRentRepository->where('id', $id)->first();
        if ($Author) {
            $strtime = $request->startdate;
            $book_rent_duration = Setting::where('key', 'book_rent_duration')->first()->value;
            $book_return_date = Carbon::parse($strtime);
            $enddate = $book_return_date->addDays($book_rent_duration);
            $request->merge(['enddate' => $enddate, 'startdate' => $strtime]);
            $this->BookRentRepository->updateById($Author->id, $request->all());
            return redirect()->route('stduent.bookRent.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function continuce(Request $request, $id)
    {
        $Author = $this->BookRentRepository->where('id', $id)->first();
        if ($Author) {
            $strtime = $Author->enddate;
            $book_rent_duration = Setting::where('key', 'book_rent_duration')->first()->value;
            $book_return_date = Carbon::parse($strtime);
            $enddate = $book_return_date->addDays($book_rent_duration);
            $request->merge(['enddate' => $enddate, 'startdate' => $strtime, 'remark' => "Continuced"]);
            $this->BookRentRepository->updateById($Author->id, $request->all());
            return redirect()->route('stduent.bookRent.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function requestStausApproved(Request $request, $id)
    {
        $Author = $this->BookRentRepository->where('id', $id)->first();
        if ($Author) {
            $strtime = $Author->enddate;
            $book_rent_duration = Setting::where('key', 'book_rent_duration')->first()->value;
            $book_return_date = Carbon::parse($strtime);
            $enddate = $book_return_date->addDays($book_rent_duration);
            $request->merge(['enddate' => $enddate, 'startdate' => $strtime,  'remark' => "Continuced", 'requesttatus' => 'off', 'approvetatus' => 'on', 'remark' => "User Request Has Been Approved By Admin"]);
            $this->BookRentRepository->updateById($Author->id, $request->all());
            $Author->notify(new SendEmail($Author->name, "Congratulations!", "Your Request Have Been Approved By Admin"));
            return redirect()->route('stduent.bookRent.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function requestStausRejected(Request $request, $id)
    {
        $Author = $this->BookRentRepository->where('id', $id)->first();
        if ($Author) {
            $strtime = $Author->enddate;
            $book_rent_duration = Setting::where('key', 'book_rent_duration')->first()->value;
            $book_return_date = Carbon::parse($strtime);
            $enddate = $book_return_date->addDays($book_rent_duration);
            $request->merge(['enddate' => $enddate, 'startdate' => $strtime,  'remark' => "Continuced", 'requesttatus' => 'off', 'approvetatus' => 'off', 'remark' => "User Request Has Been Reject By Admin"]);
            $this->BookRentRepository->updateById($Author->id, $request->all());
            $Author->notify(new SendEmail($Author->name, "Sorry!", "Your Request Been Rejected By Admin"));
            return redirect()->route('stduent.bookRent.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy($id)
    {
        $eventcategory = $this->BookRentRepository->where('id', $id)->first();
        if ($eventcategory) {
            $this->BookRentRepository->deleteById($eventcategory->id);
            return redirect()->route('stduent.bookRent.index')->with('success', 'Event  deleted successfully');
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
        return redirect()->route('stduent.bookRent.index')->with(['success' => 'Successfully Upload!']);
    }
    public function mass_destroy(Request $request)
    {
        $this->BookRentRepository->deleteMultipleById($request->ids);
        return redirect()->route('stduent.bookRent.index')->with('success', 'Author  deleted successfully');
    }

    public function approve($id)
    {
        $contactListdata = $this->BookRentRepository->where('id', $id)->first();
        if ($contactListdata) {
            if ($contactListdata->rentstatus = OFF) {
                $booktotal = Books::where('id', $contactListdata->books_id)->first();
                if ($booktotal) {
                    $curnbooktotal = $booktotal->availablebook + 1;
                    $booktotal->availablebook = $curnbooktotal;
                    $booktotal->save();
                }
                $contactListdata->rentstatus = 'on';
                $contactListdata->status = 'on';
                $contactListdata->save();
            }
            $stdeunt = Stduent::where('id', $contactListdata->stduents_id)->first();
            if ($stdeunt) {
                $totalbok = $stdeunt->totalNoOfreturn + 1;
                $stdeunt->totalNoOfreturn = $totalbok;
                $stdeunt->save();
            }
            return redirect()->route('stduent.bookRent.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
}
