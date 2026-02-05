<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{


    public function dashboard()
    {
        $merchant = auth()->user()->merchant;

        // JIKA MERCHANT KOSONG, LEMPAR KE HALAMAN LAIN (MISAL: FORM BUAT MERCHANT)
        if (!$merchant) {
            return redirect()->route('dashboard')->with('error', 'Profil merchant belum dibuat.');
        }

        $merchantId = $merchant->id;

        $stats = [
            'total_revenue' => Order::where('merchant_id', $merchantId)->where('status', 'delivered')->sum('total_price'),
            'pending_orders' => Order::where('merchant_id', $merchantId)->where('status', 'pending')->count(),
            'orders_today' => Order::where('merchant_id', $merchantId)->whereDate('created_at', now())->count(),
        ];

        return view('merchant.dashboard', compact('stats'));
    }
    public function index()
    {
        $user = auth()->user();
        $merchant = $user->merchant;

        // JIKA USER ADALAH MERCHANT TAPI BELUM ISI PROFIL TOKO
        if (!$merchant) {
            return redirect()->route('merchant.profile.create')
                ->with('error', 'Silakan buat profil toko Anda terlebih dahulu sebelum mengelola menu.');
        }

        $menus = Menu::where('merchant_id', $merchant->id)->get();
        return view('merchant.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('merchant.menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required',
            'price' => 'required|numeric|min:0',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle File Upload
        $photoPath = $request->file('photo')->store('menus', 'public');

        // Simpan ke Database
        Menu::create([
            'merchant_id' => auth()->user()->merchant->id,
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'photo' => $photoPath,
        ]);

        return redirect()->route('merchant.menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $menu = Menu::where('merchant_id', auth()->user()->merchant->id)->findOrFail($id);
        return view('merchant.menu.edit', compact('menu'));
    }

    public function update(Request $request, string $id)
    {
        $menu = Menu::where('merchant_id', auth()->user()->merchant->id)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada foto baru
            Storage::disk('public')->delete($menu->photo);
            $menu->photo = $request->file('photo')->store('menus', 'public');
        }

        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'photo' => $menu->photo,
        ]);

        return redirect()->route('merchant.menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $menu = Menu::where('merchant_id', auth()->user()->merchant->id)->findOrFail($id);

        // Hapus file fisik foto
        Storage::disk('public')->delete($menu->photo);
        $menu->delete();

        return redirect()->route('merchant.menu.index')->with('success', 'Menu berhasil dihapus!');
    }

    // Fungsi Pesanan
    public function orders()
    {
        $orders = Order::with(['customer', 'items.menu'])
            ->where('merchant_id', auth()->user()->merchant->id)
            ->latest()
            ->get();

        return view('merchant.orders.index', compact('orders'));
    }

    public function showOrder($id)
    {
        $order = Order::with(['customer', 'items.menu'])
            ->where('merchant_id', auth()->user()->merchant->id)
            ->findOrFail($id);

        return view('merchant.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::where('merchant_id', auth()->user()->merchant->id)->findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan diperbarui menjadi ' . $request->status);
    }

    public function toggleAvailability($id)
    {
        $menu = Menu::where('id', $id)->where('merchant_id', auth()->user()->merchant->id)->firstOrFail();
        $menu->update(['is_available' => !$menu->is_available]);

        return back()->with('success', 'Status ketersediaan menu diperbarui.');
    }
}