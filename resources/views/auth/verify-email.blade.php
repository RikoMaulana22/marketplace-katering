<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="inline-flex w-12 h-12 bg-indigo-100 rounded-xl items-center justify-center shadow-sm mb-4">
            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                </path>
            </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-indigo-950 leading-tight">Verifikasi Email</h2>
        <p class="text-sm text-gray-500 mt-2 font-medium px-2">
            {{ __('Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div
            class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl font-medium text-sm text-green-700 text-center animate-pulse">
            {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button
                class="w-full justify-center py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-100 transition-all transform active:scale-[0.98]">
                {{ __('Kirim Ulang Email Verifikasi') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit"
                class="text-sm font-bold text-gray-500 hover:text-red-600 transition-colors underline-offset-4 hover:underline">
                {{ __('Keluar / Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>