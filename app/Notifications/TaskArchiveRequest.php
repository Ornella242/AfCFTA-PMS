<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskArchiveRequest extends Notification
{
    use Queueable, SerializesModels;

    public $task;
    public $requester;

  

    public function build()
    {
        return $this->subject('Request to Archive Task: ' . $this->task->title)
                    ->view('emails.tasks.archive_request');
    }

    /**
     * Create a new notification instance.
     */
    public function __construct(Task $task, User $requester)
    {
         $this->task = $task;
        $this->requester = $requester;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Request to Archive Task: ' . $this->task->title)
                    ->view('emails.tasks.archive_request');
    }

 

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
