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
        'App\Console\Commands\ICCS\DeleteLoginToken',
    ];

    protected function schedule(Schedule $schedule)    {
        $schedule->command('backup:clean')->daily()->at('23:00')->runInBackground();
        $schedule->command('backup:run')->hourly()->between('7:00', '18:00')->weekdays();  
        $schedule->command('lup:sign')->daily()->at('06:00')->weekdays();   
        $schedule->command('login-token:delete')->daily()->at('00:00')->runInBackground();
        $schedule->command('clear:lastseen')->everyTenMinutes()->runInBackground();   
        $schedule->command('log:clear')->lastDayOfMonth('02:00');     
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
