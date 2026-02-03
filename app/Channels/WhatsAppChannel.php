<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use App\Services\WhatsAppService;

class WhatsAppChannel
{
    public function __construct(
        private WhatsAppService $whatsapp,
    ) {}

    public function send(object $notifiable, Notification $notification): void
    {
        $message = $notification->toWhatsApp();

        if (! isset($message['to']) || ! isset($message['message'])) {
            return;
        }

        try {
            $this->whatsapp->send($message['to'], $message['message']);
        } catch (\Throwable $e) {
            \Log::error('WhatsApp notification failed', [
                'phone' => $message['to'],
                'error' => $e->getMessage(),
            ]);
        }
    }
}
