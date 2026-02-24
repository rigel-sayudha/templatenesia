<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$orders = \App\Models\Order::latest()->take(5)->get();
foreach ($orders as $order) {
    echo "Invoice: {$order->invoice_id} | Product: {$order->product_id} | Qty: {$order->quantity} | Total: {$order->total} | Created At: {$order->created_at}\n";
}
