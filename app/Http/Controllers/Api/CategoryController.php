<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponse;

    /**
     * GET /api/categories
     * List all active categories.
     */
    public function index(Request $request): JsonResponse
    {
        $categories = Category::active()
            ->withCount(['products' => fn ($q) => $q->where('status', 'active')])
            ->orderBy('name')
            ->get();

        return $this->success(
            CategoryResource::collection($categories),
            'Categories retrieved successfully.'
        );
    }

    /**
     * GET /api/categories/{id}
     * Get a single category with its active products.
     */
    public function show(int $id): JsonResponse
    {
        $category = Category::active()
            ->withCount(['products' => fn ($q) => $q->where('status', 'active')])
            ->find($id);

        if (! $category) {
            return $this->notFound('Category not found.');
        }

        return $this->success(
            new CategoryResource($category),
            'Category retrieved successfully.'
        );
    }
}
