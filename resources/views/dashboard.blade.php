<x-app-layout>


    <div class="p-6 text-gray-900">
        <h3 class="font-bold text-lg mb-4">Selamat Datang, {{ Auth::user()->name }}!</h3>

        @if(Auth::user()->role == 'merchant')
            <div class="bg-blue-100 p-4 rounded">
                <p class="mb-2">Anda login sebagai **Merchant (Katering)**.</p>
                <a href="{{ route('merchant.menu.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Kelola
                    Menu</a>
                <a href="{{ route('merchant.orders.index') }}" class="bg-green-500 text-white px-4 py-2 rounded">Lihat
                    Pesanan Masuk</a>
            </div>
        @else
            <div class="bg-purple-100 p-4 rounded">
                <p class="mb-2">Anda login sebagai **Customer (Kantor)**.</p>
                <a href="{{ route('customer.explore') }}" class="bg-purple-500 text-white px-4 py-2 rounded">Cari Makan
                    Siang</a>
                <a href="{{ route('customer.orders') }}" class="bg-indigo-500 text-white px-4 py-2 rounded">Riwayat Pesanan
                    Saya</a>
                <a href="{{ route('customer.settings') }}" class="bg-gray-800 text-white px-4 py-2 rounded">Set Alamat
                    Kantor</a>
            </div>
        @endif
    </div>
</x-app-layout>