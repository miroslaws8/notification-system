# How to test

I wrote a service to send only email but with the possibility of expanding it. You only need to add a new strategy for a new channel.

### Mail service:

https://mailtrap.io

### MessagesSubscribe

This command starts a subscription to redis messages, which in turn are sent over the channel specified in the message body.

### TestCommand

The command adds a new message to redis to test sending the notification.

### Install

1. Set up the env variable (db, redis, test email)
2. Run docker-compose
3. Run `php artisan migrate` and `php artisan db:seed`
4. Run `php artisan redis:messages-subscribe`
5. Run `php artisan app:test-command`

