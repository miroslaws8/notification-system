<?php

namespace App\Services\MessageService\DTO;

use App\Enum\NotificationChannelEnum;
use App\Enum\NotificationTypeEnum;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class MessageData extends Data
{
    public function __construct(
        #[Required]
        public string $identifier,
        #[Required, Enum(NotificationChannelEnum::class)]
        public NotificationChannelEnum $channel,
        #[Required, Enum(NotificationTypeEnum::class)]
        public NotificationTypeEnum $type,
        #[Required, MapInputName('body')]
        public MessageBodyData $bodyParams
    )
    {}
}