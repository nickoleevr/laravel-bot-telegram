<?php

namespace App\Http\Controllers;


use App\Http\Services\Telegram\Telegram;

class TelegramController extends Controller
{
    protected $telegramService;

    public function __construct(Telegram $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    public function sendMessage()
    {
        $message = "Bem-vindo ao nosso Telegram!";
        $this->telegramService->sendMessage($message);
    }

   
}
