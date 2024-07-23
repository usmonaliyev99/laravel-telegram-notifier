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
    protected Telegram $telegram;

    /**
     * @var array $chatIds
     */
    protected array $chatIds;

    protected array $messageOptions = [];

    protected ?string $responsible;

    /**
     * Constructor of TelegramNotifier class
     */
    public function __construct()
    {
        $this->telegram = new Telegram(config("laravel-telegram-notifier.token", null), config("laravel-telegram-notifier.error_log"));

        $this->chatIds = config("laravel-telegram-notifier.chat_ids", []);
        $this->messageOptions = config("laravel-telegram-notifier.message", []);
        $this->responsible = config("laravel-telegram-notifier.responsible", null);
    }

    /**
     * This function send error message to chats or groups.
     *
     * @param Throwable $error
     */
    public function error(Throwable $error): void
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

        $request = request();

        $message = [
            MessageSection::RESPONSIBLE => $this->responsible,
            MessageSection::REQUEST => [],
            MessageSection::ERROR => []
        ];
        if (isset($this->messageOptions[MessageSection::REQUEST])) {
            foreach ($this->messageOptions[MessageSection::REQUEST] as $key => $messageOption) {
                $message["request"][$key] = $request->{$messageOption}();
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
        }
    }

    /**
     * Send message to chat id
     *
     * @param int|string $chatId
     * @param string $text
     * @param array|null $replyMarkup
     * @return mixed
     */
    public function sendMessage(int|string $chatId, string $text, array $replyMarkup = null): mixed
    {
        $message = [
            'chat_id' => $chatId,
            'text' => $text,
        ];
        if ($replyMarkup) {
            $message['reply_markup'] = json_encode($replyMarkup);
        }

        return $this->telegram->sendMessage($message);
    }

    /**
     * Send message to each chat id
     *
     * @param string $text
     * @param null $replyMarkup
     * @param bool $title
     * @return void
     */
    public function notify(string $text, $replyMarkup = null, bool $title = true): void
    {
        if ($title) {
            $text = config("laravel-telegram-notifier.message_title", "") . $text;
        }

        $content = [
            'chat_id' => null,
            'text' => $text,
        ];

        if ($replyMarkup) {
            $content['reply_markup'] = json_encode($replyMarkup);
        }

        array_map(
            function ($chatId) use (&$content) {
                $content['chat_id'] = $chatId;

                $this->telegram->sendMessage($content);
            },
            $this->chatIds
        );
    }
}
