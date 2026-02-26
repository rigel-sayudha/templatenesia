<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Events\OrderCreated;
use App\Events\OrderPaid;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'invoice_id','user_id','product_id','quantity','total','status','customer_name','customer_phone','customer_email','meta','payment_proof'
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    protected $dispatchesEvents = [
        'created' => OrderCreated::class,
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function routeNotificationForWhatsapp()
    {
        return $this->customer_phone;
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $originalStatus = $model->getOriginal('status');
            if ($originalStatus !== 'paid' && $model->status === 'paid') {
                OrderPaid::dispatch($model);
            }
        });
    }
}
