<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\SendNotificationEmailCommand::class,
        Commands\SendRegistrationReminderEmail::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $logfile = storage_path('logs/weeklyemails.log');

        //Weekly notifications email
        $schedule->command('notificationemail:send')
                 ->weekly()
                 ->sundays()
                 ->at('17:00')
                 ->sendOutputTo($logfile)
                 ->emailOutputTo('rachel@shellborn.com');


        $schedule->command('registrationreminder:send')
            ->weekly()
            ->sundays()
            ->at('17:00')
            ->sendOutputTo($logfile)
            ->emailOutputTo('rachel@shellborn.com');


//        $schedule->command('registrationreminder:send')->everyMinute()
//                 ->sendOutputTo($logfile)
//                 ->emailOutputTo('rachel@shellborn.com');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
