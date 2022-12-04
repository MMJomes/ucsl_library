<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SendEmail extends Notification
{
    use Queueable;
    private $username;
    private $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($username, $userpassword)
    {
        $this->username = $username;
        $this->userpassword = $userpassword;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $time = Carbon::now();
        $datetime = $time->toDateTimeString();
        $DT = explode(' ', $datetime);
        return (new MailMessage)
        ->subject(config('mail.subject'))
        ->view('mail.mail', array(
            'username' => $this->username,
            'userpassword' => $this->userpassword,
            'date' => $DT[0],
            'time' => $DT[1],
        ));
    }
}
