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
            'address' => 'required|string|min:10',
        ]);

        $user = Auth::user();
        $user->update([
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('success', 'Alamat pengiriman berhasil diperbarui.');
    }
}