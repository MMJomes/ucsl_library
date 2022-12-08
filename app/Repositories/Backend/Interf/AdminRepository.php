<?php

namespace App\Repositories\Backend\Interf;

use App\Models\Admin;
use App\Repositories\BaseRepository;


class  AdminRepository extends BaseRepository
{
    public function model()
    {
        return Admin::class;
    }
}
