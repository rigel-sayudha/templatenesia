<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$order = \App\Models\Order::latest()->first();
$midtrans = $app->make(\App\Services\MidtransService::class);

try {
    $tx = $midtrans->createTransaction($order);
    echo "Success! Redirect URL: " . $tx['redirect_url'] . "\n";
} catch (\Throwable $e) {
    echo "Midtrans Error!\n";
    echo $e->getMessage() . "\n";
    if (method_exists($e, 'getResponse')) {
        echo $e->getResponse()->getBody()->getContents() . "\n";
    }
}
