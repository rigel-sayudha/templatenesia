<?php
$envFile = __DIR__ . '/.env';
$env = file_get_contents($envFile);
$env = preg_replace('/MIDTRANS_MERCHANT_ID=.*/', 'MIDTRANS_MERCHANT_ID=G113718664', $env);
$env = preg_replace('/MIDTRANS_CLIENT_KEY=.*/', 'MIDTRANS_CLIENT_KEY=SB-Mid-client-d8K3zqYlV-38PwDK', $env);
$env = preg_replace('/MIDTRANS_SERVER_KEY=.*/', 'MIDTRANS_SERVER_KEY=SB-Mid-server-kt0wxJfAA_vwVSV-Ws779hgW', $env);
file_put_contents($envFile, $env);
echo "Berhasil memperbarui .env dengan kredensial baru Midtrans\n";
