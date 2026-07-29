<?php

namespace NotificationChannels\GoogleChat;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Notifications\Notification;
use NotificationChannels\GoogleChat\Exceptions\CouldNotSendNotification;

class GoogleChatChannel
{
    /**
     * Initialise a new Google Chat Channel instance.
     */
    public function __construct(protected Client $client) {}

    /**
     * Send the given notification.
     *
     *
     * @throws CouldNotSendNotification
     */
    public function send(mixed $notifiable, Notification $notification): ?self
    {
        if (! method_exists($notification, 'toGoogleChat')) {
            throw CouldNotSendNotification::undefinedMethod($notification);
        }

        $message = $notification->toGoogleChat($notifiable);

        if (! $message instanceof GoogleChatMessage) {
            throw CouldNotSendNotification::invalidMessage($message);
        }

        $space = config('google-chat.test_space')
            ?? $message->getSpace()
            ?? $notifiable->routeNotificationFor('googleChat')
            ?? config('google-chat.space');

        if (! $endpoint = config("google-chat.spaces.$space", $space)) {
            throw CouldNotSendNotification::webhookUnavailable();
        }

        if ($message->isThreaded()) {
            $endpoint .= (str_contains($endpoint, '?') ? '&' : '?').'messageReplyOption=REPLY_MESSAGE_FALLBACK_TO_NEW_THREAD';
        }

        try {
            $this->client->request(
                'post',
                $endpoint,
                [
                    'json' => $message->toArray(),
                ]
            );
        } catch (ClientException $exception) {
            throw CouldNotSendNotification::clientError($exception);
        } catch (Exception $exception) {
            throw CouldNotSendNotification::unexpectedException($exception);
        }

        return $this;
    }
}
