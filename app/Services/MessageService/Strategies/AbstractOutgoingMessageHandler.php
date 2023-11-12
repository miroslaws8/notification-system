<?php

namespace App\Services\MessageService\Strategies;

use App\Jobs\SendMessage;
use App\Models\User;
use App\Services\MessageService\DTO\MessageData;
use Illuminate\Support\Facades\Log;

abstract class AbstractOutgoingMessageHandler
{
    abstract protected function getNotifiable(MessageData $messageData): User;
    abstract protected function getQueueName(): string;

    public function processMessage(MessageData $messageData): void
    {
        SendMessage::dispatch($this->getNotifiable($messageData), $messageData)->onQueue($this->getQueueName());
        Log::info("Message sent - Channel: {$messageData->channel->value}, Type: {$messageData->type->value}");
    }
}