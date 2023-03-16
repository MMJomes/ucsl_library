<?php

namespace App\Repositories\Backend\Interf;

use App\DataTables\MemberDataTable;
use App\Http\Requests\BookRequest;
use App\Http\Requests\MemberRequest;
use App\Models\Member;

interface  ContactListRepository
{
public function create(MemberRequest $request): Member;
}
