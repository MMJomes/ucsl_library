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
    private $about;
    private $message;
    public function __construct($username = null, $message = null, $about = null)
    {
        $this->username = $username;
        $this->about = $about;
        $this->message = $message;
    }

    public function handle()
    {
        $username = $this->username;
        $about = $this->about;
        $message = $this->message;
        $id = $this->id;
        Teacher::where('id', $id)->get()->each(function ($contact) use ($username, $about,$message) {
            $contact->notify(new SendEmail($username, $about,$message));
        });
    }
}
