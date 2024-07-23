
# laravel-telegram-notifier

This package send bugs and messages to your telegram group or chat. 

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
TELEGRAM_NOTIFIER_ERROR_LOG=false
TELEGRAM_NOTIFIER_RESPONSIBLE=@someone
```

I recommend that you only use it on production.
To do this, change the value of `APP_ENV` in .env to production.

```
APP_ENV=production
```

If you are running a local server on `localhost:8000` with `php artisan serve`
 and you need to stop the local server (control + c in Terminal) and run `php artisan serve`
 to start it again - then your changes get picked up.
## Configuration

There are `laravel-telegram-notifier.php` in your `config` folder.
If you want to send bag to two or three chat ids you add chat id to `chat_ids` array of `laravel-telegram-notifier.php` file.

```
"chat_ids" => [env("CHAT_ONE_ID"), env("CHAT_TWO_ID"), env("CHAT_THREE_ID")],
```

Header of message, it defaults value is `APP_NAME` of `.env` file.
I recommend text end with \n
```
"message_title" => env("APP_NAME", "laravel-telegram-notifier") . "\n",
```

```
"message" => [
    MessageSection::REQUEST => [

        /**
        * Get all of the input and files for the request.
        */
        "body" => RequestMessageBuilder::ALL,

        /**
        * Returns the path being requested relative to the executed script.
        */
        "path_info" => RequestMessageBuilder::PATH_INFO,

        /**
        * Get the client user agent.
        */
        "user_agent" => RequestMessageBuilder::USER_AGENT,

        /**
        * Get the client IP address.
        */
        "ip" => RequestMessageBuilder::IP,
    ],
    MessageSection::ERROR => [

        /**
        * Returns the Exception message as a string.
        */
        "message" => ErrorMessageBuilder::GET_MESSAGE,

        /**
        * Gets the Exception code
        */
        "code" => ErrorMessageBuilder::GET_CODE,

        /**
        * Gets the file in which the exception was created
        */
        "file" => ErrorMessageBuilder::GET_FILE,

        /**
        * Gets the Exception code
        */
        "code" => ErrorMessageBuilder::GET_CODE,
        
        /**
        * Gets the line in which the exception was created
        */
        "line" => ErrorMessageBuilder::GET_LINE,
    ]
]
```
## Running Tests

To verify that the package is fully installed and working.
You can run the command below which will help you create a new dummy error.

```bash
php artisan notify:check
```

If the telegram did not receive a message, check that the `APP_ENV` value in the `.env` file is production.
If you are in a development environment, restart the app with the `php artisan serve` command.
In production mode you can load configurations from .env with `php artisan config:clear` command.


## License

[MIT](https://choosealicense.com/licenses/mit/)

