<?php

namespace NotificationChannels\GoogleChat\Components;

use Illuminate\Contracts\Support\Arrayable;
use NotificationChannels\GoogleChat\Enums\Icon;

class Button implements Arrayable
{
    protected array $payload = [];

    public function __construct(?string $text = null)
    {
        if ($text !== null) {
            $this->textContent($text);
        }
    }

    public static function create(?string $text = null): static
    {
        return new static($text);
    }

    public static function make(?string $text = null): static
    {
        return new static($text);
    }

    public static function text(string $text): static
    {
        return new static($text);
    }

    public function textContent(string $text): static
    {
        $this->payload['text'] = $text;

        return $this;
    }

    public function icon(Icon|string $icon): static
    {
        if ($icon instanceof Icon) {
            $this->payload['icon'] = ['knownIcon' => $icon->value];
        } elseif (is_string($icon) && (str_starts_with($icon, 'http://') || str_starts_with($icon, 'https://'))) {
            $this->payload['icon'] = ['iconUrl' => $icon];
        } else {
            $this->payload['icon'] = ['knownIcon' => (string) $icon];
        }

        return $this;
    }

    public function openUrl(string $url): static
    {
        $this->payload['onClick'] = [
            'openLink' => [
                'url' => $url,
            ],
        ];

        return $this;
    }

    public function onClickAction(string $function, array $parameters = []): static
    {
        $params = [];
        foreach ($parameters as $key => $value) {
            $params[] = [
                'key' => (string) $key,
                'value' => (string) $value,
            ];
        }

        $this->payload['onClick'] = [
            'action' => [
                'function' => $function,
                'parameters' => $params,
            ],
        ];

        return $this;
    }

    public function disabled(bool $disabled = true): static
    {
        $this->payload['disabled'] = $disabled;

        return $this;
    }

    public function altText(string $altText): static
    {
        $this->payload['altText'] = $altText;

        return $this;
    }

    public function toArray(): array
    {
        return $this->payload;
    }
}
