<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Merchant\MenuController;
use App\Http\Controllers\Merchant\MerchantController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\CustomerProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Auth::user()->role === 'merchant'
            ? redirect()->route('merchant.dashboard')
            : view('dashboard');
    })->name('dashboard');

    // Profil Akaun Umum
    Route::get('/account', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/account', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/account', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/orders/invoice/{id}', [OrderController::class, 'showInvoice'])->name('orders.invoice');
});

/// PORTAL MERCHANT
Route::middleware(['auth', 'role:merchant'])->prefix('merchant')->name('merchant.')->group(function () {
    Route::get('/dashboard', [MerchantController::class, 'dashboard'])->name('dashboard');

    // Profile & Business Settings
    // Kita buat namanya konsisten dengan yang dipanggil di Blade kamu
    Route::get('/profile/create', [MerchantController::class, 'createProfile'])->name('profile.create');
    Route::post('/profile/store', [MerchantController::class, 'storeProfile'])->name('profile.store');

    // Ini yang krusial: samakan name-nya menjadi 'business.update'
    Route::get('/business-settings', [MerchantController::class, 'editProfile'])->name('profile.edit');
    Route::put('/business-settings', [MerchantController::class, 'updateProfile'])->name('business.update');

    // Menu
    Route::resource('menu', MenuController::class);
    Route::patch('/menu/{id}/toggle', [MenuController::class, 'toggleAvailability'])->name('menu.toggle');

    // Orders
    Route::get('/orders', [MenuController::class, 'orders'])->name('orders.index');
    Route::get('/orders/{id}', [MenuController::class, 'showOrder'])->name('orders.show');
    Route::patch('/orders/{id}/status', [MenuController::class, 'updateStatus'])->name('orders.updateStatus');
});

// PORTAL CUSTOMER
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/explore', [OrderController::class, 'index'])->name('explore');
    Route::get('/checkout/{id}', [OrderController::class, 'checkoutForm'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'storeOrder'])->name('checkout.store');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders');
    Route::get('/my-orders/{id}', [OrderController::class, 'showOrderDetail'])->name('orders.show');

    Route::get('/settings', [CustomerProfileController::class, 'edit'])->name('settings');
    Route::put('/settings', [CustomerProfileController::class, 'update'])->name('settings.update');
});

require __DIR__ . '/auth.php';