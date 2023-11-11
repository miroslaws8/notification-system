<?php

namespace App\Services\MessageService;

use App\Enum\NotificationChannelEnum;
use App\Services\MessageService\Contracts\MessageHandlerInterface;
use App\Services\MessageService\Strategies\MailOutgoingMessageHandler;
use Illuminate\Contracts\Container\Container;

readonly class OutgoingMessageHandlerFactory
{
    public function __construct(private Container $container)
    {}

    public function make(NotificationChannelEnum $channelEnum): MessageHandlerInterface
    {
        return match ($channelEnum) {
            NotificationChannelEnum::MAIL => $this->container->make(MailOutgoingMessageHandler::class),
        };
    }
}