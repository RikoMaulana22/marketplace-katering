<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="inline-flex w-12 h-12 bg-indigo-100 rounded-xl items-center justify-center shadow-sm mb-4">
            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                </path>
            </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-indigo-950 leading-tight">Atur Ulang Password</h2>
        <p class="text-sm text-gray-500 mt-2 font-medium">Silakan buat password baru yang kuat untuk akun Anda</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" :value="__('Email Terdaftar')" class="text-indigo-900 font-bold" />
            <div class="relative mt-1.5">
                <x-text-input id="email"
                    class="block w-full px-4 py-3 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all"
                    type="email" name="email" :value="old('email', $request->email)" required autofocus
                    autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password Baru')" class="text-indigo-900 font-bold" />
            <div class="relative mt-1.5">
                <x-text-input id="password"
                    class="block w-full px-4 py-3 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all"
                    type="password" name="password" required autocomplete="new-password"
                    placeholder="Minimal 8 karakter" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')"
                class="text-indigo-900 font-bold" />
            <div class="relative mt-1.5">
                <x-text-input id="password_confirmation"
                    class="block w-full px-4 py-3 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all"
                    type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="Ketik ulang password" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button
                class="w-full justify-center py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-100 transition-all transform active:scale-[0.98]">
                {{ __('Simpan Password Baru') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-4">
            <a href="{{ route('login') }}"
                class="text-sm font-bold text-gray-500 hover:text-indigo-600 transition-colors">
                Kembali ke halaman Login
            </a>
        </div>
    </form>
</x-guest-layout>