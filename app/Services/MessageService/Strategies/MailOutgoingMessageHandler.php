<?php

namespace App\Services\MessageService\Strategies;

use App\Models\User;
use App\Services\MessageService\Contracts\MessageHandlerInterface;
use App\Services\MessageService\DTO\MessageData;

class MailOutgoingMessageHandler extends OutgoingMessageHandler implements MessageHandlerInterface
{
    protected function getNotifiable(MessageData $messageData): User
    {
        /** @var User $user */
        $user = User::query()->where('email', $messageData->identifier)->firstOrFail();
        return $user;
    }

    protected function getQueueName(): string
    {
        return 'mail-queue';
    }
}