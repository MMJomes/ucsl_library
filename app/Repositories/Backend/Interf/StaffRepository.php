<?php

namespace App\Repositories\Backend\Interf;

use App\Models\Teacher\Teacher;
use App\Repositories\BaseRepository;

class  StaffRepository extends BaseRepository
{
    public function model()
    {
        return Teacher::class;
    }
}
