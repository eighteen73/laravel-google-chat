<?php

namespace NotificationChannels\GoogleChat;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\ServiceProvider;

class GoogleChatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->app->when(GoogleChatChannel::class)
            ->needs(GuzzleClient::class)
            ->give(function () {
                return new GuzzleClient;
            });

        $this->publishes([
            realpath(__DIR__.'/../config/google-chat.php') => config_path('google-chat.php'),
        ], 'google-chat-config');
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(realpath(__DIR__.'/../config/google-chat.php'), 'google-chat');
    }
}
