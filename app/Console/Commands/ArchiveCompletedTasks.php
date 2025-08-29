<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;

class ArchiveCompletedTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:archive';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archive tasks completed more than 5 days ago';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         $tasks = Task::where('status', 'completed')
            ->where('archived', false)
            ->where('completed_at', '<=', now()->subDays(5))
            ->get();

        foreach ($tasks as $task) {
            $task->update(['archived' => true]);
        }

        $this->info($tasks->count().' tasks archived successfully.');
    
    }
}
