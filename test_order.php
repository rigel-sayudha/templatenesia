<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$order = \App\Models\Order::latest()->first();
if ($order) {
    $product = \App\Models\Product::find($order->product_id);
    echo "--- LATEST ORDER ---\n";
    echo "Invoice ID: " . $order->invoice_id . "\n";
    echo "Product ID: " . $order->product_id . "\n";
    echo "Total DB: " . $order->total . "\n";
    echo "Product Name: " . ($product ? $product->name : 'N/A') . "\n";
    echo "Product Price DB: " . ($product ? $product->price : 'N/A') . "\n";
    echo "Product Discount DB: " . ($product ? $product->discount_price : 'N/A') . "\n";
} else {
    echo "No order found!\n";
}
