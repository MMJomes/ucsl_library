<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\Setting;
use App\Models\Stduent\Bookrent;
use App\Models\Stduent\PreRequest;
use App\Models\Stduent\StdClass;
use App\Models\Stduent\Stduent;
use App\Models\Teacher\Departement;
use App\Models\Teacher\Teacher;
use App\Repositories\Backend\Interf\StaffRentRepository;
use App\Repositories\Backend\Interf\StudentRepository;
use App\Repositories\Frontend\Interf\MemberAuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class MemberAuthController extends Controller
{

    private MemberAuthRepository $repository;
    private StudentRepository $studentRepository;
    private StaffRentRepository $StaffRentRepository;



    public function __construct(MemberAuthRepository $repository, StudentRepository $studentRepository, StaffRentRepository $StaffRentRepository)
    {
        $this->repository = $repository;
        $this->studentRepository = $studentRepository;
        $this->StaffRentRepository = $StaffRentRepository;
    }

    public function login()
    {

        // $data  = Session::get('email');
        // dd($data);
        // dd(Session::has('applocale'));
        // Session::put('email', $request->email);

        $site_maintenance = Setting::where('key', 'site_maintenance')->first();
        if ($site_maintenance->value == 'on') {
            return view('frontend.auth.coming_soon');
        } else {
            $already_registered = auth()->guard('members')->user();
            if ($already_registered) {
                return redirect()->route('users.totalbook');
            }
            $dcategories  = Departement::all();
            $categories  = StdClass::all();
            view()->share(['form' => true, 'select' => true]);
            return view('frontend.auth.login', compact('categories', 'dcategories'));
        }
    }
    public function register()
    {
        $site_maintenance = Setting::where('key', 'site_maintenance')->first();
        if ($site_maintenance->value == 'on') {
            return view('frontend.auth.coming_soon');
        } else {
            $already_registered = auth()->guard('members')->user();
            if ($already_registered) {
                return redirect()->route('/');
            }
            $dcategories  = Departement::all();
            $categories  = StdClass::all();
            view()->share(['form' => true, 'select' => true]);
            return view('frontend.auth.register', compact('categories', 'dcategories'));
        }
    }

    public function loginAction(Request $request)
    {
        if ($request->usertype == 'staff') {
            dd("Stff");
            $staffemail = Teacher::where('email', $request->email)->first();
            if ($staffemail) {
                if ($staffemail->status = ON) {
                    Session::put('email', $request->email);
                    return redirect()->route('users.totalbook');
                } else {
                    return redirect()->route('member.index')->withErrors(['message' => 'Your Account Is Not Active Yet! ,Please Contact to Admin.']);
                }
            } else {
                return redirect()->route('member.register')->withErrors(['message' => 'Your Account Already Exit']);
            }
        } elseif ($request->usertype == 'stduent') {
            $std = Stduent::where('email', $request->email)->first();
            if ($std) {
                if ($std->status = ON) {
                    Session::put('email', $request->email);
                    return redirect()->route('users.totalbook');
                } else {
                    return redirect()->route('member.index')->withErrors(['message' => 'Your Account Is Not Active Yet! ,Please Contact to Admin.']);
                }
            } else {
                return redirect()->route('member.register')->withErrors(['message' => 'Your Account Already Exit']);
            }
        } else {
            return "There is no user";
        }
        return redirect()->back()->withInput();
    }
    public function regAction(Request $request)
    {
        $useremail = $request->email;
        $userclass = $request->std_classes_id;
        $userrollno = $request->rollno;
        $setting_approve =  Setting::where('key', 'reg_approve')->first();
        if ($setting_approve->value == ON) {
            $request->merge(['status' => ON]);
        }
        if ($request->usertype = "stduent") {
            $isExit = Stduent::with('stdclass')->where('email', $useremail)->where('rollno', $userrollno)->whereHas('stdclass', function ($query) use ($userclass) {
                $query->where('id', $userclass);
            })->first();
            if ($isExit) {
                return redirect()->route('member.index')->withErrors(['message' => 'Your Account Already Exit']);
            } else {
                $isExit = Teacher::with('stdclass')->where('email', $useremail)->first();
                if ($isExit) {
                    return redirect()->route('member.index')->withErrors(['message' => 'Your Account Already Exit']);
                } else {
                    Session::put('email', $request->email);
                    $data = $this->studentRepository->create($request->all());
                    return redirect()->route('users.totalbook');
                }
            }
        } else {
            Session::put('email', $request->email);
            $data = $this->StaffRentRepository->create($request->all());
        }
        if ($data) {
            return redirect()->route('users.totalbook');
        } else {
            return redirect()->route('login')->withErrors(['message' => 'User Login Failed!']);
        }

        return redirect()->back()->withInput();
    }
    public function passwordReset()
    {
        return view('frontend.auth.email');
    }

    public function totalbook(Request $request)
    {
        $useremail  = Session::get('email');
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($staffemail != null || $stdemail != null) {
            if ($request->ajax()) {
                $data = Books::with('author', 'category')->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }
            return view('frontend.userpage.totalbook');
        } else {
            return redirect()->route('login')->withErrors(['message' => 'Please Login First!']);
        }
    }
    public function bookorder(Request $request, $bookid)
    {
        $useremail  = Session::get('email');
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($staffemail != null || $stdemail != null) {
            dd($bookid);
            //     dd($bookid);
            //  dd($bookid);
            //     dd($request->all());

            return response()->json([
                'message' => 'Auction BOOKORDER Created Successfully',
            ]);
        } else {
            return redirect()->route('login')->withErrors(['message' => 'Please Login First!']);
        }
    }
    public function rent(Request $request, $stduent_id = 5)
    {
        $useremail  = Session::get('email');
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($staffemail != null || $stdemail != null) {
            if ($request->ajax()) {
                $data = Bookrent::with('book', 'stduent')->orderBy('created_at', 'ASC')->get();
                //$data = Bookrent::with('book', 'stduent')->where('stduents_id', $stduent_id)->orderBy('created_at', 'ASC')->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('frontend.userpage.totalrent');
        } else {
            return redirect()->route('login')->withErrors(['message' => 'Please Login First!']);
        }
    }
    public function prenent($bookid)
    {

        $useremail  = Session::get('email');
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($staffemail != null || $stdemail != null) {
            //     dd($bookid);
            //  dd($bookid);
            //     dd($request->all());

            return response()->json([
                'message' => 'Auction Created Successfully',
            ]);
        } else {
            return redirect()->route('login')->withErrors(['message' => 'Please Login First!']);
        }
    }


    public function prerequest(Request $request, $stduent_id = 5)
    {
        $useremail  = Session::get('email');
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($staffemail != null || $stdemail != null) {
            if ($request->ajax()) {
                $data = PreRequest::with('book', 'stduent')->orderBy('created_at', 'DESC')->get();
                //$data = Bookrent::with('book', 'stduent')->where('stduents_id', $stduent_id)->orderBy('created_at', 'ASC')->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('frontend.userpage.userprerequesttotalbook');
        } else {
        }
    }
    public function prerequestAction(Request $request)
    {
        $useremail  = Session::get('email');
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($staffemail != null || $stdemail != null) {
            //     dd($bookid);
            //  dd($bookid);
            //     dd($request->all());

            return response()->json([
                'message' => 'Auction Created Successfully',
            ]);
        } else {
            return redirect()->route('login')->withErrors(['message' => 'Please Login First!']);
        }
    }

    public function userProfile(Request $request)
    {
        $useremail  = Session::get('email');
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($staffemail != null || $stdemail != null) {
            //     dd($bookid);
            //  dd($bookid);
            //     dd($request->all());

            return response()->json([
                'message' => 'Auction Created Successfully',
            ]);
        } else {
            return redirect()->route('login')->withErrors(['message' => 'Please Login First!']);
        }
    }

    public function LoginOut(Request $request)
    {
        $useremail  = Session::get('email');
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($staffemail != null || $stdemail != null) {
            //     dd($bookid);
            //  dd($bookid);
            //     dd($request->all());

            return response()->json([
                'message' => 'Auction Created Successfully',
            ]);
        } else {
            return redirect()->route('login')->withErrors(['message' => 'Please Login First!']);
        }
    }
}
