<?php

namespace App\Repositories\Backend\Interf;

use App\Http\Requests\BookRequest;
use App\Models\Books;

interface  BookListRepository
{
    public function create(BookRequest $request): Books;
}
