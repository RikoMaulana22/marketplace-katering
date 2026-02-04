<div style="padding: 30px; font-family: sans-serif;">
    <div style="display: flex; justify-content: space-between; align-items: center; mb-20">
        <h2 style="margin: 0;">Kelola Menu Katering</h2>
        <a href="{{ route('merchant.menu.create') }}" 
           style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
           + Tambah Menu Baru
        </a>
    </div>

    <table border="1" width="100%" style="border-collapse: collapse; margin-top: 20px; border: 1px solid #ddd;">
        <thead>
            <tr style="background-color: #f8f9fa; text-align: left;">
                <th style="padding: 12px; border: 1px solid #ddd;">Foto</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Nama Menu</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Deskripsi</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Harga</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($menus as $menu)
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                        <img src="{{ asset('storage/' . $menu->photo) }}" alt="foto" style="width: 80px; height: 60px; object-fit: cover; border-radius: 4px;">
                    </td>
                    <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">{{ $menu->name }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd; color: #666;">{{ Str::limit($menu->description, 50) }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                    <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                        <a href="{{ route('merchant.menu.edit', $menu->id) }}" style="color: #2196F3; text-decoration: none; margin-right: 10px;">Edit</a>
                        
                        <form action="{{ route('merchant.menu.destroy', $menu->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus menu ini?')" style="color: #f44336; border: none; background: none; cursor: pointer; padding: 0; font-family: inherit; font-size: inherit;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 30px; text-align: center; color: #888;">
                        Anda belum memiliki menu. Silakan tambah menu pertama Anda!
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 20px;">
        <a href="{{ route('dashboard') }}" style="color: #666; text-decoration: none;">&larr; Kembali ke Dashboard</a>
    </div>
</div>