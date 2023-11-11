<?php

namespace App\Console\Commands;

use App\Services\MessageService\DTO\MessageData;
use App\Services\MessageService\OutgoingMessageHandlerFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class MessagesSubscribe extends Command
{
    protected $signature = 'redis:messages-subscribe';

    protected $description = 'Subscribe to a messages channel';

    public function handle(OutgoingMessageHandlerFactory $outgoingMessageHandlerFactory): void
    {
        Redis::subscribe(
            ['outgoing_messages'],
            function (string $message) use ($outgoingMessageHandlerFactory) {
                try {
                    $messageData = MessageData::from($message);
                    $outgoingMessageHandlerFactory->make($messageData->channel)->processMessage($messageData);
                } catch (\Throwable $exception) {
                    $this->error($exception->getMessage());
                    Log::error($exception->getMessage());
                }
            }
        );
    }
}
