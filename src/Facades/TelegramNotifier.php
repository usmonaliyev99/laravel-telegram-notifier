<?php

namespace Usmonaliyev\LaravelTelegramNotifier\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Usmonaliyev\LaravelTelegramNotifier\TelegramNotifier notify(string $text, $replyMarkup = null, bool $title = true)
 * @method static \Usmonaliyev\LaravelTelegramNotifier\TelegramNotifier error(\Throwable $throwable)
 * @method static \Usmonaliyev\LaravelTelegramNotifier\TelegramNotifier sendMessage(int|string $chatId, string $text, array $replyMarkup = null)
 *
 * @see \Usmonaliyev\LaravelTelegramNotifier\TelegramNotifier
 */
class TelegramNotifier extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Usmonaliyev\LaravelTelegramNotifier\TelegramNotifier::class;
    }
}
