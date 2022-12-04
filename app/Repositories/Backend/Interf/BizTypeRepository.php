<?php

namespace App\Repositories\Backend\Interf;

use App\Models\BizType;
use App\Repositories\BaseRepository;

class  BizTypeRepository extends BaseRepository
{
    public function model()
    {
        return BizType::class;
    }
}
