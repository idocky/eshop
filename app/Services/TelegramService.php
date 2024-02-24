<?php

namespace App\Services;

use Telegram\Bot\Api;

class TelegramService
{
    protected $telegram;

    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    public function sendMessage($chatId, $text)
    {
        $response = $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $text,
        ]);

        return $response;
    }
}
