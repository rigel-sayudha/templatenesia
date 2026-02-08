<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\Notifications\OrderPaidNotification;
use App\Mail\PaymentConfirmationMail;
use App\Services\FontteWhatsappService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendPaymentConfirmation implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(
        protected FontteWhatsappService $whatsappService,
    ) {}

    /**
     * Handle the event.
     */
    public function handle(OrderPaid $event): void
    {
        try {
            $event->model->notify(new OrderPaidNotification($event->model));

            Mail::to($event->model->customer_email)
                ->send(new PaymentConfirmationMail($event->model));

            $adminMessage = "✅ *Pembayaran Diterima*\n\n";
            $adminMessage .= "Invoice: {$event->model->invoice_id}\n";
            $adminMessage .= "Customer: {$event->model->customer_name}\n";
            $adminMessage .= "Produk: " . ($event->model->product?->name ?? 'Unknown') . "\n";
            $adminMessage .= "Jumlah: {$event->model->quantity}\n";
            $adminMessage .= "Total: Rp " . number_format($event->model->total, 0, ',', '.') . "\n";
            $adminMessage .= "Status: Pembayaran Dikonfirmasi ✅";

            $this->whatsappService->sendAdminNotification($adminMessage);

            Log::info('Payment confirmation sent (WhatsApp + Email)', [
                'invoice_id' => $event->model->invoice_id,
                'customer_phone' => $event->model->customer_phone,
                'customer_email' => $event->model->customer_email,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send payment confirmation', [
                'invoice_id' => $event->model->invoice_id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
