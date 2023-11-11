<?php

namespace App\Services\MessageService\DTO;

use Spatie\LaravelData\Data;

class MessageBodyData extends Data
{
    public function __construct(
        public string $subject,
        public string $text,
    )
    {}
}