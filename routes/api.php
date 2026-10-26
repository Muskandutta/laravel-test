<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Inventory & Order Management API
|
| Base URL: /api
|
*/

// ── Health Check ─────────────────────────────────────────────────────────────
Route::get('/health', fn () => response()->json([
    'success' => true,
    'status'  => 'ok',
    'version' => '1.0.0',
    'time'    => now()->toISOString(),
]));

// ── Inventory (Public) ────────────────────────────────────────────────────────
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/',    [CategoryController::class, 'index'])->name('index');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('show');
});

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/',     [ProductController::class, 'index'])->name('index');
    Route::get('/{id}', [ProductController::class, 'show'])->name('show');
});

// ── Orders ────────────────────────────────────────────────────────────────────
Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('/',                       [OrderController::class, 'index'])->name('index');
    Route::post('/',                      [OrderController::class, 'store'])->middleware('idempotent')->name('store');
    Route::get('/{id}',                   [OrderController::class, 'show'])->name('show');
    Route::patch('/{id}/status',          [OrderController::class, 'updateStatus'])->name('update-status');
});
