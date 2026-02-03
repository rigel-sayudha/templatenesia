<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Create orders for today
        for ($i = 0; $i < 3; $i++) {
            Order::create([
                'invoice_id' => 'INV-' . date('Ymd') . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'customer_name' => 'Customer ' . ($i + 1),
                'customer_email' => 'customer' . ($i + 1) . '@example.com',
                'customer_phone' => '081234567' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'product_id' => 1,
                'quantity' => 1,
                'total' => 150000 + ($i * 50000),
                'status' => $i % 2 === 0 ? 'paid' : 'pending',
                'meta' => [
                    'payment_method' => $i % 2 === 0 ? 'manual' : 'midtrans'
                ],
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
            ]);
        }

        // Create orders for this week
        for ($i = 0; $i < 2; $i++) {
            Order::create([
                'invoice_id' => 'INV-' . date('Ymd', strtotime('-' . ($i + 1) . ' days')) . '-' . str_pad(($i + 4), 4, '0', STR_PAD_LEFT),
                'customer_name' => 'Weekly Customer ' . ($i + 1),
                'customer_email' => 'weekly' . ($i + 1) . '@example.com',
                'customer_phone' => '082234567' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'product_id' => 1,
                'quantity' => 2,
                'total' => 300000 + ($i * 100000),
                'status' => 'paid',
                'meta' => [
                    'payment_method' => $i % 2 === 0 ? 'manual' : 'midtrans'
                ],
                'created_at' => Carbon::now()->subDays($i + 1),
                'updated_at' => Carbon::now()->subDays($i + 1),
            ]);
        }
    }
}
