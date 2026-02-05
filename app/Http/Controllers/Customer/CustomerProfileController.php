<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerProfileController extends Controller
{
    public function edit()
    {
        return view('customer.settings', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $user = auth()->user();
        $user->update([
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Jika ada menu_id, arahkan kembali ke checkout. Jika tidak, kembali ke profil.
        if ($request->has('menu_id')) {
            return redirect()->route('customer.checkout', $request->menu_id)
                ->with('success', 'Alamat disimpan! Silakan lanjutkan pesanan.');
        }

        return redirect()->route('customer.settings')->with('success', 'Alamat berhasil diperbarui!');
    }
}