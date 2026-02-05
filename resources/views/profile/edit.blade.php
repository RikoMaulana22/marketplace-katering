<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-indigo-950 tracking-tight">
                    {{ __('Pengaturan Akun') }}
                </h2>
                <p class="text-gray-500 mt-1 font-medium">Kelola informasi profil, keamanan password, dan kredensial
                    bisnis Anda.</p>
            </div>

            @if(auth()->user()->role === 'merchant')
                <div
                    class="p-6 md:p-8 bg-indigo-600 rounded-[2rem] shadow-xl shadow-indigo-200 overflow-hidden relative group transition-all hover:shadow-indigo-300">
                    <div class="flex flex-col md:flex-row items-center justify-between relative z-10">
                        <div class="mb-4 md:mb-0">
                            <h3 class="text-xl font-bold text-white flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                Profil Bisnis Katering
                            </h3>
                            <p class="text-indigo-100 mt-1">Identitas bisnis Anda menentukan kepercayaan pelanggan di
                                katalog.</p>
                        </div>
                        <a href="{{ route('merchant.business.edit') }}"
                            class="inline-flex items-center px-6 py-3 bg-white text-indigo-600 rounded-2xl font-bold text-sm shadow-lg hover:bg-indigo-50 transition-all transform active:scale-95">
                            Edit Profil Bisnis →
                        </a>
                    </div>
                    <svg class="absolute right-[-20px] top-[-20px] w-40 h-40 text-white/10 transform -rotate-12"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0v-7.268a2 2 0 000-3.464V4z">
                        </path>
                    </svg>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-1">
                    <h4 class="text-lg font-bold text-indigo-950">Informasi Pribadi</h4>
                    <p class="text-sm text-gray-500 mt-1">Perbarui nama akun dan alamat email Anda.</p>
                </div>
                <div
                    class="md:col-span-2 p-6 sm:p-10 bg-white shadow-xl shadow-indigo-100/50 rounded-[2rem] border border-gray-100">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <hr class="border-gray-200">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-12">
                <div class="md:col-span-1">
                    <h4 class="text-lg font-bold text-indigo-950">Keamanan Akun</h4>
                    <p class="text-sm text-gray-500 mt-1">Pastikan akun Anda menggunakan password yang panjang dan acak.
                    </p>
                </div>
                <div
                    class="md:col-span-2 p-6 sm:p-10 bg-white shadow-xl shadow-indigo-100/50 rounded-[2rem] border border-gray-100">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>