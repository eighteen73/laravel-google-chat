<?php

namespace NotificationChannels\GoogleChat\Components;

use Illuminate\Contracts\Support\Arrayable;

class FixedFooter implements Arrayable
{
    protected array $payload = [];

    public function primaryButton(Button $button): static
    {
        $this->payload['primaryButton'] = $button->toArray();

        return $this;
    }

    public function secondaryButton(Button $button): static
    {
        $this->payload['secondaryButton'] = $button->toArray();

        return $this;
    }

    public static function make(): static
    {
        return new static;
    }

    public function toArray(): array
    {
        return $this->payload;
    }
}
