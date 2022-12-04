<?php

namespace App\Repositories\Backend\Interf;

use App\Models\Member;
use App\Repositories\BaseRepository;

class  MemberRepository extends BaseRepository
{
    public function model()
    {
        return Member::class;
    }
}
