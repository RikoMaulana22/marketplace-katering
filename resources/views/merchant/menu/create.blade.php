<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-extrabold text-indigo-950 tracking-tight">
                        ✨ Tambah Menu Baru
                    </h2>
                    <p class="text-gray-500 mt-1 font-medium">Lengkapi detail masakan terbaik Anda untuk menarik
                        pelanggan.</p>
                </div>
                <a href="{{ route('merchant.menu.index') }}"
                    class="text-sm font-bold text-gray-400 hover:text-indigo-600 transition-colors uppercase tracking-widest flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Batal & Kembali
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-xl shadow-indigo-100/50 rounded-[2rem] border border-gray-100">
                <div class="p-8 md:p-12">

                    @if ($errors->any())
                        <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl text-red-700">
                            <p class="font-bold mb-1">Mohon perbaiki kesalahan berikut:</p>
                            <ul class="list-disc list-inside text-sm opacity-90">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('merchant.menu.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-8">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="name" :value="__('Nama Menu')"
                                        class="text-indigo-950 font-bold ml-1" />
                                    <x-text-input id="name" name="name" type="text"
                                        class="mt-1.5 block w-full bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 rounded-2xl py-3 px-4"
                                        :value="old('name')" placeholder="Contoh: Nasi Kotak Ayam Taliwang" required />
                                </div>

                                <div>
                                    <x-input-label for="category" :value="__('Kategori Menu')"
                                        class="text-indigo-950 font-bold ml-1" />
                                    <select name="category" id="category" required
                                        class="mt-1.5 block w-full bg-gray-50 border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl py-3 px-4 font-medium text-gray-700 shadow-sm transition-all">
                                        <option value="" disabled selected>Pilih Kategori...</option>
                                        <option value="Prasmanan" {{ old('category') == 'Prasmanan' ? 'selected' : '' }}>
                                            🍛 Prasmanan</option>
                                        <option value="Nasi Kotak" {{ old('category') == 'Nasi Kotak' ? 'selected' : '' }}>🍱 Nasi Kotak</option>
                                        <option value="Snack Box" {{ old('category') == 'Snack Box' ? 'selected' : '' }}>
                                            🍪 Snack Box</option>
                                        <option value="Minuman" {{ old('category') == 'Minuman' ? 'selected' : '' }}>🥤
                                            Minuman</option>
                                    </select>
                                </div>

                                <div>
                                    <x-input-label for="price" :value="__('Harga Per Porsi')"
                                        class="text-indigo-950 font-bold ml-1" />
                                    <div class="relative mt-1.5">
                                        <span
                                            class="absolute inset-y-0 left-0 pl-5 flex items-center text-indigo-400 font-bold">Rp</span>
                                        <x-text-input id="price" name="price" type="number"
                                            class="block w-full pl-14 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 rounded-2xl py-3"
                                            :value="old('price')" placeholder="25000" required />
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="description" :value="__('Deskripsi Lengkap')"
                                        class="text-indigo-950 font-bold ml-1" />
                                    <textarea id="description" name="description"
                                        class="mt-1.5 block w-full bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl shadow-sm transition-all p-4"
                                        rows="4" required
                                        placeholder="Tuliskan isi menu, misal: Nasi putih, Ayam Bakar, Lalapan, Sambal korek, dan Kerupuk...">{{ old('description') }}</textarea>
                                </div>

                                <div>
                                    <x-input-label :value="__('Foto Menu')"
                                        class="text-indigo-950 font-bold ml-1 mb-2" />
                                    <div class="relative group">
                                        <label for="photo"
                                            class="flex flex-col items-center justify-center w-full h-44 border-2 border-dashed border-indigo-100 bg-indigo-50/30 rounded-3xl cursor-pointer hover:bg-indigo-50 transition-all group-hover:border-indigo-400 overflow-hidden">
                                            <div id="placeholder-content"
                                                class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-10 h-10 mb-3 text-indigo-400 group-hover:scale-110 transition-transform"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <p class="text-sm font-bold text-indigo-600">Klik untuk upload foto</p>
                                                <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-tighter">
                                                    PNG, JPG up to 2MB</p>
                                            </div>
                                            <img id="preview"
                                                class="hidden absolute inset-0 w-full h-full object-cover">
                                        </label>
                                        <input id="photo" name="photo" type="file" class="hidden" accept="image/*"
                                            onchange="previewImage(this)" required />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="pt-10 border-t border-gray-50 flex flex-col md:flex-row items-center justify-between gap-6">
                            <div class="flex items-center gap-3 text-gray-400">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-xs font-medium italic">Menu akan langsung terlihat oleh calon pembeli
                                    setelah diterbitkan.</p>
                            </div>

                            <x-primary-button
                                class="w-full md:w-auto justify-center py-4 px-12 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-100 transition-all transform active:scale-95">
                                🚀 Terbitkan Menu Sekarang
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('placeholder-content');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('opacity-0');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>