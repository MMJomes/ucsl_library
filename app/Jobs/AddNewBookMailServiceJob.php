<?php

namespace App\Jobs;

use App\Models\Stduent\Stduent;
use App\Models\Teacher\Teacher;
use App\Notifications\SendEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddNewBookMailServiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $username;
    private $id;
    public function __construct($username = null, $id = null)
    {
        $this->username = $username;
        $this->id = $id;
    }
    public function handle()
    {
        $username = $this->username;
        Stduent::each(function ($contact) use ($username) {
            $contact->notify(new SendEmail($username,'Announcement','"DIGITAL LIBRARY MANAGENMENT SYSTEM FOR (UCSL)" of USCL Have been Added New Books!'));
        });
        Teacher::each(function ($contact) use ($username) {
            $contact->notify(new SendEmail($username,'Announcement','"DIGITAL LIBRARY MANAGENMENT SYSTEM FOR (UCSL)" of USCL Have been Added New Books!'));
        });
    }
}
