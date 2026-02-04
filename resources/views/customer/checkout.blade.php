<div style="padding: 30px; font-family: sans-serif; max-width: 600px; margin: auto;">
    <div style="border: 1px solid #ddd; padding: 25px; border-radius: 12px; background: white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        <h2 style="margin-top: 0; color: #111827;">Konfirmasi Pesanan</h2>
        <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 20px;">
        
        <div style="display: flex; gap: 20px; margin-bottom: 25px;">
            <img src="{{ asset('storage/' . $menu->photo) }}" width="150" style="border-radius: 8px; object-fit: cover; height: 110px;">
            <div>
                <h3 style="margin: 0; color: #1f2937;">{{ $menu->name }}</h3>
                <p style="color: #6b7280; font-size: 14px; margin: 5px 0;">🏢 {{ $m->merchant->company_name ?? 'Katering Umum' }}</p>
                <p style="font-weight: bold; color: #059669; font-size: 18px; margin-top: 10px;">Rp {{ number_format($menu->price, 0, ',', '.') }} <span style="font-size: 12px; color: #6b7280; font-weight: normal;">/ porsi</span></p>
            </div>
        </div>

        <form action="{{ route('customer.checkout.store') }}" method="POST">
            @csrf
            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #374151;">Jumlah Porsi</label>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <input type="number" name="quantity" min="1" value="1" required 
                           style="width: 100px; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; text-align: center;">
                    <span style="color: #6b7280;">Porsi</span>
                </div>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #374151;">Tanggal Pengiriman</label>
                <input type="date" name="delivery_date" required 
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;">
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px;">
                <button type="submit" style="width: 100%; background: #4F46E5; color: white; padding: 14px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 16px; transition: background 0.2s;">
                    🚀 Konfirmasi & Pesan Sekarang
                </button>
                
                <div style="display: flex; gap: 10px;">
                    <a href="{{ route('customer.explore') }}" style="flex: 1; text-align: center; padding: 12px; background: #f3f4f6; color: #374151; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; border: 1px solid #d1d5db;">
                        Kembali
                    </a>
                    <a href="#" style="flex: 1; text-align: center; padding: 12px; background: white; color: #4F46E5; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; border: 1px solid #4F46E5;">
                        Tanya Penjual
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>