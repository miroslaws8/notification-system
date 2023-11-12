<?php

namespace App\Services\MessageService\DTO;

use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class MessageBodyData extends Data
{
    public function __construct(
        #[Required]
        public string $subject,
        #[Required]
        public string $text,
    )
    {}
}