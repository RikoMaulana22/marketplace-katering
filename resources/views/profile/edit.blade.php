<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Profil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(auth()->user()->role === 'merchant')
                <div class="p-4 sm:p-8 bg-indigo-50 shadow sm:rounded-lg border-l-4 border-indigo-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-indigo-900">Profil Bisnis Katering</h3>
                            <p class="text-sm text-indigo-700">Lengkapi alamat, nama perusahaan, dan deskripsi katering
                                Anda.</p>
                        </div>
                        <a href="{{ route('merchant.business.edit') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Edit Profil Bisnis
                        </a>
                    </div>
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>