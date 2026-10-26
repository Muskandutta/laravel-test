<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class IdempotencyTest extends TestCase
{
    use RefreshDatabase;

    private function createSampleProduct(): Product
    {
        $category = Category::create([
            'name'        => 'Electronics',
            'slug'        => 'electronics',
            'description' => 'Gadgets',
            'status'      => 'active',
        ]);

        return Product::create([
            'category_id'    => $category->id,
            'name'           => 'Wireless Mouse',
            'slug'           => 'wireless-mouse',
            'sku'            => 'ELEC-999',
            'price'          => 499.00,
            'stock_quantity' => 10,
            'status'         => 'active',
        ]);
    }

    public function test_same_idempotency_key_while_in_progress_returns_409_conflict(): void
    {
        $product = $this->createSampleProduct();

        $key = 'concurrent-test-key-1';
        $payload = [
            'customer_name'    => 'John Doe',
            'customer_email'   => 'john@example.com',
            'shipping_address' => [
                'street'      => '123 Tech Park',
                'city'        => 'Bengaluru',
                'state'       => 'Karnataka',
                'postal_code' => '560100',
                'country'     => 'India',
            ],
            'items' => [
                ['product_id' => $product->id, 'quantity' => 1],
            ],
        ];

        // Simulate a running request by manually setting in_progress in Cache
        $payloadHash = hash('sha256', json_encode(tap($payload, fn(&$p) => ksort($p))));
        Cache::put("idempotency:{$key}", [
            'status'       => 'in_progress',
            'payload_hash' => $payloadHash,
        ], now()->addMinutes(1));

        // Attempt concurrent request with the same key
        $response = $this->withHeader('Idempotency-Key', $key)
            ->postJson('/api/orders', $payload);

        $response->assertStatus(409)
            ->assertJson([
                'success' => false,
                'message' => 'A request with this Idempotency-Key is currently being processed. Please wait and retry.',
            ]);
    }

    public function test_same_idempotency_key_with_different_payload_returns_422_unprocessable(): void
    {
        $product = $this->createSampleProduct();

        $key = 'tampered-payload-key-1';
        $originalPayload = [
            'customer_name'    => 'John Doe',
            'customer_email'   => 'john@example.com',
            'shipping_address' => [
                'street'      => '123 Tech Park',
                'city'        => 'Bengaluru',
                'state'       => 'Karnataka',
                'postal_code' => '560100',
                'country'     => 'India',
            ],
            'items' => [
                ['product_id' => $product->id, 'quantity' => 1],
            ],
        ];

        // 1. Submit the first valid order
        $firstResponse = $this->withHeader('Idempotency-Key', $key)
            ->postJson('/api/orders', $originalPayload);
        $firstResponse->assertStatus(201);

        // 2. Client retries with the SAME key but a DIFFERENT payload (e.g., changed quantity to 2)
        $differentPayload = $originalPayload;
        $differentPayload['items'][0]['quantity'] = 2;

        $retryResponse = $this->withHeader('Idempotency-Key', $key)
            ->postJson('/api/orders', $differentPayload);

        $retryResponse->assertStatus(422)
            ->assertJson([
                'success' => false,
                'message' => 'Idempotency-Key has already been used with a different request payload.',
            ]);
    }

    public function test_same_idempotency_key_with_identical_payload_replays_cached_response_without_duplicate_order(): void
    {
        $product = $this->createSampleProduct();

        $key = 'replay-key-1';
        $payload = [
            'customer_name'    => 'Sarah Connor',
            'customer_email'   => 'sarah@example.com',
            'shipping_address' => [
                'street'      => '789 Cyberdyne Way',
                'city'        => 'Hyderabad',
                'state'       => 'Telangana',
                'postal_code' => '500001',
                'country'     => 'India',
            ],
            'items' => [
                ['product_id' => $product->id, 'quantity' => 2],
            ],
        ];

        // 1. First request places the order
        $firstResponse = $this->withHeader('Idempotency-Key', $key)
            ->postJson('/api/orders', $payload);

        $firstResponse->assertStatus(201);
        $orderNumber = $firstResponse->json('data.order_number');

        // Stock should be 10 - 2 = 8
        $this->assertEquals(8, $product->fresh()->stock_quantity);
        $this->assertEquals(1, Order::where('customer_email', 'sarah@example.com')->count());

        // 2. Retry with the SAME key and SAME payload
        $secondResponse = $this->withHeader('Idempotency-Key', $key)
            ->postJson('/api/orders', $payload);

        $secondResponse->assertStatus(201);
        $secondResponse->assertHeader('X-Idempotent-Replay', 'true');
        $this->assertEquals($orderNumber, $secondResponse->json('data.order_number'));

        // Stock must STILL be 8 (NOT deducted again) and order count must STILL be 1
        $this->assertEquals(8, $product->fresh()->stock_quantity);
        $this->assertEquals(1, Order::where('customer_email', 'sarah@example.com')->count());
    }
}
