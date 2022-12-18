<?php

namespace App\Repositories\Backend\Impls;

use App\Http\Requests\BookRequest;
use App\Models\Books;
use App\Models\Setting;
use App\Models\Stduent\Stduent;
use App\Models\Teacher\Teacher;
use App\Notifications\SendEmail;
use App\Repositories\Backend\Interf\BookListRepository;
use App\Repositories\Backend\Interf\ContactListRepository;
use DateTime;
use Illuminate\Support\Facades\Hash;

class BookListRepositoryImpl implements BookListRepository
{


    public function create(BookRequest $request): Books
    {

        $sned_email_to_new_book =  Setting::where('key', 'sned_email_to_new_book')->first();
        $yueembcontact = Books::create($request->all());
        if ($sned_email_to_new_book->value == ON) {
            Stduent::where('status', ON)->get()->each(function ($stdeunt) {
                if ($stdeunt->email != null) {
                    $stdeunt->notify(new SendEmail($stdeunt->name,'Announcement','"DIGITAL LIBRARY MANAGENMENT SYSTEM FOR (UCSL)" of USCL Have been Added New Books!'));
                }
            });
            Teacher::where('status', ON)->get()->each(function ($stf) {
                if ($stf->email != null) {
                    $stf->notify(new SendEmail($stf->name ,'Announcement','"DIGITAL LIBRARY MANAGENMENT SYSTEM FOR (UCSL)" of USCL Have been Added New Books!'));
                }
            });
        }
        return $yueembcontact;
    }
}
