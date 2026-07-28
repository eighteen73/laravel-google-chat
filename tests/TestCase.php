<?php

namespace NotificationChannels\GoogleChat\Tests;

use NotificationChannels\GoogleChat\GoogleChatServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    public function getPackageProviders($app)
    {
        return [
            GoogleChatServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('google-chat.test_space', null);
    }
}
