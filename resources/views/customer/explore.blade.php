<div style="padding: 30px; font-family: sans-serif; background-color: #f9fafb; min-height: 100vh;">
    <div style="max-width: 1200px; margin: auto;">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2 style="margin: 0; color: #111827;">Jelajah Menu Katering</h2>
            <a href="{{ route('dashboard') }}" style="text-decoration: none; color: #4F46E5; font-size: 14px;">&larr;
                Kembali ke Dashboard</a>
        </div>

        <form action="{{ route('customer.explore') }}" method="GET"
            style="margin-bottom: 30px; display: flex; gap: 10px;">
            <input type="text" name="search" placeholder="Cari menu atau katering..." value="{{ request('search') }}"
                style="padding: 12px; width: 100%; max-width: 400px; border: 1px solid #d1d5db; border-radius: 6px; outline: none;">
            <button type="submit"
                style="padding: 12px 24px; background: #4F46E5; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('customer.explore') }}"
                    style="padding: 12px; color: #6b7280; text-decoration: none;">Reset</a>
            @endif
        </form>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px;">
            @forelse($menus as $m)
                <div
                    style="border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; background: white; transition: transform 0.2s; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">

                    <div style="background-color: #f3f4f6; height: 180px;">
                        @if($m->photo)
                            <img src="{{ asset('storage/' . $m->photo) }}"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div
                                style="display: flex; align-items: center; justify-content: center; height: 100%; color: #9ca3af;">
                                Tidak ada foto</div>
                        @endif
                    </div>

                    <div style="padding: 20px;">
                        <h3 style="margin: 0 0 5px 0; color: #1f2937; font-size: 18px;">{{ $m->name }}</h3>
                        <p style="color: #6b7280; font-size: 14px; margin: 0 0 15px 0;">
                            🏢 {{ $m->merchant->company_name ?? 'Katering Umum' }}
                        </p>

                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-weight: 700; color: #059669; font-size: 16px;">
                                Rp {{ number_format($m->price, 0, ',', '.') }}
                            </span>
                            <a href="{{ route('customer.checkout', $m->id) }}"
                                style="padding: 8px 16px; background: #4F46E5; color: white; text-decoration: none; border-radius: 6px; font-size: 14px; font-weight: 600;">
                                Pilih Menu
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    style="grid-column: 1 / -1; text-align: center; padding: 50px; background: white; border-radius: 12px; border: 1px dashed #ccc;">
                    <p style="color: #6b7280; font-size: 16px;">Maaf, menu "{{ request('search') }}" tidak ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>