<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="inline-flex w-12 h-12 bg-indigo-100 rounded-xl items-center justify-center shadow-sm mb-4">
            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A10.003 10.003 0 0112 3c4.176 0 7.791 2.561 9.324 6.208M12 11V3m0 8l8 4m-8-4l-8 4m8-4v10">
                </path>
            </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-indigo-950 leading-tight">Konfirmasi Password</h2>
        <p class="text-sm text-gray-500 mt-2 font-medium px-4">
            {{ __('Ini adalah area aman. Silakan konfirmasi password Anda sebelum melanjutkan ke halaman berikutnya.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password Anda')" class="text-indigo-900 font-bold" />
            <div class="relative mt-1.5">
                <x-text-input id="password"
                    class="block w-full px-4 py-3 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all"
                    type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="pt-2">
            <x-primary-button
                class="w-full justify-center py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-100 transition-all transform active:scale-[0.98]">
                {{ __('Konfirmasi Sekarang') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-2">
            <a href="javascript:history.back()"
                class="text-sm font-bold text-gray-500 hover:text-indigo-600 transition-colors">
                Batal dan Kembali
            </a>
        </div>
    </form>
</x-guest-layout>