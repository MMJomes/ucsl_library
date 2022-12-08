<?php

namespace App\Console;

use App\Jobs\ExpiredToRetrunMailServiceJob;
use App\Jobs\MemberExpireReminderJob;
use App\Jobs\RentTimeExpireMailServiceJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new MemberExpireReminderJob)->everyMinute();
        $schedule->job(new RentTimeExpireMailServiceJob)->everyMinute();
        $schedule->job(new ExpiredToRetrunMailServiceJob)->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
