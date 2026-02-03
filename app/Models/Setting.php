<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'store_description',
        'store_logo',
        'whatsapp_number',
        'whatsapp_text',
        'terms_and_conditions',
        'email',
        'social_media',
        'service_fee_percentage',
        'service_fee_nominal',
        'enable_manual_payment',
        'enable_midtrans',
        'midtrans_server_key',
        'midtrans_client_key',
        'midtrans_is_production',
        'fonnte_api_key',
        'enable_whatsapp_notification',
        'enable_email_notification',
        'enable_visitor_notification',
        'visitor_notification_min',
        'visitor_notification_max',
        'enable_purchase_notification',
    ];

    protected $casts = [
        'social_media' => 'json',
        'enable_manual_payment' => 'boolean',
        'enable_midtrans' => 'boolean',
        'midtrans_is_production' => 'boolean',
        'enable_whatsapp_notification' => 'boolean',
        'enable_email_notification' => 'boolean',
        'enable_visitor_notification' => 'boolean',
        'enable_purchase_notification' => 'boolean',
    ];

    // Helper methods
    public static function storeName()
    {
        return self::pluck('store_name')->first() ?? 'Templatenesia';
    }

    public static function storeDescription()
    {
        return self::pluck('store_description')->first();
    }

    public static function storeLogo()
    {
        return self::pluck('store_logo')->first();
    }

    public static function whatsappNumber()
    {
        return self::pluck('whatsapp_number')->first();
    }
}
