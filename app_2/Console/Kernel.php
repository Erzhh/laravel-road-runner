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
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('import:products_bonus')->dailyAt('01:00');
        $schedule->command('import:categories')->dailyAt('23:00');
        $schedule->command('import:products')->dailyAt('23:10');
        $schedule->command('import:products_detail')->dailyAt('23:20');
        $schedule->command('import:price_types')->dailyAt('23:40');
        $schedule->command('import:price_products')->dailyAt('23:30');
    }
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        $this->load(__DIR__.'/../Domain/Import/Commands');

        require base_path('routes/console.php');
    }
}
