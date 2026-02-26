<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WhatsAppService;

class NotificationController extends Controller
{
    protected WhatsAppService $whatsapp;

    public function __construct(WhatsAppService $whatsapp)
    {
        $this->whatsapp = $whatsapp;
    }

    public function sendTestWhatsApp(Request $request, $phone)
    {
        $message = $request->get('message', 'Test message from Templatenesia');

        try {
            $response = $this->whatsapp->send($phone, $message);
            return response()->json(['ok' => true, 'response' => $response]);
        } catch (\Throwable $e) {
            return response()->json(['ok' => false, 'error' => $e->getMessage()], 400);
        }
    }
}
