<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h2 class="text-4xl font-extrabold text-indigo-950 tracking-tight">
                        🍽️ Jelajah Katering
                    </h2>
                    <p class="text-gray-500 mt-2 font-medium text-lg">Temukan menu makan siang terbaik untuk kantor Anda hari ini.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors uppercase tracking-widest flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7"/></svg>
                    Kembali ke Dashboard
                </a>
            </div>

            <div class="bg-white p-6 rounded-[2rem] shadow-xl shadow-indigo-100/50 border border-gray-100 mb-12">
                <form action="{{ route('customer.explore') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-5 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <input type="text" name="search" placeholder="Cari ayam bakar, nasi kotak, atau nama katering..." 
                            value="{{ request('search') }}"
                            class="block w-full pl-12 pr-4 py-4 bg-gray-50 border-transparent focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent rounded-2xl text-sm font-medium transition-all">
                    </div>

                    <div class="md:col-span-2">
                        <select name="location" class="block w-full py-4 bg-gray-50 border-transparent focus:bg-white focus:ring-2 focus:ring-indigo-500 rounded-2xl text-sm font-bold text-gray-600">
                            <option value="">📍 Semua Lokasi</option>
                            <option value="Jakarta" {{ request('location') == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                            <option value="Bandung" {{ request('location') == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                            <option value="Surabaya" {{ request('location') == 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <select name="category" class="block w-full py-4 bg-gray-50 border-transparent focus:bg-white focus:ring-2 focus:ring-indigo-500 rounded-2xl text-sm font-bold text-gray-600">
                            <option value="">🍱 Semua Jenis</option>
                            <option value="Prasmanan" {{ request('category') == 'Prasmanan' ? 'selected' : '' }}>Prasmanan</option>
                            <option value="Nasi Kotak" {{ request('category') == 'Nasi Kotak' ? 'selected' : '' }}>Nasi Kotak</option>
                            <option value="Snack Box" {{ request('category') == 'Snack Box' ? 'selected' : '' }}>Snack Box</option>
                        </select>
                    </div>

                    <div class="md:col-span-3 flex gap-2">
                        <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-indigo-100 transition-all active:scale-95">
                            Cari Menu
                        </button>
                        @if(request()->anyFilled(['search', 'location', 'category']))
                            <a href="{{ route('customer.explore') }}" class="p-4 bg-red-50 text-red-500 rounded-2xl hover:bg-red-100 transition-colors" title="Bersihkan Filter">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($menus as $m)
                    <div class="group bg-white rounded-[2.5rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                        <div class="relative h-56 overflow-hidden">
                            @if($m->photo)
                                <img src="{{ asset('storage/' . $m->photo) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-indigo-50 flex items-center justify-center text-indigo-200">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                            
                            <div class="absolute top-4 left-4">
                                <span class="px-4 py-1.5 bg-white/90 backdrop-blur-md text-indigo-600 text-[10px] font-black uppercase tracking-widest rounded-full shadow-sm">
                                    {{ $m->category ?? 'Umum' }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-extrabold text-indigo-950 truncate mb-1" title="{{ $m->name }}">
                                {{ $m->name }}
                            </h3>
                            
                            <div class="flex items-center text-sm text-indigo-600 font-bold mb-3">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.162zM10 12.906l4 1.715c.222.099.444.121.617.121a1 1 0 00.712-1.414 1 1 0 00-.442-.42L10 11.186l-4.887 2.096a1 1 0 00-.442 1.414 1 1 0 00.712 1.414c.173 0 .395-.022.617-.121l4-1.715z"/></svg>
                                {{ $m->merchant->company_name ?? 'Katering Terpercaya' }}
                            </div>

                            <p class="text-gray-400 text-xs flex items-start gap-1 mb-6">
                                <svg class="w-4 h-4 flex-shrink-0 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span class="truncate">{{ $m->merchant->address }}</span>
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                                <div>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">Harga Porsi</p>
                                    <p class="text-xl font-black text-emerald-600">
                                        <span class="text-xs font-bold">Rp</span>{{ number_format($m->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                <a href="{{ route('customer.checkout', $m->id) }}" 
                                   class="bg-indigo-50 text-indigo-700 hover:bg-indigo-600 hover:text-white px-5 py-3 rounded-2xl font-black text-xs transition-all flex items-center gap-2 uppercase tracking-widest">
                                    Pesan
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 bg-white rounded-[3rem] border-2 border-dashed border-gray-100 flex flex-col items-center justify-center">
                        <div class="w-32 h-32 bg-indigo-50 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-16 h-16 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <h3 class="text-2xl font-black text-indigo-950">Menu Tidak Ditemukan</h3>
                        <p class="text-gray-400 mt-2 font-medium">Coba gunakan kata kunci lain atau ubah filter lokasi.</p>
                        <a href="{{ route('customer.explore') }}" class="mt-6 text-indigo-600 font-bold hover:underline">Lihat Semua Menu</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>