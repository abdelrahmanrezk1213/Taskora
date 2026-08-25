<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Task $task
    ) {}

    public function via(object $notifiable): array
    {
        return [
            'database',
            'mail',
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'New Task Created',
            'message' => "The task \"{$this->task->title}\" was created successfully.",
            'task_id' => $this->task->id,
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Task Created')
            ->greeting("Hello {$notifiable->name},")
            ->line("A new task has been created: {$this->task->title}")
            ->line("Priority: {$this->task->priority}")
            ->line("Status: {$this->task->status}")
            ->action(
                'View Task',
                route('tasks.show', $this->task)
            )
            ->line('Thank you for using the Task Management System.');
    }
}
