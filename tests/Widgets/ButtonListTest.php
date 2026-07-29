<?php

namespace NotificationChannels\GoogleChat\Tests\Widgets;

use NotificationChannels\GoogleChat\Components\Button;
use NotificationChannels\GoogleChat\Tests\TestCase;
use NotificationChannels\GoogleChat\Widgets\ButtonList;

class ButtonListTest extends TestCase
{
    public function test_it_formats_button_list_widget()
    {
        $button1 = Button::text('One')->openUrl('https://example.com/1');
        $button2 = Button::text('Two')->openUrl('https://example.com/2');

        $widget = ButtonList::make([$button1, $button2]);

        $this->assertEquals([
            'buttonList' => [
                'buttons' => [
                    [
                        'text' => 'One',
                        'onClick' => [
                            'openLink' => [
                                'url' => 'https://example.com/1',
                            ],
                        ],
                    ],
                    [
                        'text' => 'Two',
                        'onClick' => [
                            'openLink' => [
                                'url' => 'https://example.com/2',
                            ],
                        ],
                    ],
                ],
            ],
        ], $widget->toArray());
    }
}
