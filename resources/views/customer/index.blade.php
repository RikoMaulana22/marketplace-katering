<div style="padding: 30px; font-family: sans-serif; max-width: 1100px; margin: auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0; color: #1f2937;">Riwayat Pesanan Saya</h2>
        <a href="{{ route('customer.explore') }}"
            style="text-decoration: none; background: #4F46E5; color: white; padding: 10px 20px; border-radius: 6px; font-weight: bold; font-size: 14px;">
            + Pesan Lagi
        </a>
    </div>

    @if(session('success'))
        <div
            style="padding: 15px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 20px; border: 1px solid #bbf7d0;">
            {{ session('success') }}
        </div>
    @endif

    <div
        style="background: white; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                    <th style="padding: 15px; font-size: 14px; color: #6b7280;">ID Order</th>
                    <th style="padding: 15px; font-size: 14px; color: #6b7280;">Menu & Katering</th>
                    <th style="padding: 15px; font-size: 14px; color: #6b7280;">Tgl Pengiriman</th>
                    <th style="padding: 15px; font-size: 14px; color: #6b7280;">Total Harga</th>
                    <th style="padding: 15px; font-size: 14px; color: #6b7280;">Status</th>
                    <th style="padding: 15px; font-size: 14px; color: #6b7280; text-align: center;">Dokumen</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr style="border-bottom: 1px solid #f3f4f6;">
                        <td style="padding: 15px; font-weight: bold; color: #4F46E5;">#{{ $order->id }}</td>
                        <td style="padding: 15px;">
                            <div style="font-weight: 600; color: #374151;">
                                {{ $order->merchant->company_name ?? 'Katering' }}</div>
                            @foreach($order->items as $item)
                                <div style="font-size: 13px; color: #6b7280;">• {{ $item->menu->name }} ({{ $item->quantity }}x)
                                </div>
                            @endforeach
                        </td>
                        <td style="padding: 15px; font-size: 14px; color: #374151;">
                            {{ \Carbon\Carbon::parse($order->delivery_date)->format('d M Y') }}
                        </td>
                        <td style="padding: 15px; font-weight: bold; color: #1f2937;">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </td>
                        <td style="padding: 15px;">
                            @php
                                $statusColor = [
                                    'pending' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                                    'confirmed' => ['bg' => '#dbeafe', 'text' => '#1e40af'],
                                    'delivered' => ['bg' => '#dcfce7', 'text' => '#166534'],
                                    'cancelled' => ['bg' => '#fee2e2', 'text' => '#991b1b'],
                                ][$order->status] ?? ['bg' => '#f3f4f6', 'text' => '#374151'];
                            @endphp
                            <span
                                style="padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; background: {{ $statusColor['bg'] }}; color: {{ $statusColor['text'] }}; text-transform: uppercase;">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <a href="{{ route('orders.invoice', $order->id) }}" target="_blank"
                                style="display: inline-flex; align-items: center; gap: 5px; text-decoration: none; background: #f3f4f6; color: #4b5563; padding: 8px 12px; border-radius: 6px; font-size: 13px; font-weight: 600; border: 1px solid #d1d5db; transition: all 0.2s;"
                                onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f6'">
                                📄 Invoice
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 60px; text-align: center;">
                            <div style="font-size: 40px; margin-bottom: 10px;">🛒</div>
                            <div style="color: #6b7280; font-size: 16px;">Belum ada riwayat pesanan.</div>
                            <a href="{{ route('customer.explore') }}"
                                style="color: #4F46E5; font-weight: bold; text-decoration: none; margin-top: 10px; display: inline-block;">Cari
                                katering sekarang →</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>