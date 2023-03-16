<?php

namespace App\Repositories\Backend\Interf;

use App\Models\Stduent\StdClass;
use App\Repositories\BaseRepository;

class  StdClassessRepository extends BaseRepository
{
    public function model()
    {
        return StdClass::class;
    }
}
