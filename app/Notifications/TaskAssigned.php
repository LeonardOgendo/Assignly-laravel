<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TaskAssigned extends Notification
{
    use Queueable;

    public Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('📝 New Task Assigned: ' . $this->task->title)
            ->greeting('Hello ' . $notifiable->name)
            ->line('You have been assigned a new task.')
            ->line('**Title:** ' . $this->task->title)
            ->line('**Deadline:** ' . optional($this->task->deadline)->format('d M Y, H:i'))
            ->action('View Task', url('/tasks/' . $this->task->id))
            ->line('Please take the necessary action.');
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'New Task: ' . $this->task->title,
            'task_id' => $this->task->id,
            'assigned_by' => optional($this->task->assigner)->name,
        ];
    }
}
