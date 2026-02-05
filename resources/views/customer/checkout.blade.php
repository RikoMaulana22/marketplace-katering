<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-extrabold text-indigo-950 tracking-tight">
                        🛒 Konfirmasi Pesanan
                    </h2>
                    <p class="text-gray-500 mt-1 font-medium">Tinjau kembali pilihan menu Anda sebelum memesan.</p>
                </div>
                <a href="{{ route('customer.explore') }}"
                    class="text-sm font-bold text-gray-400 hover:text-indigo-600 transition-colors uppercase tracking-widest flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Batal
                </a>
            </div>

            <div
                class="bg-white overflow-hidden shadow-xl shadow-indigo-100/50 rounded-[2.5rem] border border-gray-100">
                <div class="p-8 md:p-10">

                    <div
                        class="flex flex-col md:flex-row gap-6 p-6 bg-indigo-50/50 rounded-[2rem] border border-indigo-100 mb-8">
                        <div class="w-full md:w-40 h-32 flex-shrink-0">
                            @if($menu->photo)
                                <img src="{{ asset('storage/' . $menu->photo) }}"
                                    class="w-full h-full object-cover rounded-2xl shadow-sm">
                            @else
                                <div
                                    class="w-full h-full bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-300">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <span
                                class="px-3 py-1 bg-white text-indigo-600 text-[10px] font-black uppercase tracking-widest rounded-full shadow-sm mb-2 inline-block">
                                {{ $menu->category ?? 'Menu' }}
                            </span>
                            <h3 class="text-2xl font-black text-indigo-950 leading-tight">{{ $menu->name }}</h3>
                            <p class="text-indigo-600 font-bold text-sm mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                                </svg>
                                {{ $menu->merchant->company_name ?? 'Katering Terpercaya' }}
                            </p>
                            <div class="mt-4 flex items-baseline gap-1">
                                <span class="text-sm font-bold text-gray-400">Rp</span>
                                <span
                                    class="text-2xl font-black text-emerald-600">{{ number_format($menu->price, 0, ',', '.') }}</span>
                                <span class="text-xs font-medium text-gray-400">/ porsi</span>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('customer.checkout.store') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="quantity" :value="__('Jumlah Pesanan')"
                                    class="text-indigo-950 font-bold ml-1" />
                                <div class="relative mt-2 flex items-center">
                                    <input type="number" id="quantity" name="quantity" min="1" value="1" required
                                        class="block w-full bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 rounded-2xl py-4 px-6 font-black text-indigo-950 text-lg transition-all"
                                        onchange="updateTotal(this.value)">
                                    <span
                                        class="absolute right-6 text-gray-400 font-bold pointer-events-none">Porsi</span>
                                </div>
                            </div>

                            <div>
                                <x-input-label for="delivery_date" :value="__('Tanggal Pengiriman')"
                                    class="text-indigo-950 font-bold ml-1" />
                                <input type="date" id="delivery_date" name="delivery_date" required
                                    class="mt-2 block w-full bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 rounded-2xl py-4 px-6 font-bold text-gray-700 transition-all">
                            </div>
                        </div>

                        <div class="border-t border-dashed border-gray-200 pt-8 mt-8">
                            <div class="flex justify-between items-center mb-6">
                                <span class="text-gray-500 font-medium text-lg">Estimasi Total Bayar</span>
                                <div class="text-right">
                                    <span class="text-3xl font-black text-indigo-950" id="display-total">
                                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <x-primary-button
                                    class="w-full justify-center py-5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold text-xl shadow-xl shadow-indigo-100 transition-all transform active:scale-[0.98]">
                                    🚀 Konfirmasi & Pesan
                                </x-primary-button>

                                <div class="grid grid-cols-2 gap-4">
                                    <a href="{{ route('customer.explore') }}"
                                        class="flex items-center justify-center py-4 px-6 bg-white border-2 border-gray-100 text-gray-500 rounded-2xl font-bold text-sm hover:bg-gray-50 transition-all">
                                        Cari Menu Lain
                                    </a>
                                    <a href="https://wa.me/{{ $menu->merchant->phone ?? '' }}" target="_blank"
                                        class="flex items-center justify-center py-4 px-6 bg-emerald-50 text-emerald-600 rounded-2xl font-bold text-sm hover:bg-emerald-100 transition-all gap-2">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.937 3.672 1.433 5.66 1.433h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                        </svg>
                                        Chat Penjual
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="mt-8 flex items-center justify-center gap-6 text-gray-400">
                    <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Secure Payment
                    </div>
                    <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Instant Order
                    </div>
                </div>
            </div>
        </div>

        <script>
            const unitPrice = {{ $menu->price }};
            function updateTotal(quantity) {
                const total = quantity * unitPrice;
                const formatted = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(total);
                document.getElementById('display-total').innerText = formatted.replace('IDR', 'Rp');
            }
        </script>
</x-app-layout>