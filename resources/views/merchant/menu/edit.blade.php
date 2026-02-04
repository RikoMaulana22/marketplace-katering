<div style="padding: 30px; font-family: sans-serif; max-width: 600px;">
    <h2 style="margin-bottom: 20px;">Edit Menu: {{ $menu->name }}</h2>

    <form action="{{ route('merchant.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold;">Nama Menu</label>
            <input type="text" name="name" value="{{ $menu->name }}" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold;">Deskripsi</label>
            <textarea name="description" required 
                      style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; height: 100px;">{{ $menu->description }}</textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold;">Harga (Rp)</label>
            <input type="number" name="price" value="{{ $menu->price }}" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold;">Foto Menu Saat Ini</label>
            <div style="margin: 10px 0;">
                <img src="{{ asset('storage/' . $menu->photo) }}" width="150" 
                     style="border-radius: 8px; border: 1px solid #ddd;">
            </div>
            <label style="display: block; font-weight: bold; margin-top: 10px;">Ganti Foto (Opsional)</label>
            <input type="file" name="photo" style="margin-top: 5px;">
            <small style="color: #666; display: block;">Biarkan kosong jika tidak ingin mengganti foto.</small>
        </div>

        <div style="margin-top: 25px;">
            <button type="submit" 
                    style="background-color: #2196F3; color: white; padding: 10px 25px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
                Update Menu
            </button>
            <a href="{{ route('merchant.menu.index') }}" 
               style="margin-left: 10px; color: #666; text-decoration: none;">Batal</a>
        </div>
    </form>
</div>