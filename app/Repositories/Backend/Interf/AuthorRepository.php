<?php

namespace App\Repositories\Backend\Interf;

use App\Models\Author;
use App\Repositories\BaseRepository;

class  AuthorRepository extends BaseRepository
{
    public function model()
    {
        return Author::class;
    }
}
