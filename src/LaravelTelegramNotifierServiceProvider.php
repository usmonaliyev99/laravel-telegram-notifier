<?php

namespace Usmonaliyev\LaravelTelegramNotifier;

use Illuminate\Support\ServiceProvider;
use Usmonaliyev\LaravelTelegramNotifier\Telegram\Telegram;

class LaravelTelegramNotifierServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . "/../config/laravel-telegram-notifier.php", "laravel-telegram-notifier");

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . "/../config/laravel-telegram-notifier.php" => config_path("laravel-telegram-notifier.php")
            ]);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $BOT_TOKEN = config("laravel-telegram-notifier.token");
        $errorLog = config("laravel-telegram-notifier.error_log");

        $this->app->singleton(Telegram::class, fn () => new Telegram($BOT_TOKEN, $errorLog));
    }
}
