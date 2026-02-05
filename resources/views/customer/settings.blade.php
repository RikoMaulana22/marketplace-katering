<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Alamat Pengiriman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('customer.settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="phone" :value="__('Nomor Telepon Kantor / PIC')" />
                        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', auth()->user()->phone)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="address" :value="__('Alamat Lengkap Pengiriman (Gedung, Lantai, No. Ruangan)')" />
                        <textarea id="address" name="address" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="4" required>{{ old('address', auth()->user()->address) }}</textarea>
                        <p class="text-sm text-gray-500 mt-1 italic font-bold text-red-500">* Alamat ini akan muncul di invoice untuk tujuan pengiriman.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Simpan Alamat') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>