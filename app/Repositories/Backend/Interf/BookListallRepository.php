<?php

namespace App\Repositories\Backend\Interf;

use App\Models\Books;
use App\Repositories\BaseRepository;

class  BookListAllRepository extends BaseRepository
{
    public function model()
    {
        return Books::class;
    }
}
