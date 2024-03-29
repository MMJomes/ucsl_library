<?php

namespace App\Http\Controllers\Backend;

use App\Exports\BookExport;
use App\Helpers\BookHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Imports\BookListImport;
use App\Models\Author;
use App\Models\Books;
use App\Models\EventCategory;
use App\Repositories\Backend\Interf\BookListAllRepository;
use App\Repositories\Backend\Interf\BookListRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class BooksController extends Controller
{
    use BookHelper;
    private BookListAllRepository $bookListAllRepository;
    private BookListRepository $bookListRepository;

    public function __construct(BookListAllRepository $bookListAllRepository, BookListRepository $bookListRepository)
    {
        $this->middleware('permission:book.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:book.edit', ['only' => ['edit']]);
        $this->middleware('permission:book.view', ['only' => ['index']]);
        $this->bookListAllRepository = $bookListAllRepository;
        $this->bookListRepository = $bookListRepository;
    }

    public function index()
    {
        if (request()->ajax()) {
            $user = auth()->user();
            $data = Books::with('author', 'category')->orderBy('id','DESC')->get();
            return $this->booking_datatable($data, $user);
        }
        Session::put('admininfo', 'Your Excel Import Format must be same with Book Excel Import Format.If Not,Please Download First!.');
        view()->share(['datatable' => true, 'datatable_export' => true, 'toast' => false, 'sweet_alert' => true]);
        return view('backend.books.index');
    }

    public function create()
    {
        $authors = Author::all();
        $categories = EventCategory::all();
        view()->share(['form' => true, 'select' => true]);
        return view('backend.books.create', compact('authors', 'categories'));
    }
    public function store(BookRequest $request)
    {
        $data1 = DB::table('books')->latest('id')->first();
        if ($data1 == null) {
            $last_id = 1;
        } else {
            $id = Books::latest()->first()->id;
            $last_id = $id + 1;
        }
        if ($request->hasfile('logos')) {
            $img = $request->file('logos');
            $upload_path = public_path() . '/upload/books/';
            $file = $img->getClientOriginalName();
            $name = $last_id . $file;
            $img->move($upload_path, $name);
            $path = '/upload/books/' . $name;
        } else {
            $path = "/default-book.png";
        }
        $request->merge([
            'image' => $path,
            'availablebook' => $request->totalbook,
        ]);
        $this->bookListRepository->create($request);
        return redirect()
            ->route('backend.book.index')
            ->with(['success' => 'Successfully Added']);
    }
    public function show($member_slug)
    {
        $book = $this->bookListAllRepository->where('slug', $member_slug)->first();
        if ($book) {
            $authors = Author::all();
            $categories = EventCategory::all();
            view()->share(['form' => true, 'select' => true]);
            return view('backend.books.detail', compact('book', 'authors', 'categories'));
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
    public function edit($member_slug)
    {
        $book = $this->bookListAllRepository->where('slug', $member_slug)->first();
        if ($book) {
            $categories = EventCategory::all();
            $authors = Author::all();
            view()->share(['form' => true, 'select' => true]);
            return view('backend.books.edit', compact('book', 'categories', 'authors'));
        } else {
            return view('errorpage.404');
        }
    }
    public function update(BookRequest $request, $member_slug)
    {

        $bookdata = $this->bookListAllRepository->where('slug', $member_slug)->first();
        if ($bookdata) {
            if ($request->hasfile('logos')) {
                $img = $request->file('logos');
                $upload_path = public_path() . '/upload/books/';
                $file = $img->getClientOriginalName();
                $name = $bookdata->id . $file;
                $img->move($upload_path, $name);
                $path = '/upload/books/' . $name;
            } else {
                $path = $request->oldimg;
            }
            $request->merge([
                'logo' => $path,
            ]);
            $request->merge(['image' => $path]);
            $bookdata->update($request->all());
            return redirect()->route('backend.book.index')->with(['success' => 'Successfully Updated!']);
        } else {
            return view('errorpage.404');
        }
    }
    public function destroy(Request $request)
    {
        $contactListdata = $this->bookListAllRepository->where('slug', $request->slug)->first();
        if ($contactListdata) {
            $this->bookListAllRepository->deleteById($contactListdata->id);
            return redirect()->route('backend.book.index')->with('success', 'Member deleted successfully');
        }
        return view('errorpage.404');
    }

    public function multilecreate()
    {
        return view('backend.books.mulitiple_create');
    }
    public function template()
    {
        $file = public_path() . "/book_list_templated.xlsx";

        if (file_exists($file)) {
            return Response::download($file, 'book_list_templated.xlsx');
        } else {
            return 'file not found';
        }
    }

    public function importData(Request $request)
    {

        $dat = strtolower($request->import_file->getClientOriginalExtension());
        if ($dat != 'xlsx') {
            Session::put('importError', 'Invaild  Excel Import Format. Please Correct Excel Format!.');
            return redirect()->back();
        } else {
        $request->validate([
            'import_file' => 'required'
        ]);
        try {
            Excel::import(new BookListImport, $request->import_file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            Session::put('importError', 'Invaild Data, Please Check Your Excel Data');
            return redirect()->back();
        }
        return redirect()->route('backend.book.index')->with(['success' => 'Successfully Upload!']);
    }
}

    public function mass_destroy(Request $request)
    {
        $this->bookListAllRepository->deleteMultipleById($request->ids);
        return redirect()->route('backend.book.index')->with('success', 'Books deleted successfully');
    }

    public function approve(Request $request)
    {
    }

    public function mass_approve(Request $request)
    {
    }

    public function excelexport()
    {
        return Excel::download(new BookExport(), 'Book_List.xlsx');
    }
}
