<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function show(DatabaseNotification $notification)
    {
        abort_unless(
            $notification->notifiable_id === Auth::id(),
            403
        );

        $notification->markAsRead();

        $taskId = $notification->data['task_id'] ?? null;

        if ($taskId) {
            return redirect()->route('tasks.show', $taskId);
        }

        return redirect()->route('dashboard');
    }

    public function markAllAsRead()
    {
        Auth::user()
            ->unreadNotifications
            ->markAsRead();

        return back();
    }
}
