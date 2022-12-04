<?php

namespace App\Repositories\Frontend\Interf;

use App\Http\Requests\Member\Auth\MemberLoginRequest;

interface  MemberAuthRepository
{
    public function login(MemberLoginRequest $loginRequest);
}
