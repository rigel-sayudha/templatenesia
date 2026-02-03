<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        PaymentMethod::truncate();

        // Bank Transfer Methods (Manual)
        PaymentMethod::create([
            'name' => 'Bank BRI',
            'bank_code' => 'bri',
            'account_number' => '1234567890',
            'account_name' => 'Templatenesia',
            'type' => 'manual',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Bank BCA',
            'bank_code' => 'bca',
            'account_number' => '9876543210',
            'account_name' => 'Templatenesia',
            'type' => 'manual',
            'is_active' => true,
        ]);

        PaymentMethod::create([
            'name' => 'Bank BNI',
            'bank_code' => 'bni',
            'account_number' => '5555666677',
            'account_name' => 'Templatenesia',
            'type' => 'manual',
            'is_active' => true,
        ]);

        // Midtrans (Automatic)
        PaymentMethod::create([
            'name' => 'Midtrans',
            'bank_code' => 'midtrans',
            'account_number' => null,
            'account_name' => null,
            'type' => 'automatic',
            'is_active' => true,
        ]);
    }
}
