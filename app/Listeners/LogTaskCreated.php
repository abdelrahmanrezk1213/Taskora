<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use Illuminate\Support\Facades\Log;

class LogTaskCreated
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskCreated $event): void
    {
        Log::info('A new task was created.', [
            'task_id' => $event->task->id,
            'user_id' => $event->task->user_id,
            'title' => $event->task->title,
        ]);

    }
}
