<?php

namespace NotificationChannels\GoogleChat\Widgets;

use NotificationChannels\GoogleChat\Components\Button\AbstractButton;

class KeyValue extends AbstractWidget
{
    /**
     * Set the top label text.
     */
    public function topLabel(string $message): KeyValue
    {
        $this->payload['topLabel'] = $message;

        return $this;
    }

    /**
     * Set the content text.
     */
    public function content(string $message): KeyValue
    {
        $this->payload['content'] = $message;

        return $this;
    }

    /**
     * Set the bottom label text.
     */
    public function bottomLabel(string $message): KeyValue
    {
        $this->payload['bottomLabel'] = $message;

        return $this;
    }

    /**
     * Set the content multiline property.
     */
    public function setContentMultiline(bool $value): KeyValue
    {
        $this->payload['contentMultiline'] = $value;

        return $this;
    }

    /**
     * Make the widget clickable through to the provided link.
     */
    public function onClick(string $url): KeyValue
    {
        $this->payload['onClick'] = [
            'openLink' => [
                'url' => $url,
            ],
        ];

        return $this;
    }

    /**
     * Set the icon of this widget.
     */
    public function icon(string $icon): KeyValue
    {
        $this->payload['icon'] = $icon;

        return $this;
    }

    /**
     * Set the button of the widget.
     */
    public function button(AbstractButton $button): KeyValue
    {
        $this->payload['button'] = $button;

        return $this;
    }

    /**
     * Return a new Key Value widget instance.
     */
    public static function create(?string $topLabel = null, ?string $content = null, ?string $bottomLabel = null): KeyValue
    {
        $widget = new static;

        if ($topLabel) {
            $widget->topLabel($topLabel);
        }

        if ($content) {
            $widget->content($content);
        }

        if ($bottomLabel) {
            $widget->bottomLabel($bottomLabel);
        }

        return $widget;
    }
}
