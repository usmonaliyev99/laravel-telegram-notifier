<?php

namespace Usmonaliyev\LaravelTelegramNotifier;

use Illuminate\Support\ServiceProvider;

/**
 * class LaravelTelegramNotifierServiceProvider
 */
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
    }
}
