<?php

namespace App\Jobs;

use App\Models\Teacher\Teacher;
use App\Notifications\SendEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StaffAccountMailServiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $username;
    private $password;
    private $id;
    public function __construct($username = null, $password = null, $id = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->id = $id;
    }

    public function handle()
    {
        $username = $this->username;
        $password = $this->password;
        $id = $this->id;
        Teacher::where('id', $id)->get()->each(function ($contact) use ($username, $password) {
            $contact->notify(new SendEmail($username, $password));
        });
    }
}
