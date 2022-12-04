<?php

namespace App\Jobs;

use App\Models\Member;
use App\Models\Setting;
use App\Notifications\SendEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class MemberExpireReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function handle()
    {
        $currentTime = microtime(true);

        $notification_setting_date = Setting::where('key', 'member_expire_notify_date')->first()->value;
        $notification_datetime = Carbon::now()->addMinute($notification_setting_date)->format('Y-m-d H:i:s');
        Member::where('status', OFF)->get()->each(function ($member)  use ($notification_datetime) {
            if ($notification_datetime == $member->dob) {
                $member->notify(new SendEmail($member->name, $member->dob));
            }
        });
    }
}
