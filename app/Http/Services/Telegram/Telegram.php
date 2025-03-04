<?php

namespace App\Http\Services\Telegram;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class Telegram
{
    /**
     * Token de autenticação
     *
     * @var string
     */
    protected $token;

    /**
     * ID do chat para envio de mensagens
     *
     * @var string
     */
    protected $chatId;

    /**
     * URL base para os webservices
     *
     * @var string
     */
    protected $urlBase;

    /**
     * Criando uma nova instancia do serviço
     *
     * @return void
     */
    public function __construct()
    {
        $configuracao = Config::get('telegram'); 
        $this->urlBase = $configuracao['urlBase'];
        $this->token = $configuracao['token'];
        $this->chatId = $configuracao['chat_id']; 
    }

    /**
     * Envia uma mensagem para o Telegram.
     *
     * @param string $message
     * @return void
     */
    public function sendMessage(string $message)
    {
        $url = $this->urlBase . $this->token . '/sendMessage';
        $response = Http::withOptions([
            'verify' => false, 
        ])->get($url, [
            'chat_id' => $this->chatId,  
            'text' => $message,         
        ]);

        if ($response->successful()) {
            return $response->json();  
        } else {
            throw new \Exception('Erro ao enviar mensagem: ' . $response->body());
        }
    }

    /**
     * Envio de Broadcast em grupo de notificações
     *
     * @param string $message
     * @return void
     */
    public static function sendBroadcast($message)
    {
        $telegramBot = new self();
        $telegramBot->sendMessage($message);
    }
}
