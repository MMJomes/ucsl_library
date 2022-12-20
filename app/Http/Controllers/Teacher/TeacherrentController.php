<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\BookRentHelper;
use App\Helpers\StaffRentHelper;
use App\Http\Controllers\Controller;
use App\Imports\AuthorListImport;
use App\Models\Books;
use App\Models\Setting;
use App\Models\Teacher\Teacher;
use App\Models\Teacher\Teacherrent;
use App\Notifications\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use App\Repositories\Backend\Interf\StaffRentRepository;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class TeacherrentController extends Controller
{
    use StaffRentHelper;
    private StaffRentRepository $StaffRentRepository;

    public function __construct(StaffRentRepository $StaffRentRepository)
    {
        $this->middleware('permission:staffBookRent.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:staffBookRent.edit', ['only' => ['edit']]);
        $this->middleware('permission:staffBookRent.view', ['only' => ['index']]);
        $this->StaffRentRepository = $StaffRentRepository;
    }
    public function index()
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $datas = Teacherrent::with('book', 'teacher')->orderBy('id', 'DESC')->get();
            return $this->StaffRent_datatable($datas, $user);
        }
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('staff.bookrent.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers  = Teacher::with('department')->get();
        $books  = Books::all();
        view()->share(['form' => true, 'select' => true]);
        return view('staff.bookrent.create', compact('books', 'teachers'));
    }
    public function store(Request $request)
    {

        $booktotalBookRented = Teacherrent::where('rentstatus', OFF)->where('stduents_id', $request->teachers_id)->get();
        $stduent_total_number_of_book = Setting::where('key', 'staff_total_number_of_book')->first()->value;
        $booktotalBookRentedcount = count($booktotalBookRented);
        $stduent_total_number_of_book_count= (int)$stduent_total_number_of_book;
        if ($booktotalBookRentedcount < $stduent_total_number_of_book_count) {
        $book_rent_duration = Setting::where('key', 'staff_book_rent_duration')->first()->value;
        $book_return_date = Carbon::parse($request->startdate);
        $enddate = $book_return_date->addDays($book_rent_duration);
        $request->merge(['enddate' => $enddate]);
        $data = $this->StaffRentRepository->create($request->all());
        $book = Books::where('id', $data->books_id)->first();
        if ($book) {
            $totalbooks = $book->totalbook;
            if ($totalbooks > 0) {
                $bookrentstatus = Teacherrent::where('id', $data->id)->where('books_id', $data->books_id)->first();
                if ($bookrentstatus) {
                    if ($bookrentstatus->rentstatus == OFF) {
                        $currentavailablebook  = $book->availablebook - 1;
                        $book->availablebook = $currentavailablebook;
                        $book->save();
                    }
                }
            }
        }
        $stdeunt = Teacher::where('id', $data->teachers_id)->first();
        if ($stdeunt) {
            $totalbok = $stdeunt->totalNoOfBooks + 1;
            $stdeunt->totalNoOfBooks = $totalbok;
            $stdeunt->save();
        }
        return redirect()
            ->route('staff.rentbyStaff.index')
            ->with(['success' => 'Successfully Added']);
        }else{
            Session::put('stafftotalBook','The Number Books Availabel for Staff is Limited!.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = $this->StaffRentRepository->where('id', $id)->first();
        if ($author) {

            $teachers  = Teacher::with('department')->get();
            $books  = Books::all();
            view()->share(['form' => true, 'select' => true]);
            return view('staff.bookrent.detail', compact('author', 'teachers', 'books'));
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
        $author = $this->StaffRentRepository->where('id', $id)->first();
        if ($author) {
            $teachers  = Teacher::with('department')->get();
            $books  = Books::all();
            view()->share(['form' => true, 'select' => true]);
            return view('staff.bookrent.edit', compact('author', 'teachers', 'books'));
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
        $Author = $this->StaffRentRepository->where('id', $id)->first();
        if ($Author) {
            $strtime = $request->startdate;
            $book_rent_duration = Setting::where('key', 'staff_book_rent_duration')->first()->value;
            $book_return_date = Carbon::parse($strtime);
            $enddate = $book_return_date->addDays($book_rent_duration);
            $request->merge(['enddate' => $enddate, 'startdate' => $strtime]);
            $this->StaffRentRepository->updateById($Author->id, $request->all());
            return redirect()->route('staff.rentbyStaff.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function continuce(Request $request, $id)
    {
        $Author = $this->StaffRentRepository->where('id', $id)->first();
        if ($Author) {
            $strtime = $Author->enddate;
            $book_rent_duration = Setting::where('key', 'staff_book_rent_duration')->first()->value;
            $book_return_date = Carbon::parse($strtime);
            $enddate = $book_return_date->addDays($book_rent_duration);
            $request->merge(['enddate' => $enddate, 'startdate' => $strtime, 'remark' => "Continuced"]);
            $this->StaffRentRepository->updateById($Author->id, $request->all());
            return redirect()->route('staff.rentbyStaff.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function requestStausApproved(Request $request, $id)
    {
        $Author = $this->StaffRentRepository->where('id', $id)->first();
        if ($Author) {
            $strtime = $Author->enddate;
            $book_rent_duration = Setting::where('key', 'staff_book_rent_duration')->first()->value;
            $book_return_date = Carbon::parse($strtime);
            $enddate = $book_return_date->addDays($book_rent_duration);
            $request->merge(['enddate' => $enddate, 'startdate' => $strtime,  'remark' => "Continuced", 'requesttatus' => 'off', 'approvetatus' => 'on', 'remark' => "User Request Has Been Approved By Admin"]);
            $this->StaffRentRepository->updateById($Author->id, $request->all());
            $Author->notify(new SendEmail($Author->name, "Congratulations! ", "Your Request Been Approved By Admin"));
            return redirect()->route('staff.rentbyStaff.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function requestStausRejected(Request $request, $id)
    {
        $Author = $this->StaffRentRepository->where('id', $id)->first();
        if ($Author) {
            $strtime = $Author->enddate;
            $book_rent_duration = Setting::where('key', 'staff_book_rent_duration')->first()->value;
            $book_return_date = Carbon::parse($strtime);
            $enddate = $book_return_date->addDays($book_rent_duration);
            $request->merge(['enddate' => $enddate, 'startdate' => $strtime,  'remark' => "Continuced", 'requesttatus' => 'off', 'approvetatus' => 'off', 'remark' => "User Request Has Been Reject By Admin"]);
            $this->StaffRentRepository->updateById($Author->id, $request->all());
            $Author->notify(new SendEmail($Author->name, "Sorry!"," Your Request Been Rejected By Admin"));
            return redirect()->route('staff.rentbyStaff.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request, $id)
    {
        $eventcategory = $this->StaffRentRepository->where('id', $request->slug)->first();
        if ($eventcategory) {
            $this->StaffRentRepository->deleteById($eventcategory->id);
            return redirect()->route('staff.rentbyStaff.index')->with('success', 'Event  deleted successfully');
        }
        return view('errorpage.404');
    }

    public function multilecreate()
    {
        return view('staff.bookrent.author_mulitiple_create');
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
        return redirect()->route('staff.rentbyStaff.index')->with(['success' => 'Successfully Upload!']);
    }
    public function mass_destroy(Request $request)
    {
        $this->StaffRentRepository->deleteMultipleById($request->ids);
        return redirect()->route('staff.rentbyStaff.index')->with('success', 'Author  deleted successfully');
    }
    public function approve(Request $request, $id)
    {
        $contactListdata = $this->StaffRentRepository->where('id', $id)->first();
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
            $stdeunt = Teacher::where('id', $contactListdata->teachers_id)->first();
            if ($stdeunt) {
                $totalbok = $stdeunt->totalNoOfreturn + 1;
                $stdeunt->totalNoOfreturn = $totalbok;
                $stdeunt->save();
            }
            return redirect()->route('staff.rentbyStaff.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
}
