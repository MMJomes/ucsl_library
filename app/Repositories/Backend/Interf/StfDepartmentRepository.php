<?php

namespace App\Repositories\Backend\Interf;

use App\Models\Teacher\Departement;
use App\Repositories\BaseRepository;

class  StfDepartmentRepository extends BaseRepository
{
    public function model()
    {
        return Departement::class;
    }
}
