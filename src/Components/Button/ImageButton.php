<?php

namespace NotificationChannels\GoogleChat\Components\Button;

class ImageButton extends AbstractButton
{
    /**
     * Set the button icon.
     */
    public function icon(string $icon): ImageButton
    {
        strpos($icon, '://') === false
            ? $this->setIconByName($icon)
            : $this->setIconByUrl($icon);

        return $this;
    }

    /**
     * Set an icon by its name.
     */
    public function setIconByName(string $icon): ImageButton
    {
        $this->payload['icon'] = $icon;
        unset($this->payload['iconUrl']);

        return $this;
    }

    /**
     * Set an icon by url.
     */
    public function setIconByUrl(string $url): ImageButton
    {
        $this->payload['iconUrl'] = $url;
        unset($this->payload['icon']);

        return $this;
    }

    /**
     * Create a new image button instance.
     *
     * @param  string|null  $icon  Either an icon name or URL to the icon image
     */
    public static function create(?string $url = null, ?string $icon = null): ImageButton
    {
        $button = new static;

        if ($url) {
            $button->url($url);
        }

        if ($icon) {
            $button->icon($icon);
        }

        return $button;
    }
}
