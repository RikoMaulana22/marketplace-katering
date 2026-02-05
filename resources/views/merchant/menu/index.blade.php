<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-indigo-950 tracking-tight">
                        🍽️ Kelola Menu Katering
                    </h2>
                    <p class="text-gray-500 mt-1 font-medium">Atur daftar masakan andalan untuk dipesan oleh pelanggan.
                    </p>
                </div>
                <a href="{{ route('merchant.menu.create') }}"
                    class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold shadow-xl shadow-indigo-100 transition-all transform active:scale-95">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Menu Baru
                </a>
            </div>

            @if(session('success'))
                <div
                    class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl flex items-center text-green-700 font-bold shadow-sm">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($menus as $menu)
                    <div
                        class="bg-white rounded-[2rem] shadow-xl shadow-indigo-100/50 border border-gray-100 overflow-hidden group hover:ring-2 hover:ring-indigo-500 transition-all">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $menu->photo) }}" alt="{{ $menu->name }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-xl shadow-sm">
                                <span class="text-xs font-black text-indigo-600 uppercase">Tersedia</span>
                            </div>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-black text-indigo-950 truncate">{{ $menu->name }}</h3>
                            <p class="text-sm text-gray-500 mt-2 line-clamp-2 min-h-[40px]">
                                {{ $menu->description }}
                            </p>

                            <div class="mt-4 flex items-center justify-between">
                                <div class="text-lg font-black text-indigo-600">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-50 flex items-center gap-2">
                                <a href="{{ route('merchant.menu.edit', $menu->id) }}"
                                    class="flex-1 text-center py-2.5 bg-indigo-50 text-indigo-700 rounded-xl font-bold text-sm hover:bg-indigo-100 transition-colors">
                                    Edit
                                </a>

                                <form action="{{ route('merchant.menu.destroy', $menu->id) }}" method="POST"
                                    class="flex-none">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus menu ini?')"
                                        class="p-2.5 text-red-500 hover:bg-red-50 rounded-xl transition-colors border border-transparent hover:border-red-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full py-20 bg-white rounded-[2rem] shadow-sm border border-dashed border-gray-300 flex flex-col items-center">
                        <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-indigo-950">Belum Ada Menu</h3>
                        <p class="text-gray-400 text-sm mt-1">Mulailah dengan menambahkan menu masakan lezat Anda.</p>
                        <a href="{{ route('merchant.menu.create') }}"
                            class="mt-6 text-indigo-600 font-bold hover:underline">Tambah Menu Sekarang &rarr;</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('merchant.dashboard') }}"
                    class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-indigo-600 transition-colors uppercase tracking-widest">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10 19l-7-7 7-7m8 14l-7-7 7-7" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>