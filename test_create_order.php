<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$o = App\Models\Order::create([
    'invoice_id' => 'INV-TEST1235',
    'product_id' => 6,
    'quantity' => 1,
    'total' => 399000,
    'status' => 'pending',
    'customer_name' => 'Test2',
    'customer_phone' => '08123',
    'customer_email' => 'test@test.com',
]);
echo "Created: " . $o->total . "\n";
$o2 = App\Models\Order::where('invoice_id', 'INV-TEST1235')->first();
echo "Saved DB: " . $o2->total . "\n";
