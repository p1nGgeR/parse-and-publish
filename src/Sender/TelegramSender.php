<?php

namespace App\Sender;

use App\Entity\TelegramChannel;
use App\Exception\TelegramException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TelegramSender
{
    public function __construct(private HttpClientInterface $telegramClient)
    {
    }

    public function sendMessage(TelegramChannel $channel, string $text): string
    {
        return $this->send($channel, "sendMessage", [
            'text' => $text,
        ]);
    }

    public function sendPhoto(TelegramChannel $channel, string $photoUrl, string $caption): string
    {
        return $this->send($channel, "sendPhoto", [
            'photo' => $photoUrl,
            'caption' => $caption,
        ]);
    }

    private function send(TelegramChannel $channel, string $action, array $params): string
    {
        $url = "/bot{$channel->getApiToken()}/{$action}";

        $requestParams = array_merge([
            'chat_id' => "@{$channel->getTelegramId()}",
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ], $params);

        $response = $this->telegramClient->request("GET", $url, [
            'query' => $requestParams,
        ])->toArray(false);

        if (!($response['ok'] === true)) {
            throw new TelegramException($response['description']);
        }

        return "https://t.me/{$channel->getTelegramId()}/{$response['result']['message_id']}";
    }
}
