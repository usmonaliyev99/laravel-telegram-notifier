
# laravel-telegram-notifier

This package send bugs and messages to your telegram group or chat. 


## Screenshots

![App Screenshot](https://lh3.googleusercontent.com/fife/AAbDypA-CKkrFGz-9sYZxVm9t3GT_UJHOJ8G9yResTkS6pANNbf-0Q_DqPxpTiQJgC1uGT5Or8h22sQGbDy1bM7QYc9t5cCr7Lj85R1JpTxM51WctOCa-Ss-N2AwaSP7AjwYxN40JPPKgzs-a_5r3jsXti6e9V6tENQshSU3nyJurx82V9kKY5GEfv__f9pMCMJlVgK0piIWqS94-otoGikf4LPHLgKDNHfoQsTpPdxZLgoF4P8IU2x_BE7sj2oVwfxhnW6SrfJd0NPYAOmzsbBrlBp5TQLv3UnVouSkJj-gTGqiQvkINz9TjdyGzMVAWFvyMoJe8X5W_5diykK9oNko8IsXD00Oz59YSJxeVpjgYa22-K0stKqXQHbDMZKjc1wBksTrL5oYBNpUq3NCMXXxSsjcS4k3xyXPhp-kLU6YDnC-Zdw-v9VOdhYdxECYFkOytXQRUK2Q55SN_PRI4z2mEVoX4DwVIBz3a2q0a0IYKqXXNmz3v_0sH2NUr31sTg1J_ymckdrjInQkLzz7uv9F0jV74IMMyu6oiqDM5nOkw5--i6A3Mah5NovLsY6AMDJ4DJYZtWYBK_DPa0Is3wc4LoCkmBTLVqJRihJB3tSozGZ-KE4hIyjWvl4TDEpwIczVIBr9xmO0G2aCrsH34nsfu2uOiTI61y8qvV-ZDliyCFLg6CciDmWwyEDiQ-iZgy5spIr8-3L8ZqZQQTKDTnz3G18GnzV6kN1OOxjCY3M7-w_N2-4Z2jP_Jl-UH68YOsUI6HCXvgapO4ZaGsx8SfhXleI27ph6nTkybFGUYH8H2rS-2-NdtYlc36vQ_oaOYKZlgSK_FW_XH0KGsByFkL_cTmRf7BAztvZd4raw2xQSWusbjVfVzCxG20zOa6CBbCLeztHA-oO8g3VU1mnEoyxfTo_flJg3MRiCtUkcVhzZjw6x7Ca3CCxp1QeROq16dIQDa7bnLNYW9yOJb4OQZg9eVpdc5ZN7HWBCpsboAGqkTik-EQJYDDHQ6hIbFN4A6u7QtKm4SD-zME8kdb_YQdin5nLYYbKHlfwfo5L3MBzTvTdyuQrFmu5hCxbwv_BT-cBdv9ALgSX8tBxpPDazQIgpk8SeFo40UozVdzjyckRIH86li9DMJ6OkZZBtsYn54JlmG-2VPEy5sDdNqmGdIc9WdAzkArV77IgdK2k1n6gEcsEMVvLuB1fJMacpFUlMAlHBo4XtyNw9tQLnATT2eHGet2lgIdmOOc4WzeZThC5gV2jeCnq8zrA8tgK2W5PK0UZb-MOxkxTcMs_E9pRlcrh3AV1O8Sz2zYy3Um2OLy0hZnOsOY-clzT-P0Jxqn9ktq82PD4mrY1sbRbbvM4chI83ZLrtdYeg9Fw0B-SePcuvW5NtLWVLRTnZbcXoeaxhNU2OeFeZAuWL8W_nyRYUXf9Ur2QIJn-v3tXSQYjmkLnqjgJTVs04c2FqCyWiRhDcXkPGuQ78ap_SpVX7JXGcXfHrGDvzHkDewiQSDIOd1CCcEcYM1Ue1_QGWqpaR=w1366-h683)

## Installation

Install this project with composer

```bash
  composer require usmonaliyev/laravel-telegram-notifier
```

For control it, create config file
```bash
php artisan vendor:publish --provider="Usmonaliyev\LaravelTelegramNotifier\LaravelTelegramNotifierServiceProvider"
```

For send errors to your telegram groups or accounts
 you should inject `Usmonaliyev/LaravelTelegramNotifier/TelegramNotifier`
 class in `app/Exceptions/Handler.php` file.

```php
use Throwable;
use Illuminate\Contracts\Container\Container;
use Usmonaliyev\LaravelTelegramNotifier\TelegramNotifier;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    private TelegramNotifier $telegramNotifier;

    public function __construct(Container $container, TelegramNotifier $telegramNotifier)
    {
        parent::__construct($container);

        $this->telegramNotifier = $telegramNotifier;
    }
```

You can send bugs to telegram groups or chats
via `$this->telegramNotifier->error($error);` function.
You should change your `register` function of  `app/Exceptions/Handler.php` file.

```php
/**
* Register the exception handling callbacks for the application.
*
* @return void
*/
public function register()
{
    $this->reportable(function (Throwable $e) {
        $this->telegramNotifier->error($e);
    });
}
```

And add your bot token and receiver chat id to `.env` file.

```
TELEGRAM_NOTIFIER_BOT_TOKEN=
CHAT_ID=
TELEGRAM_NOTIFIER_ERROR_LOG=true
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
If you want send bag to two or three chat ids you add chat id to `chat_ids` array of `laravel-telegram-notifier.php` file.

```
"chat_ids" => [env("CHAT_ONE_ID"), env("CHAT_TWO_ID"), env("CHAT_THREE_ID")],
```

Header of message, it default value is `APP_NAME` of `.env` file.
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
In production mode you can load conigurations from .env with `php artisan config:clear` command.


## License

[MIT](https://choosealicense.com/licenses/mit/)

