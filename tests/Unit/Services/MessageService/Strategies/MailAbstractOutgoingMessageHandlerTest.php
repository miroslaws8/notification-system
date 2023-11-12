<?php

namespace Tests\Unit\Services\MessageService\Strategies;

use App\Enum\NotificationChannelEnum;
use App\Enum\NotificationTypeEnum;
use App\Models\User;
use App\Notifications\ReminderNotification;
use App\Services\MessageService\DTO\MessageData;
use App\Services\MessageService\Strategies\MailAbstractOutgoingMessageHandler;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class MailAbstractOutgoingMessageHandlerTest extends TestCase
{
    use WithFaker;

    private MailAbstractOutgoingMessageHandler $messageHandler;

    protected function setUp(): void
    {
        parent::setUp();

        Notification::fake();
        $this->messageHandler = $this->app->make(MailAbstractOutgoingMessageHandler::class);
    }

    public function testProcessMessage(): void
    {
        $user = User::factory()->create();

        $messageDto = MessageData::from([
            'identifier' => $user->email,
            'channel' => NotificationChannelEnum::MAIL,
            'type' => NotificationTypeEnum::REMINDER,
            'body' => [
                'subject' => $this->faker->word,
                'text' => $this->faker->text
            ]
        ]);

        $this->messageHandler->processMessage($messageDto);

        Notification::assertSentTo($user, ReminderNotification::class);
    }
}