<?php

namespace App\Services\MessageService\Contracts;

use App\Services\MessageService\DTO\MessageData;

interface MessageHandlerInterface
{
    public function processMessage(MessageData $messageData): void;
}