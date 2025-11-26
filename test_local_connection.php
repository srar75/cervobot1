<?php

use Illuminate\Support\Facades\Http;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Testing Local Server...\n";

try {
    $response = Http::post('http://127.0.0.1:8000/api/wati/webhook', [
        'waId' => '1234567890',
        'text' => 'Hola',
        'type' => 'text'
    ]);

    if ($response->successful()) {
        echo "Local Server Test: SUCCESS\n";
        echo "Response: " . $response->body() . "\n";
    } else {
        echo "Local Server Test: FAILED\n";
        echo "Status: " . $response->status() . "\n";
        echo "Response: " . $response->body() . "\n";
    }
} catch (\Exception $e) {
    echo "Local Server Test: ERROR - " . $e->getMessage() . "\n";
    echo "Make sure 'php artisan serve' is running.\n";
}
