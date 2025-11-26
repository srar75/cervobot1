<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WatiService
{
    protected $apiEndpoint;
    protected $accessToken;

    public function __construct()
    {
        $this->apiEndpoint = env('WATI_API_ENDPOINT');
        $this->accessToken = env('WATI_ACCESS_TOKEN');
    }

    /**
     * Send a text message to a specific number.
     *
     * @param string $whatsappNumber
     * @param string $message
     * @return array
     */
    public function sendMessage($whatsappNumber, $message)
    {
        $url = $this->apiEndpoint . '/api/v1/sendSessionMessage/' . $whatsappNumber;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken,
        ])->post($url, [
            'messageText' => $message,
        ]);

        if ($response->failed()) {
            Log::error('Wati Send Message Error: ' . $response->body());
            return ['success' => false, 'error' => $response->body()];
        }

        return ['success' => true, 'data' => $response->json()];
    }

    /**
     * Send a template message.
     *
     * @param string $whatsappNumber
     * @param string $templateName
     * @param array $parameters
     * @return array
     */
    public function sendTemplateMessage($whatsappNumber, $templateName, $parameters = [])
    {
        $url = $this->apiEndpoint . '/api/v1/sendTemplateMessage/' . $whatsappNumber;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken,
        ])->post($url, [
            'template_name' => $templateName,
            'broadcast_name' => 'template_msg_' . time(),
            'parameters' => $parameters,
        ]);

        if ($response->failed()) {
            Log::error('Wati Send Template Error: ' . $response->body());
            return ['success' => false, 'error' => $response->body()];
        }

        return ['success' => true, 'data' => $response->json()];
    }
}
