<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ── Home ─────────────────────────────────────────────────────────────────────
Route::get('/', function () {
    return redirect()->route('browse');
});

// ── Product Browse (public) ───────────────────────────────────────────────────
Route::get('/browse', [BrowseController::class, 'index'])->name('browse');

// ── Shopping Cart & Checkout ──────────────────────────────────────────────────
Route::get('/cart',                [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/checkout',      [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart/success/{order}', [CartController::class, 'success'])->name('cart.success');

// ── Guest-only Auth Routes ────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login',   [LoginController::class, 'login'])->name('login.post');

    Route::get('/register',  [RegisterController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

// ── Logout (authenticated) ────────────────────────────────────────────────────
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ── Admin Routes ──────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::get('/orders',    [AdminDashboard::class, 'orders'])->name('orders');
        Route::patch('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
    });

// ── Customer Routes ───────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {
        Route::get('/dashboard', [CustomerDashboard::class, 'index'])->name('dashboard');
    });
