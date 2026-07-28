<?php

namespace NotificationChannels\GoogleChat\Components\Button;

class TextButton extends AbstractButton
{
    /**
     * Set the button text.
     */
    public function text(string $text): TextButton
    {
        $this->payload['text'] = $text;

        return $this;
    }

    /**
     * Create a new text button instance.
     */
    public static function create(?string $url = null, ?string $displayText = null): TextButton
    {
        $button = new static;

        if ($url) {
            $button->url($url);
        }

        if ($displayText) {
            $button->text($displayText);
        }

        return $button;
    }
}
