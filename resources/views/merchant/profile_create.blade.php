<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-extrabold text-indigo-950 tracking-tight">
                        {{ __('Profil Bisnis Katering') }}
                    </h2>
                    <p class="text-gray-500 mt-1 font-medium italic">Informasi ini akan muncul di halaman katalog
                        pelanggan.</p>
                </div>
                <div class="hidden md:block">
                    <div
                        class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-2xl text-sm font-bold shadow-sm border border-indigo-200">
                        Mode Merchant
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div
                    class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl flex items-center text-green-700 font-bold shadow-sm animate-bounce-short">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl shadow-indigo-100/50 rounded-[2rem] border border-gray-100">
                <div class="p-8 md:p-10">
                    <form action="{{ route('merchant.business.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-1">
                                <x-input-label for="company_name" :value="__('Nama Perusahaan / Katering')"
                                    class="text-indigo-950 font-bold ml-1" />
                                <div class="relative mt-1.5">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <x-text-input id="company_name" name="company_name" type="text"
                                        class="block w-full pl-12 pr-4 py-3 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all"
                                        :value="old('company_name', $merchant->company_name ?? '')" required />
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
                            </div>

                            <div class="md:col-span-1">
                                <x-input-label for="contact" :value="__('WhatsApp / Telp')"
                                    class="text-indigo-950 font-bold ml-1" />
                                <div class="relative mt-1.5">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <x-text-input id="contact" name="contact" type="text"
                                        class="block w-full pl-12 pr-4 py-3 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all"
                                        :value="old('contact', $merchant->contact ?? '')" required
                                        placeholder="0812..." />
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('contact')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="address" :value="__('Alamat Lengkap Kantor/Dapur')"
                                class="text-indigo-950 font-bold ml-1" />
                            <textarea id="address" name="address"
                                class="mt-1.5 block w-full px-4 py-3 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all"
                                rows="3" required
                                placeholder="Masukkan alamat untuk keperluan pengiriman...">{{ old('address', $merchant->address ?? '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Deskripsi Bisnis')"
                                class="text-indigo-950 font-bold ml-1" />
                            <textarea id="description" name="description"
                                class="mt-1.5 block w-full px-4 py-3 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all"
                                rows="5"
                                placeholder="Jelaskan menu andalan atau keunggulan katering Anda...">{{ old('description', $merchant->description ?? '') }}</textarea>
                            <p class="text-[11px] text-gray-400 mt-2 italic">* Contoh: Spesialis Nasi Kotak Tradisional
                                & Prasmanan Kantor.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="flex flex-col md:flex-row items-center gap-4 pt-6 border-t border-gray-50">
                            <x-primary-button
                                class="w-full md:w-auto justify-center py-4 px-10 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-100 transition-all transform active:scale-[0.98]">
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>

                            <a href="{{ route('merchant.dashboard') }}"
                                class="text-sm font-bold text-gray-500 hover:text-indigo-600 transition-colors uppercase tracking-widest">
                                {{ __('Batal & Kembali') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>