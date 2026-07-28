<?php

namespace NotificationChannels\GoogleChat;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use NotificationChannels\GoogleChat\Concerns\ValidatesCardComponents;
use NotificationChannels\GoogleChat\Widgets\AbstractWidget;

class Section implements Arrayable
{
    use ValidatesCardComponents;

    /**
     * The section payload.
     *
     * @var array
     */
    protected $payload = [
        'widgets' => [],
    ];

    /**
     * Set the section header text.
     */
    public function header(string $text): Section
    {
        $this->payload['header'] = $text;

        return $this;
    }

    /**
     * Add one or more widgets to this section.
     *
     * @param  AbstractWidget|AbstractWidget[]  $widget
     */
    public function widget($widget): Section
    {
        $widgets = Arr::wrap($widget);

        $this->guardOnlyInstancesOf(AbstractWidget::class, $widgets);

        $this->payload['widgets'] = array_merge($this->payload['widgets'], $widgets);

        return $this;
    }

    /**
     * Serialize the section to an array representation.
     */
    public function toArray(): array
    {
        return $this->payload;
    }

    /**
     * Return a new Google Chat Section instance.
     *
     * @param  AbstractWidget|AbstractWidget[]  $widgets
     */
    public static function create($widgets = null): Section
    {
        $section = new static;

        if ($widgets) {
            $section->widget($widgets);
        }

        return $section;
    }
}
