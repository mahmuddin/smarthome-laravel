<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('schedule:execute-devices')->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }
}
