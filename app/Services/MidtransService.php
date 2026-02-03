<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Order;

class MidtransService
{
    protected ?string $serverKey;
    protected ?string $clientKey;
    protected bool $isProduction;

    public function __construct()
    {
        $this->serverKey = env('MIDTRANS_SERVER_KEY');
        $this->clientKey = env('MIDTRANS_CLIENT_KEY');
        $this->isProduction = env('MIDTRANS_IS_PRODUCTION', false);
    }

    /**
     * Create a Snap transaction. If server key is not configured, return a mock token and url for dev flows.
     *
     * @param Order $order
     * @return array ['token' => string, 'redirect_url' => string]
     */
    public function createTransaction(Order $order): array
    {
        if (! $this->serverKey) {
            $token = 'MOCK-' . strtoupper(uniqid());
            // Provide a redirect URL that simulates a payment gateway flow (dev webhook)
            $redirect = url('/dev/webhook/payment?invoice_id=' . $order->invoice_id . '&status=paid');
            return ['token' => $token, 'redirect_url' => $redirect, 'client_key' => $this->clientKey];
        }

            $base = $this->isProduction ? 'https://app.midtrans.com' : 'https://app.sandbox.midtrans.com';

        $payload = [
            'transaction_details' => [
                'order_id' => $order->invoice_id,
                'gross_amount' => $order->total,
            ],
            'item_details' => [
                [
                    'id' => $order->product_id,
                    'price' => $order->total,
                    'quantity' => $order->quantity,
                    'name' => $order->product->title ?? 'Product',
                ]
            ],
        ];

            $response = Http::withBasicAuth($this->serverKey, '')->post($base . '/snap/v1/transactions', $payload);
        $json = $response->json();

        return [
            'token' => $json['token'] ?? null,
            'redirect_url' => $json['redirect_url'] ?? ($json['redirect_url'] ?? null),
            'client_key' => $this->clientKey,
        ];
    }
}
