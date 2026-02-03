<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FontteWhatsappService
{
    protected string $baseUrl = 'https://api.fonnte.com/send';
    protected string $username;
    protected string $password;

    public function __construct()
    {
        $this->username = config('services.fonnte.username');
        $this->password = config('services.fonnte.password');
    }

    /**
     * Send WhatsApp message via Fonnte
     */
    public function send(string $phone, string $message): array
    {
        try {
            // Format nomor telepon (remove leading 0, add 62)
            $phone = $this->formatPhoneNumber($phone);

            $response = Http::timeout(30)
                ->post($this->baseUrl, [
                    'target' => $phone,
                    'message' => $message,
                    'countryCode' => '62', // Indonesia
                    'username' => $this->username,
                    'password' => $this->password,
                ]);

            $result = $response->json();

            // Log the response
            Log::info('Fonnte WhatsApp Message Sent', [
                'phone' => $phone,
                'response' => $result,
                'status' => $response->status(),
            ]);

            return [
                'success' => $response->successful(),
                'data' => $result,
                'status_code' => $response->status(),
            ];
        } catch (\Exception $e) {
            Log::error('Fonnte WhatsApp Error', [
                'phone' => $phone,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Format phone number to international format
     */
    protected function formatPhoneNumber(string $phone): string
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // If starts with 0, replace with 62
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        } elseif (!str_starts_with($phone, '62')) {
            // If doesn't start with 62, add it
            $phone = '62' . $phone;
        }

        return $phone;
    }

    /**
     * Send order notification
     */
    public function sendOrderNotification(array $order): array
    {
        $message = $this->buildOrderMessage($order);
        return $this->send($order['customer_phone'], $message);
    }

    /**
     * Send payment reminder
     */
    public function sendPaymentReminder(array $order): array
    {
        $message = "💳 *Pengingat Pembayaran*\n\n";
        $message .= "Invoice: {$order['invoice_id']}\n";
        $message .= "Produk: {$order['product_name']}\n";
        $message .= "Total: Rp " . number_format($order['total'], 0, ',', '.') . "\n\n";
        $message .= "Pembayaran belum diterima. Silahkan lakukan pembayaran sekarang.";

        return $this->send($order['customer_phone'], $message);
    }

    /**
     * Send payment confirmation
     */
    public function sendPaymentConfirmation(array $order): array
    {
        $message = "✅ *Pembayaran Diterima*\n\n";
        $message .= "Invoice: {$order['invoice_id']}\n";
        $message .= "Produk: {$order['product_name']}\n";
        $message .= "Total: Rp " . number_format($order['total'], 0, ',', '.') . "\n\n";
        $message .= "Terima kasih! Pembayaran Anda telah dikonfirmasi.\n";
        $message .= "File download akan dikirimkan segera.";

        return $this->send($order['customer_phone'], $message);
    }

    /**
     * Send download link
     */
    public function sendDownloadLink(string $phone, string $fileName, string $downloadUrl): array
    {
        $message = "📥 *File Siap Download*\n\n";
        $message .= "File: {$fileName}\n";
        $message .= "Link: {$downloadUrl}\n\n";
        $message .= "Link berlaku selama 7 hari. Silahkan download sekarang.";

        return $this->send($phone, $message);
    }

    /**
     * Send admin notification
     */
    public function sendAdminNotification(string $message): array
    {
        $adminPhone = config('services.fonnte.admin_phone');
        return $this->send($adminPhone, $message);
    }

    /**
     * Build order message
     */
    protected function buildOrderMessage(array $order): string
    {
        $message = "📦 *Pesanan Baru Diterima*\n\n";
        $message .= "Invoice: {$order['invoice_id']}\n";
        $message .= "Produk: {$order['product_name']}\n";
        $message .= "Jumlah: {$order['quantity']}\n";
        $message .= "Total: Rp " . number_format($order['total'], 0, ',', '.') . "\n";
        $message .= "Status: Menunggu Pembayaran ⏳\n\n";
        $message .= "Silahkan lakukan pembayaran melalui:\n";
        $message .= config('app.url') . "/checkout/{$order['invoice_id']}";

        return $message;
    }
}
