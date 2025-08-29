<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Mail\TaskReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendTaskReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders for tasks nearing their end date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $targetDate = Carbon::now()->addDays(2)->toDateString();

        $tasks = Task::whereDate('end_date', $targetDate)
            ->where('status', '!=', 'completed')
            ->with('assignedUser') // relation user
            ->get();

        foreach ($tasks as $task) {
            if ($task->assignedUser && $task->assignedUser->email) {
                Mail::to($task->assignedUser->email)->send(new TaskReminderMail($task));
            }
        }

        $this->info("Reminders sent for " . $tasks->count() . " tasks.");
    }
}
