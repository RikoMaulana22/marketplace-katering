<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Tambahkan DB Transaction untuk keamanan data

class OrderController extends Controller
{
    /**
     * Halaman Explore: Mencari Menu Katering
     */
    public function index(Request $request)
    {
        // Optimasi: Gunakan withCount atau Eager Loading untuk menghindari N+1 query
        $query = Menu::with('merchant')->where('is_available', true); // Hanya tampilkan yang tersedia

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhereHas('merchant', function ($mq) use ($request) {
                        $mq->where('company_name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        if ($request->filled('location')) {
            $query->whereHas('merchant', function ($q) use ($request) {
                $q->where('address', 'like', '%' . $request->location . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Gunakan pagination jika data sudah banyak agar tidak berat
        $menus = $query->latest()->paginate(12);

        return view('customer.explore', compact('menus'));
    }

    /**
     * Menampilkan Form Checkout
     */
    public function checkoutForm($id)
    {
        $user = auth()->user();

        // Kirim menu_id ke halaman setting agar bisa kembali lagi ke sini
        if (empty($user->address) || empty($user->phone)) {
            return redirect()->route('customer.settings', ['menu_id' => $id])
                ->with('info', 'Lengkapi alamat dulu ya!');
        }

        $menu = \App\Models\Menu::findOrFail($id);
        return view('customer.checkout', compact('menu'));
    }

    /**
     * Memproses Penyimpanan Pesanan (Checkout)
     */
    public function storeOrder(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'delivery_date' => 'required|date|after:today',
            'notes' => 'nullable|string|max:500',
        ], [
            'delivery_date.after' => 'Tanggal pengiriman minimal harus satu hari setelah hari ini.'
        ]);

        $user = Auth::user();

        if (empty($user->address)) {
            return redirect()->route('customer.settings')->with('error', 'Alamat pengiriman belum diatur.');
        }

        $menu = Menu::findOrFail($request->menu_id);
        $totalPrice = $menu->price * $request->quantity;

        // Gunakan Database Transaction agar jika satu proses gagal, data tidak "setengah jadi"
        return DB::transaction(function () use ($request, $user, $menu, $totalPrice) {

            // 1. Simpan Header Pesanan
            $order = Order::create([
                'customer_id' => $user->id,
                'merchant_id' => $menu->merchant_id,
                'delivery_date' => $request->delivery_date,
                'total_price' => $totalPrice,
                'notes' => $request->notes,
                'status' => 'pending'
            ]);

            // 2. Simpan Detail Item
            $order->items()->create([ // Menggunakan relasi model agar lebih clean
                'menu_id' => $menu->id,
                'quantity' => $request->quantity,
                'price_at_purchase' => $menu->price
            ]);

            return redirect()->route('orders.invoice', $order->id)
                ->with('success', 'Pesanan berhasil dibuat! Merchant akan segera memverifikasi pesanan Anda.');
        });
    }

    /**
     * Menampilkan Invoice
     */
    public function showInvoice($id)
    {
        // Eager loading relasi yang dibutuhkan saja
        $order = Order::with(['items.menu', 'merchant', 'customer'])->findOrFail($id);
        $user = Auth::user();

        // Cek Akses menggunakan Policy atau logic manual yang lebih ketat
        $isCustomerOwner = ($user->role === 'customer' && $order->customer_id === $user->id);

        // Perbaikan logic merchant agar lebih robust
        $isMerchantOwner = ($user->role === 'merchant' && $user->merchant && $order->merchant_id === $user->merchant->id);

        if (!$isCustomerOwner && !$isMerchantOwner) {
            abort(403, 'Anda tidak memiliki izin untuk melihat invoice ini.');
        }

        return view('orders.invoice', compact('order'));
    }

    /**
     * Melihat Daftar Pesanan Saya (Customer)
     */
    public function myOrders()
    {
        $orders = Order::with(['items.menu', 'merchant'])
            ->where('customer_id', Auth::id())
            ->latest()
            ->paginate(10); // Gunakan paginate daripada get() untuk performa

        return view('customer.index', compact('orders'));
    }

    /**
     * Memperbarui Status Pesanan (Merchant)
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,delivered,cancelled'
        ]);

        // Pastikan merchant hanya bisa edit pesanannya sendiri
        if (!Auth::user()->merchant || Auth::user()->merchant->id !== $order->merchant_id) {
            abort(403, 'Anda tidak diizinkan mengubah status pesanan ini.');
        }

        $order->update(['status' => $request->status]);

        return back()->with('success', "Status pesanan #{$order->id} berhasil diperbarui.");
    }
}