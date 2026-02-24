<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'description',
        'type',
        'value',
        'usage_limit',
        'usage_count',
        'start_date',
        'end_date',
        'is_active',
    ];
}
