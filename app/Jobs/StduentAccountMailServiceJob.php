<?php

namespace App\Jobs;

use App\Models\Stduent\Stduent;
use App\Notifications\SendEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StduentAccountMailServiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $username;
    private $about;
    private $message;
    private $id;
    public function __construct($username = null, $about = null, $message = null,$id = null)
    {
        $this->username = $username;
        $this->about = $about;
        $this->message = $message;
        $this->id=$id;
    }

    public function handle()
    {
        $id=$this->id;
        $username = $this->username;
        $about = $this->about;
        $message = $this->message;
        Stduent::where('id', $id)->get()->each(function ($contact) use ($username, $about,$message) {
            $contact->notify(new SendEmail($username, $about,$message));
        });
    }
}
