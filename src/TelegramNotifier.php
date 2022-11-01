<?php

namespace Usmonaliyev\LaravelTelegramNotifier;

use Error;
use Throwable;
use Usmonaliyev\LaravelTelegramNotifier\Telegram\Telegram;
use Usmonaliyev\LaravelTelegramNotifier\Utils\MessageSection;

/**
 * class TelegramNotifier
 *
 * @author Usmonaliyev Temur
 */
class TelegramNotifier
{
    /**
     * @var Telegram $telegram
     */
    private Telegram $telegram;

    /**
     * @var array $chatIds
     */
    private array $chatIds;

    private array $messageOptions = [];

    /**
     * Constructor of TelegramNotifier class
     */
    public function __construct()
    {
        $this->telegram = new Telegram(config("laravel-telegram-notifier.token", null), config("laravel-telegram-notifier.error_log"));

        $this->chatIds = config("laravel-telegram-notifier.chat_ids", []);
        $this->messageOptions = config("laravel-telegram-notifier.message", []);
    }

    /**
     * This function send error message to chats or groups.
     *
     * @param Throwable $error
     */
    public function error(Throwable $error)
    {
        if (config("laravel-telegram-notifier.app_env", "local") != "production") return;

        $messageTitle = config("laravel-telegram-notifier.message_title", "");
        if (
            !isset($this->messageOptions[MessageSection::REQUEST])
            && !isset($this->messageOptions[MessageSection::ERROR])
            && $messageTitle == ""
        ) {
            throw new Error("In your config message_title and request and error options should not be empty at the same time !");
        }

        $message = [
            MessageSection::REQUEST => [],
            MessageSection::ERROR => []
        ];
        if (isset($this->messageOptions[MessageSection::REQUEST])) {
            foreach ($this->messageOptions[MessageSection::REQUEST] as $key => $messageOption) {
                $message["request"][$key] = request()->{$messageOption}();
            }
        }
        if (isset($this->messageOptions[MessageSection::ERROR])) {
            foreach ($this->messageOptions[MessageSection::ERROR] as $key => $messageOption) {
                $message["error"][$key] = $error->{$messageOption}();
            }
        }

        foreach ($this->chatIds as $chatId) {

            $this->telegram->sendMessage([
                "chat_id" => $chatId,
                "text" => $messageTitle . str_replace("\\", "", json_encode($message, 128)),
            ]);

            sleep(1);
        }
    }
}
