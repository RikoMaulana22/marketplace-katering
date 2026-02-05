<x-guest-layout>
    <div class="mb-8 text-center">
        <div
            class="inline-flex w-12 h-12 bg-indigo-600 rounded-xl items-center justify-center shadow-indigo-200 shadow-lg mb-4">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
        </div>
        <h2 class="text-3xl font-extrabold text-indigo-950">Buat Akun</h2>
        <p class="text-sm text-gray-500 mt-2">Gabung dengan ekosistem katering digital kami</p>
    </div>

    <form method="POST" action="{{ route('register') }}" x-data="{ role: 'customer' }" class="space-y-5">
        @csrf

        <div>
            <x-input-label class="text-indigo-900 font-bold mb-3" :value="__('Daftar Sebagai:')" />
            <input type="hidden" name="role" :value="role">
            <div class="grid grid-cols-2 gap-4">
                <div @click="role = 'customer'"
                    :class="role === 'customer' ? 'border-indigo-600 bg-indigo-50 ring-2 ring-indigo-500' : 'border-gray-200 bg-white'"
                    class="p-4 border-2 rounded-2xl cursor-pointer transition-all text-center">
                    <span class="text-2xl">🏢</span>
                    <p class="text-xs font-bold mt-1"
                        :class="role === 'customer' ? 'text-indigo-900' : 'text-gray-500'">Admin Kantor</p>
                </div>
                <div @click="role = 'merchant'"
                    :class="role === 'merchant' ? 'border-indigo-600 bg-indigo-50 ring-2 ring-indigo-500' : 'border-gray-200 bg-white'"
                    class="p-4 border-2 rounded-2xl cursor-pointer transition-all text-center">
                    <span class="text-2xl">👨‍🍳</span>
                    <p class="text-xs font-bold mt-1"
                        :class="role === 'merchant' ? 'text-indigo-900' : 'text-gray-500'">Pemilik Katering</p>
                </div>
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-indigo-900 font-bold" />
            <x-text-input id="name" class="block mt-1.5 w-full px-4 py-3 bg-gray-50 border-gray-200 rounded-xl"
                type="text" name="name" :value="old('name')" required autofocus placeholder="Nama Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-indigo-900 font-bold" />
            <x-text-input id="email" class="block mt-1.5 w-full px-4 py-3 bg-gray-50 border-gray-200 rounded-xl"
                type="email" name="email" :value="old('email')" required placeholder="email@kantor.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-indigo-900 font-bold" />
                <x-text-input id="password" class="block mt-1.5 w-full px-4 py-3 bg-gray-50 border-gray-200 rounded-xl"
                    type="password" name="password" required placeholder="••••••••" />
            </div>
            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi')"
                    class="text-indigo-900 font-bold" />
                <x-text-input id="password_confirmation"
                    class="block mt-1.5 w-full px-4 py-3 bg-gray-50 border-gray-200 rounded-xl" type="password"
                    name="password_confirmation" required placeholder="••••••••" />
            </div>
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />

        <div class="pt-4">
            <x-primary-button
                class="w-full justify-center py-4 bg-indigo-600 rounded-2xl font-bold text-lg shadow-xl shadow-indigo-100 transform active:scale-[0.98]">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
        </div>

        <p class="mt-6 text-center text-sm text-gray-500">
            Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:underline">Masuk</a>
        </p>
    </form>
</x-guest-layout>