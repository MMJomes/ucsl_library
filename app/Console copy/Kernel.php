<?php

namespace App\Console;

use App\Jobs\AdditionalTimeWinnerJob;
use App\Jobs\AuctionAutoStartEnd;
use App\Jobs\AuctionStatusmailToAdmin;
use App\Jobs\InvoiceExpireTimeJob;
use App\Jobs\SendAutoInvoiceJob;
use App\Models\Setting;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $auction_status_mail = Setting::where('key','auction_status_mail')->first();
        $schedule->job(new AuctionStatusmailToAdmin($auction_status_mail))->everyMinute();
        $schedule->job(new AuctionAutoStartEnd)->everyMinute();
        $schedule->job(new AdditionalTimeWinnerJob())->everyMinute();
        $schedule->job(new SendAutoInvoiceJob())->everyMinute();
        $schedule->job(new InvoiceExpireTimeJob())->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
