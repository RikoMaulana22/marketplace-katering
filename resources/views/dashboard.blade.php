<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-extrabold text-indigo-950">Dashboard</h2>
                    <p class="text-gray-500 mt-1 font-medium">Selamat Datang Kembali, {{ Auth::user()->name }}! 👋</p>
                </div>
                <div class="hidden md:block">
                    <span
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-2xl shadow-sm text-sm font-bold text-indigo-600">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                        Status: {{ Auth::user()->role == 'merchant' ? 'Pemilik Katering' : 'Admin Kantor' }}
                    </span>
                </div>
            </div>

            @if(Auth::user()->role == 'merchant')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-xl shadow-indigo-100/20">
                        <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <h4 class="text-gray-500 text-sm font-bold uppercase tracking-wider">Total Pesanan</h4>
                        <p class="text-3xl font-black text-indigo-950">24</p>
                    </div>

                    <div class="bg-indigo-600 p-6 rounded-3xl shadow-xl shadow-indigo-200 relative overflow-hidden group">
                        <div class="relative z-10">
                            <h4 class="text-white/80 text-sm font-bold uppercase tracking-wider">Manajemen Menu</h4>
                            <p class="text-xl font-bold text-white mt-1">Update menu katering Anda hari ini</p>
                            <a href="{{ route('merchant.menu.index') }}"
                                class="mt-4 inline-flex items-center px-4 py-2 bg-white text-indigo-600 rounded-xl font-bold text-sm shadow-lg transform transition active:scale-95">
                                Kelola Menu
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                        <svg class="absolute right-[-20px] bottom-[-20px] w-32 h-32 text-white/10 transform rotate-12"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0v-7.268a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z">
                            </path>
                        </svg>
                    </div>

                    <div
                        class="bg-white p-6 rounded-3xl border-2 border-dashed border-indigo-200 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-3">
                            <span class="relative flex h-3 w-3">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                            </span>
                        </div>
                        <h4 class="text-indigo-950 font-bold">Pesanan Masuk</h4>
                        <p class="text-xs text-gray-500 mb-4 px-4">Cek daftar pesanan terbaru dari kantor</p>
                        <a href="{{ route('merchant.orders.index') }}"
                            class="text-indigo-600 font-bold hover:text-indigo-800 transition">Lihat Semua →</a>
                    </div>
                </div>

            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div
                        class="md:col-span-2 bg-gradient-to-br from-indigo-700 to-violet-800 p-8 rounded-[2rem] shadow-2xl shadow-indigo-200 flex flex-col justify-between text-white">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Lapar, {{ Auth::user()->name }}?</h3>
                            <p class="text-indigo-100 text-sm">Temukan katering terbaik di sekitar kantor Anda sekarang.</p>
                        </div>
                        <div class="mt-8 flex gap-3">
                            <a href="{{ route('customer.explore') }}"
                                class="px-6 py-3 bg-white text-indigo-700 rounded-2xl font-bold shadow-lg hover:shadow-white/20 transition transform active:scale-95">
                                Cari Makan Siang
                            </a>
                        </div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-xl shadow-indigo-100/20 flex flex-col items-center text-center justify-center group hover:border-indigo-500 transition-all">
                        <div
                            class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-indigo-600 transition-colors">
                            <svg class="w-7 h-7 text-amber-600 group-hover:text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-indigo-950">Riwayat Pesanan</h4>
                        <a href="{{ route('customer.orders') }}" class="mt-2 text-sm text-indigo-600 font-bold">Lihat
                            Semua</a>
                    </div>

                    <div
                        class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-xl shadow-indigo-100/20 flex flex-col items-center text-center justify-center group hover:border-indigo-500 transition-all">
                        <div
                            class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-indigo-600 transition-colors">
                            <svg class="w-7 h-7 text-slate-600 group-hover:text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-indigo-950">Alamat Kantor</h4>
                        <a href="{{ route('customer.settings') }}" class="mt-2 text-sm text-gray-500 font-bold">Ubah
                            Alamat</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>