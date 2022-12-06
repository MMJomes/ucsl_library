<?php

namespace App\Repositories\Backend\Impls;

use App\Http\Requests\BookRequest;
use App\Models\Books;
use App\Notifications\SendEmail;
use App\Repositories\Backend\Interf\BookListRepository;
use App\Repositories\Backend\Interf\ContactListRepository;
use DateTime;
use Illuminate\Support\Facades\Hash;

class BookListRepositoryImpl implements BookListRepository
{


    public function create(BookRequest $request): Books
    {

        // "titlenumber" => "688"
        // "bookdate" => "1993-11-02"
        // "author_id" => "2"
        // "bookname" => "Ursula Vargas"
        // "publishername" => "Quin Villarreal"
        // "producetime" => "Explicabo Qui praes"
        // "produceyear" => "2013"
        // "price" => "661"
        // "categories_id" => "2"
        // "availablereason" => "Dolores consequatur"
        // "renark" => "Sit eum et obcaecati"
        $yueembcontact = Books::create($request->all());
        return $yueembcontact;
    }
}
