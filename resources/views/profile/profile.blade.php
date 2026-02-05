@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-extrabold text-indigo-950">Profil Bisnis</h2>
                <p class="text-gray-500 mt-1 font-medium">Informasi ini akan tampil pada halaman katalog katering Anda</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition">
                ← Kembali ke Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl flex items-center text-green-700 font-bold shadow-sm animate-fade-in">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[2rem] shadow-xl shadow-indigo-100/50 border border-gray-100 overflow-hidden">
            <div class="p-8 md:p-10">
                <form action="{{ route('merchant.profile.update') }}" method="POST" class="space-y-6">
                    @csrf 
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-bold text-indigo-950 mb-2">Nama Perusahaan / Katering</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </span>
                            <input type="text" name="company_name" 
                                   value="{{ auth()->user()->merchant->company_name }}" 
                                   class="block w-full pl-12 pr-4 py-3 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all"
                                   placeholder="Contoh: Katering Barokah Jaya">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-indigo-950 mb-2">Alamat Lengkap</label>
                        <textarea name="address" rows="3" 
                                  class="block w-full px-4 py-3 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all"
                                  placeholder="Masukkan alamat lengkap dapur/kantor...">{{ auth()->user()->merchant->address }}</textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-indigo-950 mb-2">Deskripsi Katering</label>
                        <textarea name="description" rows="5" 
                                  class="block w-full px-4 py-3 bg-gray-50 border-gray-200 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all"
                                  placeholder="Ceritakan keunggulan katering Anda (Menu andalan, kapasitas pesanan, dll)...">{{ auth()->user()->merchant->description }}</textarea>
                        <p class="mt-2 text-xs text-gray-400 font-medium italic">*Deskripsi yang menarik membantu meningkatkan kepercayaan pelanggan.</p>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-100">
                        <button type="submit" 
                                class="w-full md:w-auto inline-flex justify-center items-center px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-100 transition-all transform active:scale-[0.98]">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection