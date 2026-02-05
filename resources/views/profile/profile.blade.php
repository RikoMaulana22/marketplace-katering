@extends('layouts.app') {{-- Atau layout dashboard merchant Anda --}}

@section('content')
<div style="padding: 20px; max-width: 600px; margin: auto; background: white; border-radius: 8px; shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <h2>Pengaturan Profil Bisnis</h2>
    <hr style="margin-bottom: 20px;">

    @if(session('success'))
        <div style="padding: 10px; background: #dcfce7; color: #166534; margin-bottom: 20px; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('merchant.profile.update') }}" method="POST">
        @csrf 
        @method('PUT')
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold;">Nama Perusahaan</label>
            <input type="text" name="company_name" 
                   value="{{ auth()->user()->merchant->company_name }}" 
                   style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold;">Alamat Lengkap</label>
            <textarea name="address" rows="3" 
                      style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">{{ auth()->user()->merchant->address }}</textarea>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold;">Deskripsi Katering</label>
            <textarea name="description" rows="5" 
                      style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">{{ auth()->user()->merchant->description }}</textarea>
        </div>
        
        <button type="submit" 
                style="background: #4F46E5; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection