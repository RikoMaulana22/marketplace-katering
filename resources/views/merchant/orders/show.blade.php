<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <a href="{{ route('merchant.orders.index') }}" class="text-indigo-600 font-bold text-sm flex items-center hover:underline mb-2">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Kembali ke Daftar Pesanan
                    </a>
                    <h2 class="text-3xl font-extrabold text-indigo-950 tracking-tight">Rincian Pesanan <span class="text-indigo-500">#{{ $order->id }}</span></h2>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('orders.invoice', $order->id) }}" target="_blank"
                        class="inline-flex items-center px-6 py-3 bg-white border border-gray-200 text-gray-700 rounded-2xl font-bold text-sm shadow-sm hover:bg-gray-50 transition-all">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4"/></svg>
                        Cetak Invoice
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white rounded-[2rem] shadow-xl shadow-indigo-100/50 border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                            <h3 class="font-bold text-indigo-950">Daftar Menu & Porsi</h3>
                        </div>
                        <div class="divide-y divide-gray-50">
                            @foreach($order->items as $item)
                            <div class="p-6 flex items-center justify-between group hover:bg-indigo-50/30 transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 font-black">
                                        {{ $item->quantity }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-indigo-950 text-lg">{{ $item->menu->name }}</p>
                                        <p class="text-sm text-gray-400 font-medium">Harga Satuan: Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-black text-indigo-600">Rp {{ number_format($item->price_at_purchase * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="p-8 bg-indigo-950 text-white flex justify-between items-center">
                            <span class="text-indigo-300 font-bold uppercase tracking-widest text-xs">Total Pendapatan</span>
                            <span class="text-3xl font-black">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-[2rem] shadow-lg shadow-indigo-100/50 border border-gray-100">
                        <h3 class="font-bold text-indigo-950 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                            Instruksi Khusus / Catatan
                        </h3>
                        <div class="bg-gray-50 p-6 rounded-2xl text-gray-600 italic leading-relaxed border-l-4 border-indigo-400">
                            "{{ $order->notes ?? 'Tidak ada catatan tambahan dari pemesan.' }}"
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white p-8 rounded-[2rem] shadow-lg shadow-indigo-100/50 border border-gray-100 text-center">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Status Pesanan Saat Ini</p>
                        <div class="inline-block px-6 py-2 rounded-full font-black text-sm uppercase mb-6
                            {{ $order->status == 'pending' ? 'bg-amber-100 text-amber-600' : '' }}
                            {{ $order->status == 'confirmed' ? 'bg-indigo-100 text-indigo-600' : '' }}
                            {{ $order->status == 'delivered' ? 'bg-green-100 text-green-600' : '' }}
                            {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-600' : '' }}">
                            {{ $order->status }}
                        </div>
                        
                        <form action="{{ route('merchant.orders.updateStatus', $order->id) }}" method="POST" class="border-t border-gray-50 pt-6">
                            @csrf
                            @method('PATCH')
                            <label class="block text-xs font-bold text-gray-500 text-left mb-2 ml-1">Update Status:</label>
                            <select name="status" onchange="this.form.submit()" class="w-full rounded-xl border-gray-200 focus:ring-indigo-500 focus:border-indigo-500 font-bold text-gray-700">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Menunggu</option>
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>✅ Diterima</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>🚚 Dikirim</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Dibatalkan</option>
                            </select>
                        </form>
                    </div>

                    <div class="bg-white p-8 rounded-[2rem] shadow-lg shadow-indigo-100/50 border border-gray-100">
                        <h3 class="font-bold text-indigo-950 mb-6 border-b border-gray-50 pb-4">Informasi Pemesan</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Nama Kantor/Admin</p>
                                <p class="font-bold text-indigo-950">{{ $order->customer->name }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Kontak Email</p>
                                <p class="font-medium text-gray-600 underline">{{ $order->customer->email }}</p>
                            </div>
                            <div class="pt-4 mt-4 border-t border-gray-50">
                                <p class="text-[10px] font-bold text-indigo-400 uppercase">Jadwal Pengiriman</p>
                                <p class="text-xl font-black text-indigo-600">{{ \Carbon\Carbon::parse($order->delivery_date)->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>