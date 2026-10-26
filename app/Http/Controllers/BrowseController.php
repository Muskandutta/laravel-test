<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    /**
     * Show the product browse page.
     */
    public function index(Request $request)
    {
        $categories = Category::active()
            ->withCount(['products' => fn ($q) => $q->where('status', 'active')])
            ->orderBy('name')
            ->get();

        $query = Product::with('category')->active();

        if ($search = $request->query('search')) {
            $query->search($search);
        }

        if ($categoryId = $request->query('category_id')) {
            $query->where('category_id', $categoryId);
        }

        if ($request->query('in_stock')) {
            $query->inStock();
        }

        $sortBy  = in_array($request->query('sort_by'), ['name', 'price', 'created_at'])
            ? $request->query('sort_by') : 'name';
        $sortDir = $request->query('sort_dir', 'asc') === 'desc' ? 'desc' : 'asc';

        $products = $query->orderBy($sortBy, $sortDir)->paginate(12)->withQueryString();

        return view('browse', compact('products', 'categories'));
    }
}
