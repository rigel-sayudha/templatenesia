<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderPaidNotification extends Notification
{
    public function __construct(
        public Order $order,
        public string $customerPhone,
    ) {}

    public function via(object $notifiable): array
    {
        return ['whatsapp'];
    }

    public function toWhatsApp(): array
    {
        $productName = $this->order->product?->name ?? 'Product';
        $price = number_format($this->order->total, 0, ',', '.');
        
        $message = "✅ *Pesanan Berhasil!*\n\n";
        $message .= "Invoice: {$this->order->invoice_id}\n";
        $message .= "Produk: {$productName}\n";
        $message .= "Jumlah: {$this->order->quantity}\n";
        $message .= "Total: Rp {$price}\n";
        $message .= "Status: Lunas ✓\n\n";
        $message .= "Link download akan dikirim segera.";
        
        return [
            'to' => $this->customerPhone,
            'message' => $message,
        ];
    }
}
