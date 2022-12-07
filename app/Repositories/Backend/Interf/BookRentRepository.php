<?php

namespace App\Repositories\Backend\Interf;

use App\Models\Author;
use App\Models\Stduent\Bookrent;
use App\Repositories\BaseRepository;

class  BookRentRepository extends BaseRepository
{
    public function model()
    {
        return Bookrent::class;
    }
}
