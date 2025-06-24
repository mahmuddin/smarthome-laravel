<?php
namespace App\Console\Commands;

use App\Models\Tenant\Schedule as TenantSchedule;
use Illuminate\Console\Command;

class ExecuteDeviceSchedule extends Command
{
    protected $signature   = 'schedule:execute-devices';
    protected $description = 'Execute scheduled device actions (turn on/off)';

    public function handle()
    {
        $dueSchedules = TenantSchedule::dueNow()->with('device')->get();

        foreach ($dueSchedules as $schedule) {
            $schedule->execute();
            $this->info("Executed schedule for device: {$schedule->device->name}");
        }

        return Command::SUCCESS;
    }
}
