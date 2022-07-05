<?php

namespace App\Console;

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
    protected $commands = [
        'App\Console\Commands\DatabaseBackUp',
        'App\Console\Commands\LUP\AutoSignAction',
    ];

    protected function schedule(Schedule $schedule)    {
        $schedule->command('backup:clean')->daily()->at('23:00')->runInBackground();
        $schedule->command('backup:run')->hourly()->between('7:00', '18:00')->weekdays();  
        $schedule->command('lup:sign')->daily()->at('03:00')->weekdays();       
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
