<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Electronics',
                'description' => 'Gadgets, devices and electronic accessories',
                'products'    => [
                    ['name' => 'Wireless Bluetooth Headphones', 'price' => 2499.00, 'stock' => 50, 'sku' => 'ELEC-001'],
                    ['name' => 'USB-C Fast Charger 65W',        'price' => 899.00,  'stock' => 120, 'sku' => 'ELEC-002'],
                    ['name' => 'Mechanical Gaming Keyboard',    'price' => 3299.00, 'stock' => 30, 'sku' => 'ELEC-003'],
                    ['name' => 'Portable Power Bank 20000mAh',  'price' => 1799.00, 'stock' => 75, 'sku' => 'ELEC-004'],
                    ['name' => '27-inch 4K Monitor',            'price' => 28999.00,'stock' => 15, 'sku' => 'ELEC-005'],
                ],
            ],
            [
                'name'        => 'Clothing',
                'description' => 'Men\'s and women\'s apparel and accessories',
                'products'    => [
                    ['name' => 'Classic Cotton T-Shirt',        'price' => 499.00,  'stock' => 200, 'sku' => 'CLTH-001'],
                    ['name' => 'Slim Fit Denim Jeans',          'price' => 1299.00, 'stock' => 80,  'sku' => 'CLTH-002'],
                    ['name' => 'Hooded Sweatshirt',             'price' => 899.00,  'stock' => 60,  'sku' => 'CLTH-003'],
                    ['name' => 'Sports Running Shoes',          'price' => 2799.00, 'stock' => 40,  'sku' => 'CLTH-004'],
                ],
            ],
            [
                'name'        => 'Books',
                'description' => 'Programming, business, and self-development books',
                'products'    => [
                    ['name' => 'Clean Code by Robert Martin',   'price' => 699.00,  'stock' => 100, 'sku' => 'BOOK-001'],
                    ['name' => 'Laravel: Up & Running',         'price' => 849.00,  'stock' => 55,  'sku' => 'BOOK-002'],
                    ['name' => 'Design Patterns',               'price' => 749.00,  'stock' => 45,  'sku' => 'BOOK-003'],
                    ['name' => 'The Pragmatic Programmer',      'price' => 799.00,  'stock' => 70,  'sku' => 'BOOK-004'],
                ],
            ],
            [
                'name'        => 'Home & Kitchen',
                'description' => 'Home appliances, cookware and décor',
                'products'    => [
                    ['name' => 'Stainless Steel Water Bottle',  'price' => 599.00,  'stock' => 150, 'sku' => 'HOME-001'],
                    ['name' => 'Non-stick Frying Pan Set',      'price' => 1499.00, 'stock' => 35,  'sku' => 'HOME-002'],
                    ['name' => 'Air Purifier HEPA Filter',      'price' => 8999.00, 'stock' => 20,  'sku' => 'HOME-003'],
                    ['name' => 'LED Desk Lamp with USB Port',   'price' => 1199.00, 'stock' => 60,  'sku' => 'HOME-004'],
                ],
            ],
        ];

        foreach ($categories as $catData) {
            $category = Category::create([
                'name'        => $catData['name'],
                'slug'        => Str::slug($catData['name']),
                'description' => $catData['description'],
                'is_active'   => true,
            ]);

            foreach ($catData['products'] as $productData) {
                Product::create([
                    'category_id'       => $category->id,
                    'name'              => $productData['name'],
                    'slug'              => Str::slug($productData['name']),
                    'sku'               => $productData['sku'],
                    'description'       => "High quality {$productData['name']}. Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
                    'price'             => $productData['price'],
                    'stock_quantity'    => $productData['stock'],
                    'low_stock_threshold' => 5,
                    'status'            => 'active',
                ]);
            }
        }

        $this->command->info('✅ Inventory seeded: 4 categories, 17 products.');
    }
}
