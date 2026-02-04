<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $query = Menu::with('merchant');

        // Fitur Pencarian berdasarkan nama menu atau nama katering
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('merchant', function ($merchantQuery) use ($searchTerm) {
                        $merchantQuery->where('company_name', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        $menus = $query->latest()->get();
        return view('customer.explore', compact('menus'));
    }

    // Method untuk melihat Invoice Detail
    public function showInvoice($id)
    {
        $order = Order::with(['merchant', 'items.menu'])
            ->where('customer_id', Auth::id())
            ->findOrFail($id);

        return view('customer.invoice', compact('order'));
    }
    // Method untuk menampilkan form (Langkah 5.4 bagian 1)
    public function checkoutForm($menuId)
    {
        $menu = Menu::with('merchant')->findOrFail($menuId);
        return view('customer.checkout', compact('menu'));
    }

    // Method untuk memproses data (Langkah 5.4 bagian 2)
    public function storeOrder(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'delivery_date' => 'required|date|after:today',
        ]);

        $menu = Menu::findOrFail($request->menu_id);
        $totalPrice = $menu->price * $request->quantity;

        // 1. Simpan ke tabel Orders
        $order = Order::create([
            'customer_id' => Auth::id(),
            'merchant_id' => $menu->merchant_id,
            'delivery_date' => $request->delivery_date,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        // 2. Simpan ke tabel OrderItems
        OrderItem::create([
            'order_id' => $order->id,
            'menu_id' => $menu->id,
            'quantity' => $request->quantity,
            'price_at_purchase' => $menu->price
        ]);

        return redirect()->route('customer.orders')->with('success', 'Pesanan berhasil dibuat!');
    }



    // Tambahan: Method untuk melihat daftar pesanan saya
    // app/Http/Controllers/Customer/OrderController.php
    public function myOrders()
    {
        $orders = Order::where('customer_id', auth()->id())->latest()->get();

        // Pastikan path ini sesuai dengan letak file .blade.php Anda
        return view('customer.index', compact('orders'));
    }
}