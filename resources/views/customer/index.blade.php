<div style="padding: 30px; font-family: sans-serif; max-width: 1000px; margin: auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0; color: #1f2937;">Riwayat Pesanan Saya</h2>
        <a href="{{ route('customer.explore') }}" style="text-decoration: none; background: #4F46E5; color: white; padding: 10px 20px; border-radius: 6px; font-weight: bold;">
            + Pesan Lagi
        </a>
    </div>

    @if(session('success'))
        <div style="padding: 15px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 20px; border: 1px solid #bbf7d0;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: white; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                    <th style="padding: 15px;">ID Order</th>
                    <th style="padding: 15px;">Menu</th>
                    <th style="padding: 15px;">Tgl Pengiriman</th>
                    <th style="padding: 15px;">Total Harga</th>
                    <th style="padding: 15px;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr style="border-bottom: 1px solid #f3f4f6;">
                        <td style="padding: 15px; font-weight: bold; color: #4F46E5;">#{{ $order->id }}</td>
                        <td style="padding: 15px;">
                            @foreach($order->items as $item)
                                <div>{{ $item->menu->name }} ({{ $item->quantity }}x)</div>
                            @endforeach
                        </td>
                        <td style="padding: 15px;">{{ \Carbon\Carbon::parse($order->delivery_date)->format('d M Y') }}</td>
                        <td style="padding: 15px; font-weight: bold;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td style="padding: 15px;">
                            @php
                                $statusColor = [
                                    'pending' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                                    'confirmed' => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                                    'delivered' => ['bg' => '#dcfce7', 'text' => '#166534'],
                                    'cancelled' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                                ][$order->status] ?? ['bg' => '#f3f4f6', 'text' => '#374151'];
                            @endphp
                            <span style="padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; background: {{ $statusColor['bg'] }}; color: {{ $statusColor['text'] }}; text-transform: uppercase;">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 40px; text-align: center; color: #6b7280;">
                            Belum ada riwayat pesanan. <br>
                            <a href="{{ route('customer.explore') }}" style="color: #4F46E5;">Cari menu sekarang?</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>