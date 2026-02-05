<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-indigo-950 tracking-tight">📦 Pesanan Masuk</h2>
                    <p class="text-gray-500 mt-1 font-medium">Kelola dan pantau status pengiriman pesanan katering Anda.</p>
                </div>
                <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Pesanan</p>
                        <p class="text-xl font-black text-indigo-600">{{ $orders->count() }}</p>
                    </div>
                    <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl flex items-center text-green-700 font-bold shadow-sm animate-fade-in">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-[2rem] shadow-xl shadow-indigo-100/50 border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100">
                                <th class="px-8 py-5 text-xs font-bold text-gray-400 uppercase tracking-widest">ID & Pelanggan</th>
                                <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Jadwal Kirim</th>
                                <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Total Tagihan</th>
                                <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Status Pesanan</th>
                                <th class="px-8 py-5 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($orders as $order)
                                <tr class="hover:bg-indigo-50/30 transition-colors group">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="text-xs font-black text-indigo-500 bg-indigo-50 px-2 py-1 rounded-lg">#{{ $order->id }}</div>
                                            <div>
                                                <div class="font-bold text-indigo-950 group-hover:text-indigo-600 transition-colors">{{ $order->customer->name }}</div>
                                                <div class="text-xs text-gray-400 font-medium mt-0.5">Dipesan {{ $order->created_at->format('d M, H:i') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 text-center">
                                        <div class="inline-flex items-center px-3 py-1 bg-white border border-gray-100 rounded-xl shadow-sm">
                                            <span class="text-sm font-bold text-gray-700">{{ \Carbon\Carbon::parse($order->delivery_date)->format('d F Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 text-right">
                                        <span class="text-lg font-black text-indigo-600">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6 text-center">
                                        <form action="{{ route('merchant.orders.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" 
                                                class="text-xs font-bold rounded-xl border-gray-200 focus:ring-indigo-500 focus:border-indigo-500 transition-all cursor-pointer
                                                {{ $order->status == 'cancelled' ? 'bg-red-50 text-red-600' : '' }}
                                                {{ $order->status == 'delivered' ? 'bg-green-50 text-green-600' : '' }}
                                                {{ $order->status == 'pending' ? 'bg-amber-50 text-amber-600' : '' }}
                                                {{ $order->status == 'confirmed' ? 'bg-indigo-50 text-indigo-600' : '' }}">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Menunggu</option>
                                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>✅ Diterima</option>
                                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>🚚 Dikirim</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Dibatalkan</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('merchant.orders.show', $order->id) }}" 
                                               class="p-2.5 bg-gray-50 text-gray-500 hover:bg-indigo-600 hover:text-white rounded-xl transition-all shadow-sm" title="Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            <a href="{{ route('orders.invoice', $order->id) }}" target="_blank"
                                               class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-xl font-bold text-xs shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                Invoice
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-bold text-indigo-950">Belum Ada Pesanan</h3>
                                            <p class="text-gray-400 text-sm mt-1">Sabar ya, pesanan dari kantor akan muncul di sini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>