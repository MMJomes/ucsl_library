<?php

namespace App\Jobs;

use App\Models\Setting;
use App\Models\Stduent\Bookrent;
use App\Models\Teacher\Teacher;
use App\Notifications\SendEmail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RentTimeExpireMailServiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $currentTime = microtime(true);
        $notification_setting_date = Setting::where('key', 'sned_email_to_user_overred_time')->first()->value;
        $notification_datetime = Carbon::now()->addHour($notification_setting_date)->format('Y-m-d H:i:s');
        Bookrent::where('status', OFF)->get()->each(function ($teacher)  use ($notification_datetime) {
            if ($notification_datetime == $teacher->dob) {
                $teacher->notify(new SendEmail($teacher->name, $teacher->dob));
            }
        });
    }
}
