<?php

namespace App\Notifications;

use App\Services\MessageService\DTO\MessageBodyData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReminderNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly MessageBodyData $bodyParams)
    {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->bodyParams->subject)
            ->greeting('It is reminder!')
            ->line($this->bodyParams->text);
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
