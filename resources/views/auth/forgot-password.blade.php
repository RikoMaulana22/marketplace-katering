<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="inline-flex w-12 h-12 bg-amber-100 rounded-xl items-center justify-center mb-4">
            <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                </path>
            </svg>
        </div>
        <h2 class="text-2xl font-extrabold text-indigo-950">Lupa Password?</h2>
        <p class="text-sm text-gray-500 mt-2 px-4">Masukkan email Anda dan kami akan mengirimkan link untuk mengatur
            ulang password.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf
        <div>
            <x-input-label for="email" :value="__('Email Terdaftar')" class="text-indigo-900 font-bold" />
            <x-text-input id="email" class="block mt-1.5 w-full px-4 py-3 bg-gray-50 border-gray-200 rounded-xl"
                type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center py-4 bg-indigo-600 rounded-2xl font-bold shadow-lg">
            {{ __('Kirim Link Reset') }}
        </x-primary-button>

        <div class="text-center">
            <a href="{{ route('login') }}"
                class="text-sm font-bold text-gray-500 hover:text-indigo-600 transition-colors">
                Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>