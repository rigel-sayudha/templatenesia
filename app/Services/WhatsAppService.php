<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    protected string $baseUrl;
    protected ?string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.fonntee.url') ?? env('FONNTEE_API_URL');
        $this->apiKey = config('services.fonntee.key') ?? env('FONNTEE_API_KEY');
    }

    /**
     * Send a text message via Fonntee (simple wrapper).
     *
     * @param string $to Phone number in international format (e.g. 628123...)
     * @param string $message
     * @return array
     */
    public function send(string $to, string $message): array
    {
        if (! $this->baseUrl || ! $this->apiKey) {
            throw new \RuntimeException('Fonntee API not configured. Set FONNTEE_API_URL and FONNTEE_API_KEY.');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Accept' => 'application/json',
        ])->post(rtrim($this->baseUrl, '/') . '/v1/messages', [
            'to' => $to,
            'type' => 'text',
            'text' => [
                'body' => $message,
            ],
        ]);

        return $response->json();
    }
}
