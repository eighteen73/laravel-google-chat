<?php

namespace NotificationChannels\GoogleChat\Widgets;

use Closure;

class Columns extends AbstractWidget
{
    protected array $columnItems = [];

    public static function create(): static
    {
        return new static;
    }

    public static function make(): static
    {
        return new static;
    }

    public function column(array|Closure $widgets): static
    {
        if ($widgets instanceof Closure) {
            $columnBuilder = new class
            {
                public array $widgets = [];

                public function add(AbstractWidget $widget): static
                {
                    $this->widgets[] = $widget->toArray();

                    return $this;
                }
            };
            $widgets($columnBuilder);
            $widgetsList = $columnBuilder->widgets;
        } else {
            $widgetsList = array_map(function ($widget) {
                return $widget instanceof AbstractWidget ? $widget->toArray() : $widget;
            }, $widgets);
        }

        $this->columnItems[] = [
            'widgets' => $widgetsList,
        ];

        return $this;
    }

    public function toArray(): array
    {
        return [
            'columns' => [
                'columnItems' => $this->columnItems,
            ],
        ];
    }
}
