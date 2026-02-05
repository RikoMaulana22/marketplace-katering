<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengelolaan Profil Bisnis Katering') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-200 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('merchant.business.update') }}" method="POST">
                    @csrf 
                    @method('PUT')
                    
                    <div class="mb-4">
                        <x-input-label for="company_name" :value="__('Nama Perusahaan / Katering')" />
                        <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full" :value="old('company_name', $merchant->company_name ?? '')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="contact" :value="__('Nomor Telepon / WhatsApp')" />
                        <x-text-input id="contact" name="contact" type="text" class="mt-1 block w-full" :value="old('contact', $merchant->contact ?? '')" required placeholder="Contoh: 08123456789" />
                        <p class="text-xs text-gray-500 mt-1">* Digunakan oleh customer untuk konfirmasi pesanan.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('contact')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="address" :value="__('Alamat Lengkap Kantor/Dapur')" />
                        <textarea id="address" name="address" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="3" required>{{ old('address', $merchant->address ?? '') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Deskripsi Bisnis')" />
                        <textarea id="description" name="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="5" placeholder="Jelaskan spesialisasi katering Anda (misal: Prasmanan, Nasi Kotak, dll)">{{ old('description', $merchant->description ?? '') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex items-center gap-4 border-t pt-4">
                        <x-primary-button>{{ __('Simpan Perubahan Profil') }}</x-primary-button>
                        
                        <a href="{{ route('merchant.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                            {{ __('Batal') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>