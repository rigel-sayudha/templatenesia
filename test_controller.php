<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = \Illuminate\Http\Request::create('/checkout', 'POST', [], [], [], [], json_encode([
    'product_id' => 6,
    'quantity' => 1,
    'name' => 'Tester Midtrans',
    'email' => 'midtrans@test.com',
    'phone' => '08123456789',
    'paymentMethod' => 'midtrans'
]));
$request->headers->set('Content-Type', 'application/json');

$controller = $app->make(\App\Http\Controllers\CheckoutController::class);
try {
    $wa = $app->make(\App\Services\WhatsAppService::class);
    $midtrans = $app->make(\App\Services\MidtransService::class);
    $response = $controller->checkout($request, $midtrans, $wa);
    echo "JSON Response:\n" . $response->getContent() . "\n";
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}

$latest = \App\Models\Order::latest()->first();
echo "\n--- RECORDED DB --- \n";
echo "Invoice: " . $latest->invoice_id . "\n";
echo "Product ID: " . $latest->product_id . "\n";
echo "Qty: " . $latest->quantity . "\n";
echo "Total DB: " . $latest->total . "\n";
