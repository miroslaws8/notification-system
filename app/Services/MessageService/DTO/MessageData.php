<?php

namespace App\Services\MessageService\DTO;

use App\Enum\NotificationChannelEnum;
use App\Enum\NotificationTypeEnum;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class MessageData extends Data
{
    public function __construct(
        public string $identifier,
        public NotificationChannelEnum $channel,
        public NotificationTypeEnum $type,
        #[MapInputName('body')]
        public MessageBodyData $bodyParams
    )
    {}
}