
# laravel-telegram-notifier

This package send bugs and messages to your telegram group or chat. 

![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/usmonaliyev/laravel-telegram-notifier/php)
![Total Downloads](https://img.shields.io/packagist/dt/usmonaliyev/laravel-telegram-notifier.svg)
![Latest Version on Packagist](https://img.shields.io/packagist/v/usmonaliyev/laravel-telegram-notifier.svg)
![Packagist License](https://img.shields.io/packagist/l/usmonaliyev/laravel-telegram-notifier)

## Screenshots

![App Screenshot](https://repository-images.githubusercontent.com/559949735/ea6f5827-c174-46df-815f-331a6d05d6ad)

## Installation

Install this project with composer

```bash
composer require usmonaliyev/laravel-telegram-notifier
```

To control it, create config file
```bash
php artisan vendor:publish --provider="Usmonaliyev\LaravelTelegramNotifier\LaravelTelegramNotifierServiceProvider"
```

Add your bot token and receiver chat id to `.env` file.

```
TELEGRAM_NOTIFIER_BOT_TOKEN=
CHAT_ID=
TELEGRAM_NOTIFIER_RESPONSIBLE=@someone
```

I recommend that you only use it on production.
To do this, change the value of `TELEGRAM_NOTIFIER_ENABLED` in .env to production.

```
TELEGRAM_NOTIFIER_ENABLED=false
```

## Custom usage

If you want to send custom message, there is `notify` function:

```php
<?php

use Usmonaliyev\LaravelTelegramNotifier\Facades\TelegramNotifier;

TelegramNotifier::notify("There is your text")
```

Also, there is `error` function to send handled error:

```php
<?php

use Usmonaliyev\LaravelTelegramNotifier\Facades\TelegramNotifier;

try {
    ...
} catch (Exception $exception) {

    TelegramNotifier::error($exception);
}
```

## Configuration

There are `laravel-telegram-notifier.php` in your `config` folder.
If you want to send bag to two or three chat ids you add chat id to `chat_ids` array of `laravel-telegram-notifier.php` file.

```
"chat_ids" => [env("CHAT_ONE_ID"), env("CHAT_TWO_ID"), env("CHAT_THREE_ID")],
```

## Running Tests

To verify that the package is fully installed and working.
You can run the command below which will help you create a new dummy error.

```bash
php artisan notify:check
```

In production mode you can load configurations from .env with `php artisan config:clear` command.

