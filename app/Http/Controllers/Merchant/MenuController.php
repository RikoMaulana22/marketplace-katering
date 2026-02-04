<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::where('merchant_id', auth()->user()->merchant->id)->get();
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
            'description' => 'required',
            'price' => 'required|numeric',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $photoPath = $request->file('photo')->store('menus', 'public');

        Menu::create([
            'merchant_id' => auth()->user()->merchant->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
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
}