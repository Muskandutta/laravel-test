<?php

namespace App\Services;

use App\Models\Product;

class InventoryService
{
    /**
     * Assert that there is sufficient stock for the requested quantity.
     *
     * @throws \Exception
     */
    public function assertSufficientStock(Product $product, int $quantity): void
    {
        if ($product->stock_quantity < $quantity) {
            throw new \Exception(
                "Insufficient stock for '{$product->name}'. " .
                "Available: {$product->stock_quantity}, Requested: {$quantity}."
            );
        }
    }

    /**
     * Deduct stock after a successful order.
     */
    public function deductStock(Product $product, int $quantity): void
    {
        $newQty = $product->stock_quantity - $quantity;

        $product->update([
            'stock_quantity' => $newQty,
            'status'         => $newQty === 0 ? 'out_of_stock' : $product->status,
        ]);
    }

    /**
     * Restore stock when an order is cancelled.
     */
    public function restoreStock(Product $product, int $quantity): void
    {
        $newQty = $product->stock_quantity + $quantity;

        $product->update([
            'stock_quantity' => $newQty,
            // Re-activate if it was out_of_stock due to this order
            'status' => $product->status === 'out_of_stock' ? 'active' : $product->status,
        ]);
    }
}
