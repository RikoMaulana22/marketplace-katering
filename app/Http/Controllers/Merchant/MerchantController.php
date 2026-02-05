<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Merchant;
use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    public function dashboard()
    {
        $merchant = Auth::user()->merchant;

        if (!$merchant) {
            return redirect()->route('merchant.profile.create');
        }

        $merchantId = $merchant->id;
        $stats = [
            'total_revenue' => Order::where('merchant_id', $merchantId)->where('status', 'delivered')->sum('total_price'),
            'pending_orders' => Order::where('merchant_id', $merchantId)->where('status', 'pending')->count(),
            'orders_today' => Order::where('merchant_id', $merchantId)->whereDate('created_at', now())->count(),
        ];

        return view('merchant.dashboard', compact('stats'));
    }

    public function createProfile()
    {
        // Cek apakah user sudah punya merchant
        $merchant = Auth::user()->merchant;

        // Kirim variabel merchant ke view (walaupun null)
        return view('merchant.profile_create', compact('merchant'));
    }

    public function storeProfile(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'address' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Merchant::create([
            'user_id' => Auth::id(),
            'company_name' => $request->company_name,
            'contact' => $request->contact,
            'address' => $request->address,
            'description' => $request->description,
        ]);

        return redirect()->route('merchant.dashboard')->with('success', 'Profil katering berjaya dibina!');
    }

    public function editProfile()
    {
        $merchant = Auth::user()->merchant;
        return view('merchant.profile', compact('merchant'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'address' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $merchant = Auth::user()->merchant;
        $merchant->update($request->all());

        return back()->with('success', 'Profil berjaya dikemas kini!');
    }
}