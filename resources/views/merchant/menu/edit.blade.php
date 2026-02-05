<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-extrabold text-indigo-950 tracking-tight">
                        {{ __('Edit Menu') }}
                    </h2>
                    <p class="text-gray-500 mt-1 font-medium italic">Perbarui rincian hidangan: <span class="text-indigo-600 font-bold">{{ $menu->name }}</span></p>
                </div>
                <a href="{{ route('merchant.menu.index') }}" class="text-sm font-bold text-gray-400 hover:text-indigo-600 transition-colors uppercase tracking-widest flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Kembali
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-xl shadow-indigo-100/50 rounded-[2rem] border border-gray-100">
                <div class="p-8 md:p-10">
                    <form action="{{ route('merchant.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf 
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="name" :value="__('Nama Menu')" class="text-indigo-950 font-bold ml-1" />
                                    <x-text-input id="name" name="name" type="text" 
                                        class="mt-1.5 block w-full bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 rounded-xl" 
                                        :value="old('name', $menu->name)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div>
                                    <x-input-label for="price" :value="__('Harga Jual (Rp)')" class="text-indigo-950 font-bold ml-1" />
                                    <div class="relative mt-1.5">
                                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 font-bold">Rp</span>
                                        <x-text-input id="price" name="price" type="number" 
                                            class="block w-full pl-12 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 rounded-xl" 
                                            :value="old('price', $menu->price)" required />
                                    </div>
                                    <x-input-error class="mt-2" :messages="$errors->get('price')" />
                                </div>

                                <div>
                                    <x-input-label for="description" :value="__('Deskripsi Menu')" class="text-indigo-950 font-bold ml-1" />
                                    <textarea id="description" name="description" 
                                        class="mt-1.5 block w-full bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all" 
                                        rows="4" required placeholder="Jelaskan bahan-bahan atau rasa hidangan...">{{ old('description', $menu->description) }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                </div>
                            </div>

                            <div class="space-y-4">
                                <x-input-label :value="__('Foto Menu')" class="text-indigo-950 font-bold ml-1" />
                                
                                <div class="relative group">
                                    <div class="w-full h-56 bg-gray-100 rounded-[1.5rem] overflow-hidden border-2 border-dashed border-gray-200 flex items-center justify-center">
                                        <img src="{{ asset('storage/' . $menu->photo) }}" 
                                             class="w-full h-full object-cover group-hover:opacity-75 transition-opacity"
                                             id="photo-preview">
                                    </div>
                                    <div class="mt-4">
                                        <input type="file" name="photo" id="photo-input" class="hidden" accept="image/*" onchange="previewImage(this)">
                                        <label for="photo-input" class="cursor-pointer flex items-center justify-center gap-2 w-full py-3 px-4 bg-indigo-50 text-indigo-700 rounded-xl font-bold text-sm hover:bg-indigo-100 transition-all border border-indigo-100">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            Ganti Foto Menu
                                        </label>
                                        <p class="text-[11px] text-gray-400 mt-2 text-center italic">* Biarkan kosong jika tidak ingin mengubah foto</p>
                                    </div>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row items-center gap-4 pt-8 border-t border-gray-50">
                            <x-primary-button class="w-full md:w-auto justify-center py-4 px-10 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-100 transition-all transform active:scale-[0.98]">
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                            
                            <a href="{{ route('merchant.menu.index') }}" class="text-sm font-bold text-gray-500 hover:text-red-500 transition-colors uppercase tracking-widest">
                                {{ __('Batalkan') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('photo-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>