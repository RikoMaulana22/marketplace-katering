<div style="padding: 30px; font-family: sans-serif; background-color: #f9fafb; min-height: 100vh;">
    <div style="max-width: 1200px; margin: auto;">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2 style="margin: 0; color: #111827;">Jelajah Menu Katering</h2>
            <a href="{{ route('dashboard') }}" style="text-decoration: none; color: #4F46E5; font-size: 14px;">&larr;
                Kembali ke Dashboard</a>
        </div>

        <form action="{{ route('customer.explore') }}" method="GET"
            style="margin-bottom: 30px; display: flex; flex-wrap: wrap; gap: 10px;">
            <input type="text" name="search" placeholder="Cari menu atau katering..." value="{{ request('search') }}"
                style="padding: 12px; flex: 2; min-width: 250px; border: 1px solid #d1d5db; border-radius: 6px; outline: none;">

            <select name="location"
                style="padding: 12px; flex: 1; min-width: 150px; border: 1px solid #d1d5db; border-radius: 6px; background: white;">
                <option value="">Semua Lokasi</option>
                <option value="Jakarta" {{ request('location') == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                <option value="Bandung" {{ request('location') == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                <option value="Surabaya" {{ request('location') == 'Surabaya' ? 'selected' : '' }}>Surabaya</option>
            </select>

            <select name="category"
                style="padding: 12px; flex: 1; min-width: 150px; border: 1px solid #d1d5db; border-radius: 6px; background: white;">
                <option value="">Semua Jenis</option>
                <option value="Prasmanan" {{ request('category') == 'Prasmanan' ? 'selected' : '' }}>Prasmanan</option>
                <option value="Nasi Kotak" {{ request('category') == 'Nasi Kotak' ? 'selected' : '' }}>Nasi Kotak</option>
                <option value="Snack Box" {{ request('category') == 'Snack Box' ? 'selected' : '' }}>Snack Box</option>
            </select>

            <button type="submit"
                style="padding: 12px 24px; background: #4F46E5; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">
                Cari & Filter
            </button>

            @if(request()->anyFilled(['search', 'location', 'category']))
                <a href="{{ route('customer.explore') }}"
                    style="padding: 12px; color: #ef4444; text-decoration: none; font-size: 14px;">Bersihkan Filter</a>
            @endif
        </form>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px;">
            @forelse($menus as $m)
                <div
                    style="border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; background: white; transition: transform 0.2s; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                    <div style="background-color: #f3f4f6; height: 180px; position: relative;">
                        @if($m->photo)
                            <img src="{{ asset('storage/' . $m->photo) }}"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div
                                style="display: flex; align-items: center; justify-content: center; height: 100%; color: #9ca3af;">
                                Tidak ada foto</div>
                        @endif
                        <span
                            style="position: absolute; top: 10px; right: 10px; background: rgba(79, 70, 229, 0.9); color: white; padding: 4px 8px; border-radius: 4px; font-size: 10px; font-weight: bold;">
                            {{ $m->category ?? 'Umum' }}
                        </span>
                    </div>

                    <div style="padding: 20px;">
                        <h3 style="margin: 0 0 5px 0; color: #1f2937; font-size: 18px;">{{ $m->name }}</h3>
                        <p style="color: #6b7280; font-size: 13px; margin: 0 0 5px 0;">
                            🏢 <strong>{{ $m->merchant->company_name ?? 'Katering Umum' }}</strong>
                        </p>
                        <p style="color: #9ca3af; font-size: 12px; margin: 0 0 15px 0;">
                            📍 {{ Str::limit($m->merchant->address, 40) }}
                        </p>

                        <div
                            style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f3f4f6; pt-15px; margin-top: 10px; padding-top: 15px;">
                            <span style="font-weight: 700; color: #059669; font-size: 16px;">
                                Rp {{ number_format($m->price, 0, ',', '.') }}
                            </span>
                            <a href="{{ route('customer.checkout', $m->id) }}"
                                style="padding: 8px 16px; background: #4F46E5; color: white; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 600;">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    style="grid-column: 1 / -1; text-align: center; padding: 50px; background: white; border-radius: 12px; border: 1px dashed #ccc;">
                    <p style="color: #6b7280; font-size: 16px;">Maaf, menu tidak ditemukan dengan kriteria tersebut.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>