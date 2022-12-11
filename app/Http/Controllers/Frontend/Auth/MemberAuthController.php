<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\Auth\MemberLoginRequest;
use App\Models\Books;
use App\Models\Setting;
use App\Models\Stduent\StdClass;
use App\Models\Stduent\Stduent;
use App\Models\Teacher\Departement;
use App\Models\Teacher\Teacher;
use App\Repositories\Backend\Interf\StaffRentRepository;
use App\Repositories\Backend\Interf\StudentRepository;
use App\Repositories\Frontend\Interf\MemberAuthRepository;
use Illuminate\Http\Request;
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
        if ($request->usertype = 'staff') {
            $staffemail = Teacher::where('email', $request->email)->first();
            if ($staffemail) {
                if ($staffemail->status = ON) {
                    return "OK";
                }
            } else {
                return "NO";
            }
        } elseif ($request->usertype = 'staff') {

            $std = Stduent::where('email', $request->email)->first();
            if ($std) {
                if ($std->status = ON) {
                    return "OK";
                }
            }
        } else {
            return "There is no user";
        }
        return redirect()->back()->withInput();
    }
    public function reg(Request $request)
    {
        $setting_approve =  Setting::where('key', 'reg_approve')->first();
        if ($setting_approve->value == ON) {
            $request->merge(['status' => ON]);
        }
        if ($request->usertype = "stduent") {
            $data = $this->studentRepository->create($request->all());
        } else {

            $data = $this->StaffRentRepository->create($request->all());
        }
        if ($data) {
            return "Member Login Success";
        } else {
            return redirect()->route('login')->withErrors(['message' => 'User Login Failed!']);
        }
        $res = $this->repository->login($request);
        if ($res == SUCCESS) {
            return view('frontend.profile.index');
            return "Member Login Success";
            // $intendedURL = session()->get('url.intended');
            // if ($intendedURL) {
            //     session()->forget('url.intended');
            //     return redirect()->intended($intendedURL)->with(['success' => 'User Login Success!']);
            // } else {
            //     return redirect()->route('home')->with(['success' => 'User Login Success!']);
            // }
        }
        return redirect()->back()->withInput();
    }
    public function passwordReset()
    {
        return view('frontend.auth.email');
    }
    public function books(Request $request){

        if ($request->ajax()) {
            $data = Books::with('author', 'category')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('frontend.userpage.totalbook');

     }
}
