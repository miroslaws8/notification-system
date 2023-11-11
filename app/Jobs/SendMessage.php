<?php

namespace App\Jobs;

use App\Enum\NotificationTypeEnum;
use App\Models\User;
use App\Notifications\BirthdayNotification;
use App\Notifications\ReminderNotification;
use App\Services\MessageService\DTO\MessageData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly User $user, private readonly MessageData $messageData)
    {}

    public int $tries = 3;

    public function handle(): void
    {
        $notification = match ($this->messageData->type) {
            NotificationTypeEnum::BIRTHDAY => new BirthdayNotification($this->messageData->bodyParams),
            NotificationTypeEnum::REMINDER => new ReminderNotification($this->messageData->bodyParams),
        };

        $this->user->notify($notification);

        Log::info("Message sent - User ID: {$this->user->getKey()}, Channel: {$this->messageData->channel->value}, Type: {$this->messageData->type->value}");
    }

    public function failed(\Throwable $exception): void
    {
        Log::error($exception->getMessage());
    }
}
