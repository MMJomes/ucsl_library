<?php

namespace App\Repositories\Backend\Interf;

use App\Models\Stduent\Stduent;
use App\Repositories\BaseRepository;

class  StudentRepository extends BaseRepository
{
    public function model()
    {
        return Stduent::class;
    }
}
