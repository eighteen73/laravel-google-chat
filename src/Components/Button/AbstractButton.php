<?php

namespace NotificationChannels\GoogleChat\Components\Button;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

abstract class AbstractButton implements Arrayable
{
    /**
     * The button payload.
     *
     * @var array
     */
    protected $payload = [];

    /**
     * Set the onClick url.
     */
    public function url(string $url): self
    {
        $this->payload['onClick'] = [
            'openLink' => [
                'url' => $url,
            ],
        ];

        return $this;
    }

    /**
     * Return the array representation of this button.
     */
    public function toArray(): array
    {
        $class = Str::camel(class_basename(static::class));

        return [
            $class => $this->payload,
        ];
    }
}
