<?php

namespace App\Notifications\Channels;

use App\Services\FontteWhatsappService;
use Illuminate\Notifications\Notification;

class FontteWhatsappChannel
{
    public function __construct(
        protected FontteWhatsappService $whatsappService,
    ) {}

    /**
     * Send the given notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        if (!method_exists($notification, 'toWhatsapp')) {
            return;
        }

        $whatsappData = $notification->toWhatsapp();

        $this->whatsappService->send(
            $whatsappData['to'],
            $whatsappData['message']
        );
    }
}
