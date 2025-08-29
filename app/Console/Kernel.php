<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Définir la planification des commandes.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('tasks:archive')->daily();
        $schedule->command('tasks:send-reminders')->dailyAt('08:00');
    }

    /**
     * Enregistrer les commandes artisan de ton app.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
