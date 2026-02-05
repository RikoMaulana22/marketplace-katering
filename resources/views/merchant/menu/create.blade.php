<div style="padding: 30px; font-family: sans-serif; max-width: 700px; margin: auto;">
    <div
        style="background: white; border: 1px solid #ddd; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        <h2 style="margin-top: 0; color: #111827;">Tambah Menu Baru</h2>
        <p style="color: #6b7280; font-size: 14px; margin-bottom: 20px;">Lengkapi detail makanan untuk mulai berjualan.
        </p>
        <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 25px;">

        @if ($errors->any())
            <div
                style="background: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 5px; margin-bottom: 20px; font-size: 14px;">
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
                <label style="font-weight: bold; display: block; margin-bottom: 5px; color: #374151;">Nama Menu</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Nasi Kotak Ayam Bakar"
                    required
                    style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; outline-color: #4F46E5;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px; color: #374151;">Kategori
                    Menu</label>
                <select name="category" required
                    style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; background: white;">
                    <option value="" disabled selected>Pilih Kategori...</option>
                    <option value="Prasmanan" {{ old('category') == 'Prasmanan' ? 'selected' : '' }}>Prasmanan</option>
                    <option value="Nasi Kotak" {{ old('category') == 'Nasi Kotak' ? 'selected' : '' }}>Nasi Kotak</option>
                    <option value="Snack Box" {{ old('category') == 'Snack Box' ? 'selected' : '' }}>Snack Box</option>
                    <option value="Minuman" {{ old('category') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px; color: #374151;">Harga Per Porsi
                    (Rp)</label>
                <input type="number" name="price" value="{{ old('price') }}" placeholder="Contoh: 25000" required
                    style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; outline-color: #4F46E5;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px; color: #374151;">Deskripsi
                    Menu</label>
                <textarea name="description" placeholder="Ceritakan keunggulan menu ini (Lauk pauk, sambal, dll)..."
                    required
                    style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; height: 100px; outline-color: #4F46E5;">{{ old('description') }}</textarea>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px; color: #374151;">Foto Menu</label>
                <div
                    style="padding: 15px; border: 2px dashed #d1d5db; border-radius: 8px; text-align: center; background: #f9fafb;">
                    <input type="file" name="photo" required
                        style="display: block; width: 100%; font-size: 14px; color: #6b7280; file-selector-button-padding: 8px 16px; file-selector-button-border-radius: 4px; file-selector-button-border: none; file-selector-button-background: #4F46E5; file-selector-button-color: white; cursor: pointer;">
                    <p style="color: #6b7280; font-size: 12px; margin-top: 10px;">Format: JPG, PNG (Maks. 2MB)</p>
                </div>
            </div>

            <div style="display: flex; gap: 15px; align-items: center; border-top: 1px solid #eee; padding-top: 20px;">
                <button type="submit"
                    style="background: #4F46E5; color: white; padding: 12px 30px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 14px; transition: background 0.3s;">
                    🚀 Terbitkan Menu
                </button>
                <a href="{{ route('merchant.menu.index') }}"
                    style="color: #6b7280; text-decoration: none; font-size: 14px; font-weight: 600;">Batal</a>
            </div>
        </form>
    </div>
</div>