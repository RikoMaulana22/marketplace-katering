<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-indigo-950">
                    {{ isset($merchant) ? 'Edit Profil Bisnis' : 'Lengkapi Profil Bisnis Katering' }}
                </h2>
                <p class="text-gray-500 italic mt-1">Data ini akan tampil di aplikasi pelanggan.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-xl rounded-[2rem] border border-gray-100 overflow-hidden">
                <div class="p-8 md:p-10">
                    {{-- LOGIKA FORM: Jika data sudah ada maka Update, jika belum maka Store --}}
                    <form action="{{ isset($merchant) ? route('merchant.business.update') : route('merchant.profile.store') }}" 
                          method="POST" class="space-y-6">
                        @csrf
                        @if(isset($merchant))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="company_name" :value="__('Nama Katering')" class="font-bold text-indigo-950" />
                                <x-text-input id="company_name" name="company_name" type="text"
                                    class="block w-full mt-2 bg-gray-50 rounded-xl py-3 px-4"
                                    :value="old('company_name', $merchant->company_name ?? '')" required />
                            </div>

                            <div>
                                <x-input-label for="contact" :value="__('WhatsApp / Telp')" class="font-bold text-indigo-950" />
                                <x-text-input id="contact" name="contact" type="text"
                                    class="block w-full mt-2 bg-gray-50 rounded-xl py-3 px-4"
                                    :value="old('contact', $merchant->contact ?? '')" required placeholder="08..." />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="address" :value="__('Alamat Dapur / Kantor')" class="font-bold text-indigo-950" />
                            <textarea id="address" name="address" 
                                class="mt-2 block w-full bg-gray-50 border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm"
                                rows="3" required>{{ old('address', $merchant->address ?? '') }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Tentang Bisnis Anda')" class="font-bold text-indigo-950" />
                            <textarea id="description" name="description" 
                                class="mt-2 block w-full bg-gray-50 border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm"
                                rows="5" placeholder="Contoh: Menyediakan menu sehat tanpa MSG...">{{ old('description', $merchant->description ?? '') }}</textarea>
                        </div>

                        <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                            <x-primary-button class="py-4 px-10 bg-indigo-600 rounded-2xl font-bold shadow-lg shadow-indigo-200">
                                {{ isset($merchant) ? 'Simpan Perubahan' : 'Buat Profil Merchant' }}
                            </x-primary-button>

                            @if(isset($merchant))
                                <a href="{{ route('merchant.dashboard') }}" class="text-sm font-bold text-gray-500 uppercase hover:text-indigo-600">
                                    Batal
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>