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
use App\Models\Teacher\StaffPreRequest;
use App\Models\Teacher\Teacher;
use App\Models\Teacher\Teacherrent;
use App\Repositories\Backend\Interf\StaffRentRepository;
use App\Repositories\Backend\Interf\StudentRepository;
use App\Repositories\Frontend\Interf\MemberAuthRepository;
use App\Repositories\Backend\Interf\BookRentRepository;
use App\Repositories\Backend\Interf\PreQuestRepository;
use App\Repositories\Backend\Interf\StaffPreQuestRepository;
use App\Repositories\Backend\Interf\StaffRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MemberAuthController extends Controller
{
    private StudentRepository $studentRepository;
    private StaffRepository $StaffRepository;
    private StaffRentRepository $StaffRentRepository;
    private BookRentRepository $BookRentRepository;
    private PreQuestRepository $PreQuestRepository;
    private StaffPreQuestRepository $StaffPreQuestRepository;
    public function __construct(
        StaffRepository $StaffRepository,
        PreQuestRepository $PreQuestRepository,
        MemberAuthRepository $repository,
        StudentRepository $studentRepository,
        StaffRentRepository $StaffRentRepository,
        BookRentRepository $BookRentRepository,
        StaffPreQuestRepository $StaffPreQuestRepository
    ) {
        $this->studentRepository = $studentRepository;
        $this->StaffRentRepository = $StaffRentRepository;
        $this->BookRentRepository = $BookRentRepository;
        $this->PreQuestRepository = $PreQuestRepository;
        $this->StaffRepository = $StaffRepository;
        $this->StaffPreQuestRepository =  $StaffPreQuestRepository;
    }
    public function login()
    {
        $site_maintenance = Setting::where('key', 'site_maintenance')->first();
        if ($site_maintenance->value == ON) {
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
        if ($site_maintenance->value == ON) {
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
    // public function loginAction(Request $request)
    // {
    //     dd($request->all());
    //     if ($request->usertype == 'staff') {
    //         $email = $request->email;
    //         $emailValid = substr($email, -17);
    //         if ($emailValid == "@ucsloikaw.edu.mm") {
    //             $staffemail = Teacher::where('email', $request->email)->first();
    //             if ($staffemail) {
    //                 if ($staffemail->status == ON) {
    //                     Session::put('email', $request->email);
    //                     return redirect()->route('users.totalbook');
    //                 } else {
    //                     Session::put('error', 'Your account is not activited yet by the admin. Please contact admin for more detail.');
    //                     return redirect()->back();
    //                 }
    //             } else {
    //                 Session::put('error', 'You Look Don\'t have an Account!.Please Register First.');
    //                 return redirect()->back();
    //             }
    //         } else {
    //             Session::put('error', 'Invail Email Address,Please Prodie Vaild Email Address.');
    //             return redirect()->back();
    //         }
    //     } elseif ($request->usertype == 'stduent') {
    //         $email = $request->email;
    //         $emailValid = substr($email, -17);
    //         if ($emailValid == "@ucsloikaw.edu.mm") {
    //             $std = Stduent::where('email', $request->email)->first();
    //             if ($std) {
    //                 if ($std->status == ON) {
    //                     Session::put('email', $request->email);
    //                     return redirect()->route('users.totalbook');
    //                 } else {
    //                     Session::put('error', 'Your account is not activited yet by the admin. Please contact admin for more detail.');
    //                     return redirect()->back();
    //                     dd("OK");
    //                 }
    //             } else {
    //                 Session::put('error', 'You Look Don\'t have an Account!.Please Register First.');
    //                 return redirect()->back();
    //             }
    //         } else {
    //             Session::put('error', 'Invail Email Address,Please Prodie Vaild Email Address.');
    //             return redirect()->back();
    //         }
    //     }
    //     return redirect()->back();
    // }

    public function loginAction(Request $request)
    {
        $email = $request->email;
        $emailValid = substr($email, -17);
        if ($emailValid == "@ucsloikaw.edu.mm") {
            $staffemail = Teacher::where('email', $request->email)->first();
            if ($staffemail) {
                if ($staffemail) {
                    if ($staffemail->status == ON) {
                        Session::put('email', $request->email);
                        return redirect()->route('users.totalbook');
                    } else {
                        Session::put('error', 'Your account is not activited yet by the admin. Please contact admin for more detail.');
                        return redirect()->back();
                    }
                } else {
                    Session::put('error', 'You Look Don\'t have an Account!.Please Register First.');
                    return redirect()->back();
                }
            } else {
                $std = Stduent::where('email', $request->email)->first();
                if ($std) {
                    if ($std->status == ON) {
                        Session::put('email', $request->email);
                        return redirect()->route('users.totalbook');
                    } else {
                        Session::put('error', 'Your account is not activited yet by the admin. Please contact admin for more detail.');
                        return redirect()->back();
                    }
                } else {
                    Session::put('error', 'You Look Don\'t have an Account!.Please Register First.');
                    return redirect()->back();
                }
            }
        } else {
            Session::put('error', 'Invail Email Address,Please Prodie Vaild Email Address.');
            return redirect()->back();
        }

        return redirect()->back();
    }
    public function regAction(Request $request)
    {
        $useremail = $request->email;
        $userclass = $request->std_classes_id;
        $userrollno = $request->rollno;

        $email = $request->email;
        $emailValid = substr($email, -17);
        if ($emailValid == "@ucsloikaw.edu.mm") {
            $setting_approve =  Setting::where('key', 'reg_approve')->first();
            if ($setting_approve->value == ON) {
                $request->merge(['status' => ON]);
            } else {
                $request->merge(['status' => OFF]);
            }
            if ($request->usertype == "stduent") {
                if ($request->rollno != null || $request->rollno != '') {
                    $isExit = Stduent::with('stdclass')->where('email', $useremail)->where('rollno', $userrollno)->whereHas('stdclass', function ($query) use ($userclass) {
                        $query->where('id', $userclass);
                    })->first();
                    if ($isExit) {
                        Session::put('error', 'Email Address And Roll Number is Already Exit!');
                        return redirect()->back();
                    } else {
                        Session::put('email', $request->email);
                        $data = $this->studentRepository->create($request->all());
                        $myStatus = $data->status;
                        if ($myStatus == OFF) {
                            Session::put('success', 'Your Account is Crated Successful!,And Your Account Is Review,Please Wait For Admin Approve!');
                            return redirect()->back();
                        } else {
                            Session::put('email', $request->email);
                            return redirect()->route('users.totalbook');
                        }
                    }
                } else {
                    Session::put('error', 'Stdeunt Roll Number is Required!');
                    return redirect()->back();
                }
            }
            if ($request->usertype == "staff") {
                $isExit = Teacher::where('email', $useremail)->first();
                if (!$isExit) {
                    Session::put('email', $request->email);
                    $data = $this->StaffRepository->create($request->all());
                    if ($data) {
                        $myStatus = $data->status;
                        if ($myStatus == OFF) {
                            Session::put('success', 'Your Account is Crated Successful!,And Your Account Is Review,Please Wait For Admin Approve!');
                            return redirect()->back();
                        } else {
                            Session::put('email', $request->email);
                            return redirect()->route('users.totalbook');
                        }
                    }
                } else {
                    Session::put('error', 'Email Address is Already Exit!');
                    return redirect()->back();
                }
            }
        } else {
            Session::put('error', 'Invail Email Address,Please Prodie Vaild Email Address.');
            return redirect()->back();
        }
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
                $data = Books::with('author', 'category')->orderBy('created_at', 'DESC')->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }
            return view('frontend.userpage.totalbook');
        } else {
            return redirect()->route('member.index')->withErrors(['message' => 'Please Login First!']);
        }
    }
    public function bookorder(Request $request, $id)
    {
        //dd($request->all(),$id);
        $useremail  = Session::get('email');
        //dd($useremail);
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($stdemail != null || $staffemail != null) {
            $boookiddata = Books::with('author', 'category')->where('id', $id)->first();
            if ($boookiddata) {
                if ($staffemail) {
                    // if ($boookiddata->availablebook >= 1) {
                    //     $useremailid = $staffemail->id;
                    //     $booksid = $boookiddata->id;
                    //     $startdated = Carbon::now();
                    //     $request->merge(['books_id' => $booksid, 'teachers_id' => $useremailid, 'startdate' => $startdated, 'remark', "Order By User!"]);
                    //     $data = $this->StaffRentRepository->create($request->all());
                    //     if ($data)
                    //         return response()->json([
                    //             'message' => 'Your BOOK ORDER Created Successfully',
                    //         ]);
                    // } else {
                    //     $useremailid = $staffemail->id;
                    //     $booksid = $boookiddata->id;
                    //     $request->merge(['books_id' => $booksid, 'stduents_id' => $useremailid,  'remark', " PreOrder By User!"]);
                    //     $data = $this->StaffPreQuestRepository->create($request->all());
                    //     if ($data)
                    //         return response()->json([
                    //             'message' => 'Your BOOK PREORDER Created Successfully',
                    //         ]);
                    // }
                    $useremailid = $staffemail->id;
                    $booksid = $boookiddata->id;
                    $request->merge(['books_id' => $booksid, 'teachers_id' => $useremailid,  'remark', " PreOrder By User!"]);
                    $data = $this->StaffPreQuestRepository->create($request->all());
                    if ($data)
                        return response()->json([
                            'message' => 'Your Book Order Created Successfully',
                        ]);
                }
                if ($stdemail) {
                    // if ($boookiddata->availablebook >= 1) {
                    //     $useremailid = $stdemail->id;
                    //     $booksid = $boookiddata->id;
                    //     $startdated = Carbon::now();
                    //     $request->merge(['books_id' => $booksid, 'stduents_id' => $useremailid, 'startdate' => $startdated, 'remark' => "Order By User!"]);
                    //     $data = $this->BookRentRepository->create($request->all());
                    //     if ($data)
                    //         return response()->json([
                    //             'message' => 'Your BOOK ORDER Created Successfully',
                    //         ]);
                    // } else {
                    //     $useremailid = $stdemail->id;
                    //     $booksid = $boookiddata->id;
                    //     $request->merge(['books_id' => $booksid, 'stduents_id' => $useremailid,  'remark' => " PreOrder By User!"]);
                    //     $data = $this->PreQuestRepository->create($request->all());
                    //     if ($data)
                    //         return response()->json([
                    //             'message' => 'Your BOOK PREORDER Created Successfully',
                    //         ]);
                    // }
                    $useremailid = $stdemail->id;
                    $booksid = $boookiddata->id;
                    $request->merge(['books_id' => $booksid, 'stduents_id' => $useremailid,  'remark' => " PreOrder By User!"]);
                    $data = $this->PreQuestRepository->create($request->all());
                    if ($data)
                        return response()->json([
                            'message' => 'Your Book Order Created Successfully',
                        ]);
                }
            } else {
                return response()->json([
                    'error' => 'There is No Book',
                ]);
            }
        } else {
            return redirect()->route('member.index')->withErrors(['message' => 'Please Login First!']);
        }
    }
    public function rent(Request $request)
    {
        $useremail  = Session::get('email');
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($stdemail) {
        }
        if ($staffemail != null || $stdemail != null) {
            if ($stdemail) {
                if ($request->ajax()) {
                    $data = Bookrent::with('book', 'stduent')->where('stduents_id', $stdemail->id)->orderBy('created_at', 'DESC')->get();
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
            }
            if ($staffemail) {
                if ($request->ajax()) {
                    $data = Teacherrent::with('book', 'teacher')->where('teachers_id', $staffemail->id)->orderBy('created_at', 'DESC')->get();
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
            }
        } else {
            return redirect()->route('member.index')->withErrors(['message' => 'Please Login First!']);
        }
    }
    public function prenent(Request $request, $id)
    {
        $useremail  = Session::get('email');
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($staffemail != null || $stdemail != null) {
            if ($staffemail) {
                $data = Teacherrent::where('id', $id)->first();
                if ($data) {
                    $data->requesttatus = 'on';
                    $data->save();
                    return response()->json([
                        'message' => 'Book Continue Rent Is Create Successfully ',
                    ]);
                } else {
                    return response()->json([
                        'error' => 'There is No Data!',
                    ]);
                }
            }
            if ($stdemail) {
                $data = Bookrent::where('id', $id)->first();
                if ($data) {
                    $data->requesttatus = 'on';
                    $data->save();
                    return response()->json([
                        'message' => 'Book  Continue Rent Is Create Successfully ',
                    ]);
                } else {
                    return response()->json([
                        'error' => 'There is No Data!',
                    ]);
                }
            }
        } else {
            return redirect()->route('member.index')->withErrors(['message' => 'Please Login First!']);
        }
    }
    public function prerequest(Request $request)
    {
        $useremail  = Session::get('email');
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($staffemail != null || $stdemail != null) {
            if ($stdemail) {
                if ($request->ajax()) {
                    $data = PreRequest::with('book', 'stduent')->where('stduents_id', $stdemail->id)->orderBy('created_at', 'DESC')->get();
                    return DataTables::of($data)
                        ->addIndexColumn()
                        ->make(true);
                }
                return view('frontend.userpage.userprerequesttotalbook');
            }
            if ($staffemail) {
                if ($request->ajax()) {
                    $data = StaffPreRequest::with('book', 'teacher')->where('teachers_id', $staffemail->id)->orderBy('created_at', 'DESC')->get();
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
            }
        } else {
            return redirect()->route('member.index')->withErrors(['message' => 'Please Login First!']);
        }
    }
    public function prerequestAction(Request $request, $id)
    {
        $useremail  = Session::get('email');
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($staffemail != null || $stdemail != null) {
            if ($stdemail) {
                PreRequest::where('id', $id)->delete();
                return response()->json([
                    'message' => 'You Have Been Cancel PreRequst Book!',
                ]);
            }
            if ($staffemail) {
                StaffPreRequest::where('id', $id)->delete();
                return response()->json([
                    'message' => 'You Have Been Cancel PreRequst Book!',
                ]);
            }
        } else {
            return redirect()->route('member.index')->withErrors(['message' => 'Please Login First!']);
        }
    }

    public function userProfile(Request $request)
    {
        $useremail  = Session::get('email');
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($staffemail != null || $stdemail != null) {
            if ($stdemail) {
                $stduentCls = StdClass::all();
                view()->share(['form' => true, 'select' => true]);
                return view('frontend.userpage.userprofile', compact('stdemail', 'stduentCls',));
            }
            if ($staffemail) {
                view()->share(['form' => true, 'select' => true]);
                $stduentCls = Departement::all();
                return view('frontend.userpage.staffuserprofile', compact('staffemail', 'stduentCls',));
            }
        } else {
            return redirect()->route('member.index')->withErrors(['message' => 'Please Login First!']);
        }
    }

    public function userProfileAction(Request $request)
    {
        $useremail  = Session::get('email');
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($staffemail != null || $stdemail != null) {
            if ($stdemail) {
                $email = $request->email;
                $emailValid = substr($email, -17);
                if ($emailValid == "@ucsloikaw.edu.mm") {
                    if ($request->hasfile('logos')) {
                        $img = $request->file('logos');
                        $upload_path = public_path() . '/upload/stduent/';
                        $file = $img->getClientOriginalName();
                        $name = $stdemail->id . $file;
                        $img->move($upload_path, $name);
                        $path = '/upload/stduent/' . $name;
                    } else {
                        $path = $request->oldimg;
                    }
                    $request->merge([
                        'logo' => $path,
                    ]);
                    $request->merge(['image' => $path]);
                    $datas = $this->studentRepository->updateById($stdemail->id, $request->all());
                    if ($datas) {
                        Session::put('email', $request->email);
                    }
                    return redirect()->route('member.profile')->with(['success' => 'Successfully Updated!']);
                } else {
                    redirect()->back()->with('success', 'Invail Email Address!');
                }
                $stduentCls = StdClass::all();
                return view('frontend.userpage.userprofile', compact('stdemail', 'stduentCls',));
            }
            if ($staffemail) {
                $email = $request->email;
                $emailValid = substr($email, -17);
                if ($emailValid == "@ucsloikaw.edu.mm") {
                    if ($request->hasfile('logos')) {
                        $img = $request->file('logos');
                        $upload_path = public_path() . '/upload/staff/';
                        $file = $img->getClientOriginalName();
                        $name = $staffemail->id . $file;
                        $img->move($upload_path, $name);
                        $path = '/upload/staff/' . $name;
                    } else {
                        $path = $request->oldimg;
                    }
                    $request->merge([
                        'logo' => $path,
                    ]);
                    $request->merge(['image' => $path]);
                    $this->StaffRepository->updateById($staffemail->id, $request->all());
                    return redirect()->route('member.profile')->with(['success' => 'Successfully Updated!']);
                } else {
                    return redirect()
                        ->route('member.profile')
                        ->with('success', 'Invail Email Address!');
                }
            }
        } else {
            return redirect()->route('member.index')->withErrors(['message' => 'Please Login First!']);
        }
    }
    public function LogOut(Request $request)
    {
        //dd("OK");
        $useremail  = Session::get('email');
        $staffemail = Teacher::where('email', $useremail)->first();
        $stdemail = Stduent::where('email', $useremail)->first();
        if ($staffemail != null || $stdemail != null) {
            Session::forget('email');
            return redirect()->route('member.index')->withErrors(['message' => 'Please Login First!']);
        }
    }
}
