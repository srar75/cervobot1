<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class WatiWebhookTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_wati_webhook_receives_message_and_responds(): void
    {
        // Mock the Wati API response
        Http::fake([
            '*/api/v1/sendSessionMessage/*' => Http::response(['result' => 'success'], 200),
        ]);

        $payload = [
            'waId' => '1234567890',
            'text' => 'Hola',
            'type' => 'text',
            'senderName' => 'Test User'
        ];

        $response = $this->postJson('/api/wati/webhook', $payload);

        $response->assertStatus(200);
    }

    public function test_wati_webhook_flight_search(): void
    {
        Http::fake([
            '*/api/v1/sendSessionMessage/*' => Http::response(['result' => 'success'], 200),
        ]);

        $payload = [
            'waId' => '1234567890',
            'text' => 'Vuelo Madrid a Paris',
            'type' => 'text',
        ];

        $response = $this->postJson('/api/wati/webhook', $payload);

        $response->assertStatus(200);
    }

    public function test_wati_webhook_flight_status(): void
    {
        Http::fake([
            '*/api/v1/sendSessionMessage/*' => Http::response(['result' => 'success'], 200),
        ]);

        $payload = [
            'waId' => '1234567890',
            'text' => 'Estado IB1234',
            'type' => 'text',
        ];

        $response = $this->postJson('/api/wati/webhook', $payload);

        $response->assertStatus(200);
    }
}
