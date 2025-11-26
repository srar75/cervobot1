<?php

use Illuminate\Support\Facades\Http;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Get URL from argument or prompt
$url = $argv[1] ?? null;

if (!$url) {
    echo "Usage: php test_public_url.php <YOUR_PUBLIC_URL>\n";
    exit(1);
}

echo "Testing Public URL: $url\n";

try {
    $response = Http::post($url, [
        'waId' => '1234567890',
        'text' => 'Hola',
        'type' => 'text'
    ]);

    if ($response->successful()) {
        echo "Public URL Test: SUCCESS\n";
        echo "Response: " . $response->body() . "\n";
    } else {
        echo "Public URL Test: FAILED\n";
        echo "Status: " . $response->status() . "\n";
        echo "Response: " . $response->body() . "\n";
    }
} catch (\Exception $e) {
    echo "Public URL Test: ERROR - " . $e->getMessage() . "\n";
}
