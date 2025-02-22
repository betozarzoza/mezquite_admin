<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        //$schedule->call('App\Http\Controllers\HousesController@addMontlyPaymentToHouses')->monthly();
        //$schedule->call('App\Http\Controllers\HousesController@inactive_houses')->monthlyOn(15, '00:00');
        $schedule->call('App\Http\Controllers\NotificationController@minus_one_day_to_notif_and_inactivate_them')->daily();
        $schedule->call('App\Http\Controllers\ScheduleController@delete_old_schedules')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

     protected $commands = [
        \spresnac\createcliuser\CreateCliUserCommand::class,
    ];
}
