<?php

namespace App\Repositories\Backend\Interf;

use App\Models\Stduent\PreRequest;
use App\Repositories\BaseRepository;

class  PreQuestRepository extends BaseRepository
{
    public function model()
    {
        return PreRequest::class;
    }
}
