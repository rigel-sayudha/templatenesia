<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteeService
{
    protected string $baseUrl;
    protected ?string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.fonntee.url', env('FONNTEE_API_URL'));
        $this->apiKey = config('services.fonntee.key', env('FONNTEE_API_KEY'));
    }

    /**
     * Send a WhatsApp message via Fonntee API.
     *
     * @param string $phone E.164 or local phone number as accepted by provider
     * @param string $message
     * @return \Illuminate\Http\Client\Response
     */
    public function sendWhatsApp(string $phone, string $message)
    {
        $url = rtrim($this->baseUrl ?? 'https://api.fonntee.example', '/').'/v1/messages';

        $payload = [
            'to' => $phone,
            'type' => 'text',
            'text' => [ 'body' => $message ],
        ];

        $headers = [];
        if ($this->apiKey) {
            $headers['Authorization'] = 'Bearer ' . $this->apiKey;
        }

        return Http::withHeaders($headers)
            ->acceptJson()
            ->post($url, $payload);
    }
}
