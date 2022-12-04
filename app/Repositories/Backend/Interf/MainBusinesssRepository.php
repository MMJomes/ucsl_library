<?php

namespace App\Repositories\Backend\Interf;
use App\Models\MainBusiness;
use App\Repositories\BaseRepository;

class  MainBusinesssRepository extends BaseRepository
{
    public function model()
    {
        return MainBusiness::class;
    }
}
