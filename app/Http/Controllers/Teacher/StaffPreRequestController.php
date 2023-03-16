<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\StaffBookPreRentHelper;
use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\EventCategory;
use App\Models\Setting;
use App\Models\Stduent\PreRequest;
use App\Models\Stduent\Stduent;
use App\Models\Teacher\StaffPreRequest;
use App\Models\Teacher\Teacher;
use App\Models\Teacher\Teacherrent;
use App\Repositories\Backend\Interf\StaffPreQuestRepository;
use App\Repositories\Backend\Interf\StaffRentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class StaffPreRequestController extends Controller
{
    use StaffBookPreRentHelper;
    private StaffPreQuestRepository $StaffPreQuestRepository;
    private StaffRentRepository $StaffRentRepository;
    public function __construct(StaffPreQuestRepository $StaffPreQuestRepository, StaffRentRepository $StaffRentRepository)
    {
        $this->middleware('permission:staffBookPreRent.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:staffBookPreRent.edit', ['only' => ['edit']]);
        $this->middleware('permission:staffBookPreRent.view', ['only' => ['index']]);
        $this->StaffPreQuestRepository = $StaffPreQuestRepository;
        $this->StaffRentRepository = $StaffRentRepository;
    }
    public function index()
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $datas = StaffPreRequest::with('book', 'teacher')->orderBy('id', 'DESC')->get();
            return $this->StaffBookPReRent_datatable($datas, $user);
        }
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('staff.prequestbook.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stduents  = Teacher::all();
        $books  = Books::all();
        view()->share(['form' => true, 'select' => true]);
        return view('staff.prequestbook.create', compact('books', 'stduents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->StaffPreQuestRepository->create($request->all());
        return redirect()
            ->route('staff.requestbyStaffs.index')
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
        $Author = $this->StaffPreQuestRepository->where('id', $id)->first();
        if ($Author) {
            $stduents  = Teacher::all();
            $books  = Books::all();
            view()->share(['form' => true, 'select' => true]);
            return view('staff.prequestbook.detail', compact('Author', 'books', 'stduents'));
        } else {
            return view('errorpage.404');
        }
    }
    public function edit($slug)
    {
        $author = $this->StaffPreQuestRepository->where('slug', $slug)->first();
        if ($author) {
            $categories = EventCategory::all();
            view()->share(['form' => true, 'select' => true]);
            return view('staff.prequestbook.edit', compact('author', 'categories'));
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
    }
    public function destroy(Request $request)
    {
        $eventcategory = $this->StaffPreQuestRepository->where('slug', $request->slug)->first();
        if ($eventcategory) {
            $this->StaffPreQuestRepository->deleteById($eventcategory->id);
            return redirect()->route('staff.requestbyStaffs.index')->with('success', 'Event  deleted successfully');
        }
        return view('errorpage.404');
    }

    public function multilecreate()
    {
        return view('staff.prequestbook.author_mulitiple_create');
    }


    public function template()
    {
    }

    public function importData(Request $request)
    {
    }
    public function mass_destroy(Request $request)
    {
    }
    public function approve(Request $request, $id)
    {
        $contactListdata = $this->StaffPreQuestRepository->where('id', $id)->first();
        if ($contactListdata) {
            $booktotalBookRented = Teacherrent::where('rentstatus', OFF)->where('teachers_id', $request->teachers_id)->get();
            $stduent_total_number_of_book = Setting::where('key', 'staff_total_number_of_book')->first()->value;
            $booktotalBookRentedcount = count($booktotalBookRented);
            $stduent_total_number_of_book_count = (int)$stduent_total_number_of_book;
            if ($booktotalBookRentedcount <= $stduent_total_number_of_book_count) {
                if ($contactListdata->status = OFF) {
                    $book_rent_duration = Setting::where('key', 'book_rent_duration')->first()->value;
                    $current_date = Carbon::now();
                    $book_return_date = Carbon::parse($current_date);
                    $enddate = $book_return_date->addDays($book_rent_duration);
                    $studentid = $contactListdata->teachers_id;
                    $bookid = $contactListdata->books_id;
                    $datas = $request->merge(['books_id' => $bookid, 'teachers_id' => $studentid, 'startdate' => $current_date, 'enddate' => $enddate, 'remark' => 'PreRequest Book.']);
                    $datass = $this->StaffRentRepository->create($datas->all());
                    $prerequestbook = StaffPreRequest::with('book', 'teacher')->where('id', $contactListdata->id)->first();
                    $totalBook = Books::where('id', $prerequestbook->books_id)->first();
                    if ($totalBook) {
                        if ($totalBook->availablebook > 1) {
                            $current_book = $totalBook->availablebook - 1;
                            $totalBook->availablebook = $current_book;
                            $totalBook->save();
                            $stdeunt = Teacher::where('id', $studentid)->first();
                            if ($stdeunt) {
                                $totalbok = $stdeunt->totalNoOfBooks + 1;
                                $stdeunt->totalNoOfBooks = $totalbok;
                                $stdeunt->save();
                            }
                            if ($contactListdata->status == ON) {
                                $contactListdata->status  = 'off';
                                $contactListdata->save();
                                $contactListdata->update(['status' => OFF]);
                            } else {
                                $contactListdata->status  = 'on';
                                $contactListdata->save();
                            }
                        } else {

                        Session::put('stafftotalBook', 'You cant Approve this Book ,The Number Books Availabel Count is Zero(0)!.');
                        return redirect()->back();
                        }
                    } else {
                        Session::put('stafftotalBook', 'There is no Book!.');
                        return redirect()->back();
                    }
                }
                Session::put('stafftotalBookApproved', 'Staff PreRequest Book Order is Approved Successfully.');
                return redirect()->route('staff.requestbyStaffs.index')->with(['success' => 'Successfully Updated!']);
            } else {
                Session::put('stafftotalBook', 'The Number Books Availabel for Staff is Limited!.You can\'t Approved at this time!.');
                return redirect()->back();
            }
        } else {
            return view('errorpage.404');
        }
    }

    public function mass_approve(Request $request)
    {
        $this->StaffPreQuestRepository->massUpdate($request->ids, ['status' => ON]);
        return redirect()->route('staff.requestbyStaffs.index')->with('success', 'Stduents Approved successfully');
    }
}
