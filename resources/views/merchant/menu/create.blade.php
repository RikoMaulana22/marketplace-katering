<div style="padding: 30px; font-family: sans-serif; max-width: 700px; margin: auto;">
    <div style="background: white; border: 1px solid #ddd; padding: 20px; border-radius: 8px; shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="margin-top: 0; color: #333;">Tambah Menu Baru</h2>
        <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 20px;">

        @if ($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 5px; margin-bottom: 20px; font-size: 14px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('merchant.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Nama Menu</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Nasi Kotak Ayam Bakar" required 
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Deskripsi</label>
                <textarea name="description" placeholder="Jelaskan isi menu..." required 
                          style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; height: 100px;">{{ old('description') }}</textarea>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price') }}" placeholder="Contoh: 25000" required 
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Foto Menu</label>
                <input type="file" name="photo" required 
                       style="display: block; width: 100%; padding: 8px; border: 1px dashed #ccc; border-radius: 4px;">
                <small style="color: #666;">Format: JPG, PNG (Max. 2MB)</small>
            </div>

            <div style="display: flex; gap: 10px; align-items: center;">
                <button type="submit" style="background: #22c55e; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; font-size: 14px;">
                    Simpan Menu
                </button>
                <a href="{{ route('merchant.menu.index') }}" style="color: #666; text-decoration: none; font-size: 14px;">Batal</a>
            </div>
        </form>
    </div>
</div>