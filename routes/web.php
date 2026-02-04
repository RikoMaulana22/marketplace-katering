<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Merchant\MenuController;
use App\Http\Controllers\Customer\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- PORTAL MERCHANT ---
Route::middleware(['auth', 'role:merchant'])->prefix('merchant')->name('merchant.')->group(function () {
    Route::resource('menu', MenuController::class);
    
    // Perbaikan: Pastikan nama route konsisten dengan MenuController
    Route::get('/orders', [MenuController::class, 'orders'])->name('orders.index');
    Route::get('/orders/{id}', [MenuController::class, 'showOrder'])->name('orders.show');
    Route::patch('/orders/{id}/status', [MenuController::class, 'updateStatus'])->name('orders.updateStatus');
});

// --- PORTAL CUSTOMER ---
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    // Perbaikan: Hapus duplikasi route explore
    Route::get('/explore', [OrderController::class, 'index'])->name('explore');
    
    // Perbaikan: Gunakan satu nama route yang konsisten untuk checkout
    Route::get('/checkout/{menuId}', [OrderController::class, 'checkoutForm'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'storeOrder'])->name('checkout.store');

    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders');
    Route::get('/my-orders/{id}', [OrderController::class, 'showInvoice'])->name('orders.invoice');
});

require __DIR__ . '/auth.php';