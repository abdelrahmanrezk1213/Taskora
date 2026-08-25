<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    private function clearDashboardCache(Task $task): void
    {
        Cache::forget('dashboard_stats_user_'.$task->user_id);
    }

    public function created(Task $task): void
    {
        $this->clearDashboardCache($task);
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        $this->clearDashboardCache($task);
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        $this->clearDashboardCache($task);
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        $this->clearDashboardCache($task);
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        $this->clearDashboardCache($task);

        if ($task->image) {
            Storage::disk('public')->delete($task->image);
        }
    }
}
