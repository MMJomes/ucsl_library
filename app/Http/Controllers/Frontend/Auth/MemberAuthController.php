<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\Auth\MemberLoginRequest;
use App\Repositories\Frontend\Interf\MemberAuthRepository;
use Illuminate\Http\Request;

class MemberAuthController extends Controller
{

    private MemberAuthRepository $repository;

    public function __construct(MemberAuthRepository $repository)
    {
        $this->repository = $repository;
    }

    public function login()
    {

        $already_registered = auth()->guard('members')->user();
        //dd($already_registered);
        if ($already_registered) {
            return redirect()->route('/');
        }
        return view('frontend.auth.login');
    }

    public function loginAction(MemberLoginRequest $loginrequest)
    {

        $res = $this->repository->login($loginrequest);
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
    public function passwordReset(){
        return view('frontend.auth.email');
    }
}
