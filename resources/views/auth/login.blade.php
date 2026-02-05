<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Selamat Datang Kembali!</h2>
        <p class="text-sm text-gray-600">Silakan masuk ke akun katering Anda</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="font-semibold" />
            <div class="relative mt-1">
                <x-text-input id="email"
                    class="block w-full pl-3 pr-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                    placeholder="nama@kantor.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" class="font-semibold" />
            </div>
            <div class="relative mt-1">
                <x-text-input id="password"
                    class="block w-full pl-3 pr-10 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                    type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 hover:text-indigo-900 transition-colors"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="mt-6">
            <x-primary-button
                class="w-full justify-center py-3 text-base font-bold tracking-wider uppercase transition-all transform active:scale-95">
                {{ __('Masuk Sekarang') }}
            </x-primary-button>
        </div>

        <div class="mt-8 text-center border-t pt-6">
            <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:underline">Daftar di sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>