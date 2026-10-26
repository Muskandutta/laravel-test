<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_cart_page_can_be_rendered(): void
    {
        $response = $this->get('/cart');
        $response->assertStatus(200);
        $response->assertSee('Review Cart', false);
        $response->assertSee('Submit Order', false);
    }

    public function test_user_can_submit_order_via_checkout(): void
    {
        $category = Category::create([
            'name'        => 'Electronics',
            'slug'        => 'electronics',
            'description' => 'Electronic items',
            'status'      => 'active',
        ]);

        $product = Product::create([
            'category_id'    => $category->id,
            'name'           => 'Wireless Headphones',
            'slug'           => 'wireless-headphones',
            'sku'            => 'TEST-001',
            'price'          => 499.00,
            'stock_quantity' => 10,
            'status'         => 'active',
        ]);

        $payload = [
            'customer_name'    => 'John Doe',
            'customer_email'   => 'john@example.com',
            'customer_phone'   => '9876543210',
            'notes'            => 'Deliver to reception',
            'shipping_address' => [
                'street'      => '123 Tech Park',
                'city'        => 'Bengaluru',
                'state'       => 'Karnataka',
                'postal_code' => '560100',
                'country'     => 'India',
            ],
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity'   => 2,
                ],
            ],
        ];

        $response = $this->postJson('/api/orders', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Order placed successfully.',
            ])
            ->assertJsonStructure([
                'data' => [
                    'order_number',
                    'customer' => ['name', 'email'],
                    'pricing'  => ['total'],
                    'status',
                ],
            ]);

        $this->assertDatabaseHas('orders', [
            'customer_email' => 'john@example.com',
            'customer_name'  => 'John Doe',
        ]);

        // Verify stock deducted: 10 - 2 = 8
        $this->assertEquals(8, $product->fresh()->stock_quantity);
    }

    public function test_order_receipt_page_displays_order_details(): void
    {
        $category = Category::create([
            'name'        => 'Books',
            'slug'        => 'books',
            'description' => 'Coding books',
            'status'      => 'active',
        ]);

        $product = Product::create([
            'category_id'    => $category->id,
            'name'           => 'Clean Code',
            'slug'           => 'clean-code',
            'sku'            => 'BOOK-999',
            'price'          => 250.00,
            'stock_quantity' => 20,
            'status'         => 'active',
        ]);

        $payload = [
            'customer_name'    => 'Alice Smith',
            'customer_email'   => 'alice@example.com',
            'shipping_address' => [
                'street'      => '456 Main St',
                'city'        => 'Mumbai',
                'state'       => 'Maharashtra',
                'postal_code' => '400001',
                'country'     => 'India',
            ],
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity'   => 1,
                ],
            ],
        ];

        $orderResponse = $this->postJson('/api/orders', $payload);
        $orderNumber = $orderResponse->json('data.order_number');

        $receiptResponse = $this->get("/cart/success/{$orderNumber}");
        $receiptResponse->assertStatus(200);
        $receiptResponse->assertSee($orderNumber);
        $receiptResponse->assertSee('Alice Smith');
    }
}
