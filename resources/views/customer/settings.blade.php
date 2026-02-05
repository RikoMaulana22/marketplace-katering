<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 flex items-center gap-4">
                <div class="p-3 bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-200">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-3xl font-extrabold text-indigo-950 tracking-tight">
                        {{ __('Titik Pengiriman') }}
                    </h2>
                    <p class="text-gray-500 font-medium">Pastikan alamat kantor Anda detail untuk memudahkan kurir.</p>
                </div>
            </div>

            @if (session('status') === 'profile-updated' || session('success'))
                <div
                    class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl flex items-center text-green-700 font-bold shadow-sm animate-bounce-short">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ __('Alamat berhasil diperbarui!') }}
                </div>
            @endif

            <div
                class="bg-white overflow-hidden shadow-xl shadow-indigo-100/50 rounded-[2.5rem] border border-gray-100">
                <div class="p-8 md:p-12">
                    <form action="{{ route('customer.settings.update') }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        @if(request('menu_id'))
                            <input type="hidden" name="menu_id" value="{{ request('menu_id') }}">
                        @endif

                        <div class="space-y-6">
                            <div>
                                <x-input-label for="phone" :value="__('Nomor Telepon Kantor / PIC')"
                                    class="text-indigo-950 font-bold ml-1" />
                                <div class="relative mt-2">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <x-text-input id="phone" name="phone" type="text"
                                        class="block w-full pl-12 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 rounded-2xl py-4 transition-all"
                                        :value="old('phone', auth()->user()->phone)" placeholder="0812xxxx" required />
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>

                            <div>
                                <div class="flex justify-between items-end mb-2 ml-1">
                                    <x-input-label for="address" :value="__('Alamat Lengkap Gedung')"
                                        class="text-indigo-950 font-bold" />
                                    <span
                                        class="text-[10px] uppercase font-black text-indigo-400 tracking-widest">Informasi
                                        Wajib</span>
                                </div>
                                <textarea id="address" name="address"
                                    class="w-full bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl shadow-sm transition-all p-5 text-gray-700 leading-relaxed"
                                    rows="5" placeholder="Contoh: Gedung Artha Graha, Lantai 12, Ruang Meeting 3A..."
                                    required>{{ old('address', auth()->user()->address) }}</textarea>

                                <div class="mt-4 p-4 bg-indigo-50 rounded-2xl flex gap-3 border border-indigo-100">
                                    ...
                                </div>
                            </div>
                        </div>

                        <div
                            class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-gray-50">
                            <p class="text-sm text-gray-400 font-medium">Perubahan akan langsung diterapkan pada pesanan
                                berikutnya.</p>
                            <x-primary-button class="w-full sm:w-auto justify-center py-4 px-10 bg-indigo-600 ...">
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('dashboard') }}"
                    class="text-sm font-bold text-gray-400 hover:text-indigo-600 transition-colors uppercase tracking-widest flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-app-layout>