<?php

namespace App\Repositories\Frontend\Impls;

use App\Http\Requests\Member\Auth\MemberLoginRequest;
use App\Models\Member;
use App\Repositories\Frontend\Interf\MemberAuthRepository;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\Hash;

class MemberAuthRepositoryImpl implements MemberAuthRepository
{
    public function login(MemberLoginRequest  $loginRequest)
    {

            dd($loginRequest->all());
        if(auth()->guard('members')->attempt(['email' => $loginRequest->email,'password' => 'password'],$loginRequest->filled('remember')))
        {
            dd("Authentication successful");
            return SUCCESS;
        }else{
            dd("Failed to login");
            $member = Member::where('password',$loginRequest->password)->where('email', $loginRequest->email)->first();
            dd($member);
            dd("Failed");
            return FAILED;
        }

        dd($loginRequest->password);

        $member = Member::where('password',$loginRequest->password)->where('username', $loginRequest->name)->first();
        if($member){

            return SUCCESS;
        }else{
            return FAILED;
        }
        // $hashPassword= Hash::make($loginRequest->password);
        // $hashPasswords= Hash::make('Password');
        // $hashCheck= Hash::check($hashPassword, $hashPassword);

        // $member = Member::where('username', $loginRequest->name)->where('password',$hashPassword)->first();
        // dd($member);
    }
}
