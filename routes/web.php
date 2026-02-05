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

// Dashboard Utama (Redirect logic biasanya ada di dalam view atau controller dashboard ini)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- AKSES UMUM (Semua Role) ---
Route::middleware('auth')->group(function () {
    /**
     * Profil User Dasar (Keamanan: Email & Password)
     */
    Route::get('/account', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/account', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/account', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Invoice (Halaman cetak/unduh bukti pesanan)
     */
    Route::get('/orders/invoice/{id}', [OrderController::class, 'showInvoice'])->name('orders.invoice');
});

// --- PORTAL MERCHANT (KATERING) ---
Route::middleware(['auth', 'role:merchant'])
    ->prefix('merchant')
    ->name('merchant.')
    ->group(function () {

        Route::get('/dashboard', [MerchantController::class, 'dashboard'])->name('dashboard');

        /**
         * Perbaikan: Nama rute disesuaikan menjadi 'business.edit' 
         * agar sinkron dengan file navigasi Anda.
         */
        Route::get('/business-settings', [MerchantController::class, 'editProfile'])->name('business.edit');
        Route::put('/business-settings', [MerchantController::class, 'updateProfile'])->name('business.update');

        // Menu Management
        Route::resource('menu', MenuController::class);
        Route::post('/menu/{id}/toggle', [MenuController::class, 'toggleAvailability'])->name('menu.toggle');

        // Order Management
        Route::get('/orders', [MerchantController::class, 'orders'])->name('orders.index');
        Route::get('/orders/{id}', [MerchantController::class, 'showOrder'])->name('orders.show');
        Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });

// --- PORTAL CUSTOMER (KANTOR) ---
Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        /**
         * Alamat Pengiriman Kantor
         */
        Route::get('/shipping-address', [CustomerProfileController::class, 'edit'])->name('settings');
        Route::put('/shipping-address', [CustomerProfileController::class, 'update'])->name('settings.update');

        /**
         * Belanja & Transaksi
         */
        Route::get('/explore', [OrderController::class, 'index'])->name('explore');
        Route::get('/checkout/{menuId}', [OrderController::class, 'checkoutForm'])->name('checkout');
        Route::post('/checkout', [OrderController::class, 'storeOrder'])->name('checkout.store');

        /**
         * Manajemen Pesanan Saya
         */
        Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders');
        Route::get('/my-orders/{id}', [OrderController::class, 'showOrderDetail'])->name('orders.show'); // TAMBAHAN: Detail pesanan
        Route::delete('/my-orders/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel'); // TAMBAHAN: Batal pesanan
    });

require __DIR__ . '/auth.php';