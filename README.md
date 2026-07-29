# Google Chat Notification Channel for Laravel

This package makes it easy to send Google Chat notifications (simple text, formatted messages, and rich cards) using webhooks or REST API service accounts in Laravel 12.x and 13.x.

Maintained by [eighteen73](https://eighteen73.co.uk).

## Documentation

Full developer documentation, configuration guides, card layout examples, and API references are available on our documentation site:

📖 **[Read the Documentation](https://docs.eighteen73.co.uk/laravel/google-chat)**

## Requirements

- PHP `^8.2`
- Laravel `^12.0` or `^13.0`

## Installation

Require the package via Composer:

```bash
composer require eighteen73/laravel-google-chat
```

Publish the configuration file:

```bash
php artisan vendor:publish --tag=google-chat-config
```

## Quick Example

```php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use NotificationChannels\GoogleChat\GoogleChatChannel;
use NotificationChannels\GoogleChat\GoogleChatMessage;

class InvoicePaidNotification extends Notification
{
    public function via(object $notifiable): array
    {
        return [
            GoogleChatChannel::class,
        ];
    }

    public function toGoogleChat(object $notifiable): GoogleChatMessage
    {
        return GoogleChatMessage::create()
            ->bold('Invoice Paid!')
            ->line('Payment was received successfully.')
            ->to('sales');
    }
}
```

For advanced features like card messages, custom space aliases, threading, and local test overrides, please refer to the [full documentation](https://docs.eighteen73.co.uk/laravel/google-chat).

## Development & Testing

```bash
# Run PHPUnit tests
composer test

# Run static analysis
composer analyse

# Check code formatting
composer lint

# Automatically format code
composer format
```

The test suite contains 50 unit tests covering all Cards v2 components, payload serialization, and HTTP transports:

```bash
composer test
```

## Security

If you discover any security related issues, please email us or use the issue tracker.

## Credits

- Originally created by [Frank Dixon](https://github.com/frankieeedeee) and the [Laravel Notification Channels](https://github.com/laravel-notification-channels/google-chat) community.
- Maintained by [eighteen73](https://eighteen73.co.uk).
- [All Contributors](https://github.com/eighteen73/laravel-google-chat/graphs/contributors)

## License

The MIT License (MIT). Please see [LICENSE.md](LICENSE.md) for more information.

