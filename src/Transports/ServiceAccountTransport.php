<?php

namespace NotificationChannels\GoogleChat\Transports;

use Illuminate\Support\Facades\Http;
use NotificationChannels\GoogleChat\Exceptions\CouldNotSendNotification;
use NotificationChannels\GoogleChat\GoogleChatMessage;

class ServiceAccountTransport implements TransportInterface
{
    public function __construct(protected ?string $token = null) {}

    public function send(string $endpoint, GoogleChatMessage $message): mixed
    {
        $headers = [
            'Content-Type' => 'application/json; charset=UTF-8',
        ];

        $token = $this->token ?? config('google-chat.service_account.access_token');
        if ($token) {
            $headers['Authorization'] = 'Bearer '.$token;
        }

        $pendingRequest = Http::withHeaders($headers)->withOptions([
            'curl' => [CURLOPT_FORBID_REUSE => true],
        ]);

        if ($message->isUpdate()) {
            $messageName = ltrim($message->getUpdateMessageName(), '/');
            $url = 'https://chat.googleapis.com/v1/'.$messageName;
            $updateMask = implode(',', $message->getUpdateMask());
            $url .= '?updateMask='.$updateMask;

            $response = $pendingRequest->patch($url, $message->toArray());
        } else {
            $url = str_starts_with($endpoint, 'http')
                ? $endpoint
                : 'https://chat.googleapis.com/v1/'.ltrim($endpoint, '/').'/messages';

            $replyOption = $message->getReplyOption();
            if (! $replyOption && $message->isThreaded()) {
                $replyOption = 'REPLY_MESSAGE_FALLBACK_TO_NEW_THREAD';
            }

            if ($replyOption) {
                $separator = str_contains($url, '?') ? '&' : '?';
                $url .= $separator.'messageReplyOption='.$replyOption;
            }

            $response = $pendingRequest->post($url, $message->toArray());
        }

        if ($response->failed()) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }

        return $response->json();
    }
}
