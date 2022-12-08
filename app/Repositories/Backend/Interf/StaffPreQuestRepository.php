<?php

namespace App\Repositories\Backend\Interf;

use App\Models\Teacher\StaffPreRequest;
use App\Repositories\BaseRepository;

class  StaffPreQuestRepository extends BaseRepository
{
    public function model()
    {
        return StaffPreRequest::class;
    }
}
