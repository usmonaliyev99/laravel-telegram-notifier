<?php

use Usmonaliyev\LaravelTelegramNotifier\Utils\MessageSection;
use Usmonaliyev\LaravelTelegramNotifier\Utils\ErrorMessageBuilder;
use Usmonaliyev\LaravelTelegramNotifier\Utils\RequestMessageBuilder;

return [

    /**
     * When app_env is not equal local then bot send error to telegram.
     */
    "app_env" => env("APP_ENV", "local"),

    /**
     * Token of bot is required.
     *
     * This package will read token of your bot in your .env file.
     */
    "token" => env("TELEGRAM_NOTIFIER_BOT_TOKEN", null),

    /**
     * Write a log when there is an error when sending a message to Telegram
     */
    "error_log" => env("TELEGRAM_NOTIFIER_ERROR_LOG", false),

    /**
     * Receiver chat ids of telegram profile and group
     *
     * Example: [7685948574, -46584763857]
     * Example: [env("CHAT_ONE_ID"), env("CHAT_TWO_ID")]
     */
    "chat_ids" => [env("CHAT_ID")],

    /**
     * Header of message.
     * I recommend text end with \n
     */
    "message_title" => env("APP_NAME", "laravel-telegram-notifier") . "\n",

    /**
     * Content of message.
     */
    "message" => [

        /**
         * Information of request
         */
        MessageSection::REQUEST => [

            /**
             * Get all of the input and files for the request.
             */
            "body" => RequestMessageBuilder::ALL,

            /**
             * Returns the path being requested relative to the executed script.
             *
             * The path info always starts with a /.
             *
             * Suppose this request is instantiated from /mysite on localhost:
             *
             *  * http://localhost/mysite              returns an empty string
             *  * http://localhost/mysite/about        returns '/about'
             *  * http://localhost/mysite/enco%20ded   returns '/enco%20ded'
             *  * http://localhost/mysite/about?var=1  returns '/about'
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

            /**
             * Get method of request
             */
            "method" => RequestMessageBuilder::METHOD,
        ],

        /**
         * Information of error
         */
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

            // "trace" => ErrorMessageBuilder::GET_TRACE,
        ]
    ]
];
