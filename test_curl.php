<?php
$url = 'http://127.0.0.1:8000/checkout';
$data = ['product_id' => 6, 'quantity' => 1, 'name' => 'Tester Web', 'email' => 'tes@aja.com', 'phone' => '0812', 'paymentMethod' => 'midtrans'];
$options = [
    'http' => [
        'header'  => "Content-type: application/json\r\nAccept: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
        'ignore_errors' => true
    ]
];
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
echo "RESPONSE FROM HTTP SERVER:\n";
echo $result . "\n";
