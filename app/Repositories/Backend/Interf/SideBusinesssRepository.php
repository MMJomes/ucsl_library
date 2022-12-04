<?php

namespace App\Repositories\Backend\Interf;
use App\Models\SideBusiness;
use App\Repositories\BaseRepository;

class  SideBusinesssRepository extends BaseRepository
{
    public function model()
    {
        return SideBusiness::class;
    }
}
