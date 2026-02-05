<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h2 class="text-3xl font-extrabold text-indigo-950 tracking-tight">
                        📋 Riwayat Pesanan Saya
                    </h2>
                    <p class="text-gray-500 mt-1 font-medium">Pantau status pengiriman dan unduh invoice pesanan kantor
                        Anda.</p>
                </div>
                <a href="{{ route('customer.explore') }}"
                    class="inline-flex items-center justify-center px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold shadow-xl shadow-indigo-100 transition-all transform active:scale-95">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Pesan Lagi
                </a>
            </div>

            @if(session('success'))
                <div
                    class="mb-8 p-4 bg-green-50 border border-green-200 rounded-2xl flex items-center text-green-700 font-bold shadow-sm animate-fade-in">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div
                class="bg-white overflow-hidden shadow-xl shadow-indigo-100/50 rounded-[2.5rem] border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100">
                                <th class="px-8 py-6 text-xs font-black text-indigo-900 uppercase tracking-widest">
                                    Detail Order</th>
                                <th class="px-8 py-6 text-xs font-black text-indigo-900 uppercase tracking-widest">
                                    Katering & Menu</th>
                                <th class="px-8 py-6 text-xs font-black text-indigo-900 uppercase tracking-widest">
                                    Jadwal Kirim</th>
                                <th class="px-8 py-6 text-xs font-black text-indigo-900 uppercase tracking-widest">Total
                                    Bayar</th>
                                <th
                                    class="px-8 py-6 text-xs font-black text-indigo-900 uppercase tracking-widest text-center">
                                    Status</th>
                                <th
                                    class="px-8 py-6 text-xs font-black text-indigo-900 uppercase tracking-widest text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($orders as $order)
                                <tr class="hover:bg-indigo-50/20 transition-colors group">
                                    <td class="px-8 py-6">
                                        <span
                                            class="text-sm font-black text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-lg">
                                            #{{ $order->id }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="font-bold text-indigo-950 text-base mb-1">
                                            {{ $order->merchant->company_name ?? 'Katering Terpilih' }}
                                        </div>
                                        <div class="space-y-1">
                                            @foreach($order->items as $item)
                                                <p class="text-xs text-gray-500 font-medium flex items-center">
                                                    <span class="w-1.5 h-1.5 bg-indigo-300 rounded-full mr-2"></span>
                                                    {{ $item->menu->name }} <span
                                                        class="ml-1 text-indigo-400">({{ $item->quantity }}x)</span>
                                                </p>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-gray-700">
                                                {{ \Carbon\Carbon::parse($order->delivery_date)->format('d M Y') }}
                                            </span>
                                            <span
                                                class="text-[10px] text-gray-400 uppercase font-bold tracking-tighter">Estimasi
                                                Siang Hari</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="text-base font-black text-indigo-950">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                                                'confirmed' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                                'delivered' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                                'cancelled' => 'bg-rose-100 text-rose-700 border-rose-200',
                                            ][$order->status] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-4 py-1.5 rounded-full text-[11px] font-black uppercase tracking-wider border {{ $statusClasses }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <a href="{{ route('orders.invoice', $order->id) }}" target="_blank"
                                            class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-xl font-bold text-xs shadow-sm hover:border-indigo-500 hover:text-indigo-600 transition-all group-hover:shadow-md">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Invoice
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-24 text-center">
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mb-6">
                                                <svg class="w-12 h-12 text-indigo-200" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                </svg>
                                            </div>
                                            <h3 class="text-xl font-black text-indigo-950">Belum Ada Pesanan</h3>
                                            <p class="text-gray-400 mt-2 max-w-xs mx-auto font-medium">Sepertinya Anda belum
                                                memesan makan siang hari ini. Mari jelajahi katering lezat di sekitar Anda!
                                            </p>
                                            <a href="{{ route('customer.explore') }}"
                                                class="mt-8 text-indigo-600 font-bold hover:underline flex items-center">
                                                Mulai Cari Katering
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-indigo-600 transition-colors uppercase tracking-widest">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>