<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class SendUserPassword extends Notification
{
    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
       return (new \Illuminate\Notifications\Messages\MailMessage)
        ->subject('Votre compte a été créé')
        ->view('emails.send_user_password', [
            'user' => $notifiable,
            'password' => $this->password
        ]);
    }
}


