<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$v = \App\Models\Voucher::where('code', strtoupper('BERKAHRAMADHAN'))->first();
if (!$v) {
    echo "NOT FOUND\n";
    exit;
}
echo json_encode($v->toArray(), JSON_PRETTY_PRINT) . "\n----------\n";

$now = now();
echo "NOW: " . $now->toDateTimeString() . "\n";
echo "START_DATE: " . ($v->start_date ? $v->start_date->toDateTimeString() : 'NULL') . "\n";
echo "END_DATE: " . ($v->end_date ? $v->end_date->toDateTimeString() : 'NULL') . "\n";

if ($v->start_date && $v->start_date > $now) echo "Failed: start_date\n";
if ($v->end_date && $v->end_date < $now) echo "Failed: end_date\n";
if ($v->usage_limit && $v->usage_count >= $v->usage_limit) echo "Failed: limit\n";

echo "ALL VALIDATIONS PASSED\n";
