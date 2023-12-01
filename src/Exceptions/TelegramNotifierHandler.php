<?php

namespace Usmonaliyev\LaravelTelegramNotifier\Exceptions;

use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Usmonaliyev\LaravelTelegramNotifier\TelegramNotifier;

class TelegramNotifierException extends ExceptionHandler
{
    private TelegramNotifier $telegramNotifier;
    public function __construct(Container $container, TelegramNotifier $telegramNotifier)
    {
        parent::__construct($container);

        $this->telegramNotifier = $telegramNotifier;
    }

    public function register(): void
    {

        $this->reportable(function (Throwable $throwable) {

            $this->telegramNotifier->error($throwable);
        });
    }

}
