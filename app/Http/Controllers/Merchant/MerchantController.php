<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class MerchantController extends Controller
{
    // Dashboard Statistik Merchant
    public function dashboard()
    {
        $merchantId = auth()->user()->merchant->id;
        $stats = [
            'total_revenue' => Order::where('merchant_id', $merchantId)->where('status', 'delivered')->sum('total_price'),
            'pending_orders' => Order::where('merchant_id', $merchantId)->where('status', 'pending')->count(),
        ];
        return view('dashboard', compact('stats'));
    }

    // Halaman Edit Profil Bisnis
    public function editProfile()
    {
        $user = auth()->user();
        if ($user->role !== 'merchant') {
            return redirect()->route('dashboard')->with('error', 'Akses khusus untuk Merchant.');
        }

        $merchant = $user->merchant;
        return view('merchant.profile', compact('merchant'));
    }

    // Proses Update Profil Bisnis
    public function updateProfile(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $merchant = auth()->user()->merchant;
        if (!$merchant) {
            return back()->with('error', 'Data merchant tidak ditemukan.');
        }

        $merchant->update($request->only(['company_name', 'address', 'description']));
        return back()->with('success', 'Profil bisnis berhasil diperbarui!');
    }

    // --- TAMBAHAN: Menampilkan daftar pesanan masuk ---
    public function orders()
    {
        $merchantId = auth()->user()->merchant->id;
        $orders = Order::with(['customer', 'items.menu'])
            ->where('merchant_id', $merchantId)
            ->latest()
            ->get();

        return view('merchant.orders.index', compact('orders'));
    }

    // --- TAMBAHAN: Menampilkan detail satu pesanan ---
    public function showOrder($id)
    {
        $merchantId = auth()->user()->merchant->id;
        $order = Order::with(['customer', 'items.menu'])
            ->where('merchant_id', $merchantId)
            ->findOrFail($id);

        return view('merchant.orders.show', compact('order'));
    }
}