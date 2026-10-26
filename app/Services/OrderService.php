<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderService
{
    public function __construct(
        private readonly InventoryService $inventoryService
    ) {}

    /**
     * Create a new order within a DB transaction.
     * Validates stock, deducts inventory, and persists the order.
     *
     * @throws \Exception
     */
    public function createOrder(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            // 1. Resolve products and validate stock
            $resolvedItems = $this->resolveAndValidateItems($data['items']);

            // 2. Calculate financials
            $subtotal       = $this->calculateSubtotal($resolvedItems);
            $tax            = round($subtotal * 0.18, 2); // 18% GST
            $shippingCharge = $subtotal >= 500 ? 0 : 49;  // Free shipping above ₹500
            $total          = $subtotal + $tax + $shippingCharge;

            // 3. Create the order
            $order = Order::create([
                'order_number'    => $this->generateOrderNumber(),
                'customer_name'   => $data['customer_name'],
                'customer_email'  => $data['customer_email'],
                'customer_phone'  => $data['customer_phone'] ?? null,
                'shipping_address' => $data['shipping_address'],
                'notes'           => $data['notes'] ?? null,
                'subtotal'        => $subtotal,
                'tax'             => $tax,
                'shipping_charge' => $shippingCharge,
                'total'           => $total,
                'status'          => Order::STATUS_PENDING,
            ]);

            // 4. Create order items and deduct stock
            foreach ($resolvedItems as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item['product']->id,
                    'product_name' => $item['product']->name,
                    'product_sku'  => $item['product']->sku,
                    'unit_price'   => $item['product']->price,
                    'quantity'     => $item['quantity'],
                    'total_price'  => round($item['product']->price * $item['quantity'], 2),
                ]);

                $this->inventoryService->deductStock($item['product'], $item['quantity']);
            }

            return $order->load('items.product');
        });
    }

    /**
     * Transition an order to a new status.
     *
     * @throws \Exception
     */
    public function updateStatus(Order $order, string $newStatus): Order
    {
        if (! $order->canTransitionTo($newStatus)) {
            throw new \Exception(
                "Cannot transition order from '{$order->status}' to '{$newStatus}'."
            );
        }

        $timestamps = [
            Order::STATUS_CONFIRMED  => 'confirmed_at',
            Order::STATUS_SHIPPED    => 'shipped_at',
            Order::STATUS_DELIVERED  => 'delivered_at',
            Order::STATUS_CANCELLED  => 'cancelled_at',
        ];

        $updateData = ['status' => $newStatus];

        if (isset($timestamps[$newStatus])) {
            $updateData[$timestamps[$newStatus]] = now();
        }

        // Restore stock if order is cancelled
        if ($newStatus === Order::STATUS_CANCELLED) {
            foreach ($order->items as $item) {
                $this->inventoryService->restoreStock($item->product, $item->quantity);
            }
        }

        $order->update($updateData);

        return $order->fresh('items.product');
    }

    /*
    |--------------------------------------------------------------------------
    | Private Helpers
    |--------------------------------------------------------------------------
    */

    private function resolveAndValidateItems(array $items): array
    {
        $resolved = [];

        foreach ($items as $item) {
            $product = Product::lockForUpdate()->findOrFail($item['product_id']);

            if ($product->status !== 'active') {
                throw new \Exception("Product '{$product->name}' is not available for purchase.");
            }

            $this->inventoryService->assertSufficientStock($product, $item['quantity']);

            $resolved[] = [
                'product'  => $product,
                'quantity' => $item['quantity'],
            ];
        }

        return $resolved;
    }

    private function calculateSubtotal(array $resolvedItems): float
    {
        return collect($resolvedItems)->sum(
            fn ($item) => $item['product']->price * $item['quantity']
        );
    }

    private function generateOrderNumber(): string
    {
        $date   = now()->format('Ymd');
        $random = strtoupper(Str::random(6));

        return "ORD-{$date}-{$random}";
    }
}
