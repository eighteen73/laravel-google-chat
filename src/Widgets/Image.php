<?php

namespace NotificationChannels\GoogleChat\Widgets;

class Image extends AbstractWidget
{
    /**
     * Set the image url.
     */
    public function imageUrl(string $url): Image
    {
        $this->payload['imageUrl'] = $url;

        return $this;
    }

    /**
     * Make the widget clickable through to the provided link.
     */
    public function onClick(string $url): Image
    {
        $this->payload['onClick'] = [
            'openLink' => [
                'url' => $url,
            ],
        ];

        return $this;
    }

    /**
     * Return a new Image widget instance.
     */
    public static function create(?string $imageUrl = null, ?string $onClickUrl = null): Image
    {
        $widget = new static;

        if ($imageUrl) {
            $widget->imageUrl($imageUrl);
        }

        if ($onClickUrl) {
            $widget->onClick($onClickUrl);
        }

        return $widget;
    }
}
