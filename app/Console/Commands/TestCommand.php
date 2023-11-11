<?php

namespace App\Console\Commands;

use App\Enum\NotificationChannelEnum;
use App\Enum\NotificationTypeEnum;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class TestCommand extends Command
{
    protected $signature = 'app:test-command';

    protected $description = 'Command for test';

    public function handle(): void
    {
        Redis::publish('outgoing_messages', json_encode([
            'identifier' => env('TEST_EMAIL', 'test@gmail.com'),
            'channel' => NotificationChannelEnum::MAIL,
            'type' => NotificationTypeEnum::BIRTHDAY,
            'body' => [
                'subject' => 'Happy Birthday',
                'text' => 'this text about HB'
            ]
        ]));
    }
}
