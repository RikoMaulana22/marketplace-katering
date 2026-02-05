<x-guest-layout>
    <div class="mb-8 text-center">
        <div
            class="inline-flex w-12 h-12 bg-indigo-600 rounded-xl items-center justify-center shadow-indigo-200 shadow-lg mb-4">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
            </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-indigo-950 leading-tight">Selamat Datang!</h2>
        <p class="text-sm text-gray-500 mt-2 font-medium">Silakan masuk untuk mengelola katering Anda</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email Kantor')" class="text-indigo-900 font-bold" />
            <div class="relative mt-1.5">
                <x-text-input id="email"
                    class="block w-full px-4 py-3 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                    placeholder="nama@kantor.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-indigo-900 font-bold" />
            <div class="relative mt-1.5">
                <x-text-input id="password"
                    class="block w-full px-4 py-3 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all"
                    type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox"
                    class="rounded-md border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 w-4 h-4"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 font-medium">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-colors"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="mt-8">
            <x-primary-button
                class="w-full justify-center py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-100 transition-all transform active:scale-[0.98]">
                {{ __('Masuk Sekarang') }}
            </x-primary-button>
        </div>

        <div class="mt-10 text-center border-t border-gray-100 pt-8">
            <p class="text-sm text-gray-500 font-medium">
                Belum punya akun?
                <a href="{{ route('register') }}"
                    class="font-bold text-indigo-600 hover:text-indigo-700 hover:underline underline-offset-4">Daftar
                    Akun Gratis</a>
            </p>
        </div>
    </form>
</x-guest-layout>