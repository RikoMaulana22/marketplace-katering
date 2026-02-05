<div
    style="padding: 30px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f9fafb; min-height: 100vh;">
    <div
        style="max-width: 1100px; margin: auto; background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h2 style="margin: 0; color: #111827; font-size: 24px;">📦 Daftar Pesanan Masuk</h2>
            <div style="font-size: 14px; color: #6b7280;">Total: {{ $orders->count() }} Pesanan</div>
        </div>

        @if(session('success'))
            <div
                style="padding: 15px; background: #dcfce7; color: #166534; margin-bottom: 20px; border-radius: 8px; border-left: 5px solid #22c55e; font-weight: 500;">
                {{ session('success') }}
            </div>
        @endif

        <div style="overflow-x: auto;">
            <table width="100%" style="border-collapse: collapse; min-width: 800px;">
                <thead>
                    <tr style="text-align: left; border-bottom: 2px solid #f3f4f6;">
                        <th style="padding: 15px; color: #4b5563; font-weight: 600;">ID Order</th>
                        <th style="padding: 15px; color: #4b5563; font-weight: 600;">Nama Kantor</th>
                        <th style="padding: 15px; color: #4b5563; font-weight: 600;">Jadwal Pengiriman</th>
                        <th style="padding: 15px; color: #4b5563; font-weight: 600;">Total Harga</th>
                        <th style="padding: 15px; color: #4b5563; font-weight: 600; text-align: center;">Update Status
                        </th>
                        <th style="padding: 15px; color: #4b5563; font-weight: 600; text-align: center;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr style="border-bottom: 1px solid #f3f4f6; transition: background 0.2s;"
                            onmouseover="this.style.backgroundColor='#f9fafb'"
                            onmouseout="this.style.backgroundColor='transparent'">
                            <td style="padding: 15px;">
                                <span
                                    style="background: #eef2ff; color: #4338ca; padding: 4px 8px; border-radius: 6px; font-weight: bold; font-size: 13px;">
                                    #{{ $order->id }}
                                </span>
                            </td>
                            <td style="padding: 15px;">
                                <div style="font-weight: 600; color: #1f2937;">{{ $order->customer->name }}</div>
                                <div style="font-size: 12px; color: #6b7280;">Dipesan:
                                    {{ $order->created_at->format('d M, H:i') }}</div>
                            </td>
                            <td style="padding: 15px;">
                                <div style="display: flex; align-items: center; gap: 5px; color: #374151;">
                                    📅 <strong>{{ \Carbon\Carbon::parse($order->delivery_date)->format('d F Y') }}</strong>
                                </div>
                            </td>
                            <td style="padding: 15px;">
                                <span style="color: #059669; font-weight: 700;">Rp
                                    {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <form action="{{ route('merchant.orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()"
                                        style="padding: 8px 12px; border-radius: 8px; border: 1px solid #d1d5db; cursor: pointer; background: white; font-size: 13px; font-weight: 500;
                                            {{ $order->status == 'cancelled' ? 'color: #b91c1c; border-color: #fecaca;' : '' }}
                                            {{ $order->status == 'delivered' ? 'color: #059669; border-color: #a7f3d0;' : '' }}">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Menunggu
                                        </option>
                                        <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>✅
                                            Diterima</option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>🚚
                                            Dikirim</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌
                                            Dibatalkan</option>
                                    </select>
                                </form>
                            </td>
                            <td style="padding: 15px; text-align: center;">
                                <div style="display: flex; justify-content: center; gap: 10px;">
                                    <a href="{{ route('merchant.orders.show', $order->id) }}" title="Lihat Detail"
                                        style="padding: 8px; background: #f3f4f6; border-radius: 6px; text-decoration: none; color: #4b5563; font-size: 18px;">👁️</a>

                                    <a href="{{ route('orders.invoice', $order->id) }}" target="_blank"
                                        title="Cetak Invoice"
                                        style="padding: 8px; background: #4F46E5; border-radius: 6px; text-decoration: none; color: white; font-weight: 600; font-size: 13px; display: flex; align-items: center; gap: 5px;">
                                        📄 Invoice
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 60px; text-align: center;">
                                <div style="font-size: 50px; margin-bottom: 10px;">📥</div>
                                <div style="color: #9ca3af; font-size: 16px;">Belum ada pesanan masuk untuk Anda.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>