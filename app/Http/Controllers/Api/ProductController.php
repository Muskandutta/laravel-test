<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;

    /**
     * GET /api/products
     * Browse products with search, category filter, stock filter, sort & pagination.
     *
     * Query params:
     *   - search        : string  — search by name, description, sku
     *   - category_id   : int     — filter by category
     *   - in_stock      : bool    — only show in-stock products
     *   - sort_by       : string  — name|price|created_at (default: name)
     *   - sort_dir      : string  — asc|desc (default: asc)
     *   - per_page      : int     — items per page (default: 15, max: 100)
     */
    public function index(Request $request): JsonResponse
    {
        $query = Product::with('category')
            ->active();

        // Search
        if ($search = $request->query('search')) {
            $query->search($search);
        }

        // Category filter
        if ($categoryId = $request->query('category_id')) {
            $query->where('category_id', $categoryId);
        }

        // Stock filter
        if (filter_var($request->query('in_stock'), FILTER_VALIDATE_BOOLEAN)) {
            $query->inStock();
        }

        // Sorting
        $sortBy  = in_array($request->query('sort_by'), ['name', 'price', 'created_at'])
            ? $request->query('sort_by')
            : 'name';
        $sortDir = $request->query('sort_dir', 'asc') === 'desc' ? 'desc' : 'asc';
        $query->orderBy($sortBy, $sortDir);

        // Pagination
        $perPage = min((int) $request->query('per_page', 15), 100);
        $products = $query->paginate($perPage);

        return $this->success(
            ProductResource::collection($products),
            'Products retrieved successfully.',
            200,
            [
                'current_page' => $products->currentPage(),
                'last_page'    => $products->lastPage(),
                'per_page'     => $products->perPage(),
                'total'        => $products->total(),
            ]
        );
    }

    /**
     * GET /api/products/{id}
     * Get full product details.
     */
    public function show(int $id): JsonResponse
    {
        $product = Product::with('category')
            ->active()
            ->find($id);

        if (! $product) {
            return $this->notFound('Product not found.');
        }

        return $this->success(
            new ProductResource($product),
            'Product retrieved successfully.'
        );
    }
}
