<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\UpdateLabAccessStatus; // Import your custom command

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        UpdateLabAccessStatus::class, // Register your custom command here
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Schedule the custom Artisan command to run daily at midnight
        $schedule->command('app:update-lab-access-status')->daily();
    }

    /**
     * Register the commands for your application.
     *
     * @return void
     */
    protected function commands()
    {
        // Load the console commands from the `Commands` directory
        $this->load(__DIR__.'/Commands');

        // Include routes for console commands
        require base_path('routes/console.php');
    }
}
