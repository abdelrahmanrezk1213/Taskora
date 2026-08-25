<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\Notifications\TaskCreatedNotification;

class SendTaskCreatedNotification
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
        $event->task->user->notify(
            new TaskCreatedNotification($event->task)
        );
    }
}
