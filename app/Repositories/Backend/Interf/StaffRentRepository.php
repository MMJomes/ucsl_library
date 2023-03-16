<?php

namespace App\Repositories\Backend\Interf;

use App\Models\Teacher\Teacherrent;
use App\Repositories\BaseRepository;

class  StaffRentRepository extends BaseRepository
{
    public function model()
    {
        return Teacherrent::class;
    }
}
