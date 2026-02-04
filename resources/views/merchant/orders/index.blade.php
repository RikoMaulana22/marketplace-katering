<div style="padding: 20px;">
    <h2>Daftar Pesanan Masuk</h2>
    <table border="1" width="100%" style="border-collapse: collapse; margin-top: 10px;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 10px;">ID Order</th>
                <th style="padding: 10px;">Nama Kantor</th>
                <th style="padding: 10px;">Tanggal Pengiriman</th>
                <th style="padding: 10px;">Total Harga</th>
                <th style="padding: 10px;">Status</th>
                <th style="padding: 10px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td style="padding: 10px; text-align: center;">#{{ $order->id }}</td>
                    <td style="padding: 10px;">{{ $order->customer->name }}</td>
                    <td style="padding: 10px; text-align: center;">{{ $order->delivery_date }}</td>
                    <td style="padding: 10px;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td style="padding: 10px; text-align: center;">
                        <span style="padding: 5px; background: #eee; border-radius: 5px;">{{ $order->status }}</span>
                    </td>
                    <td style="padding: 10px; text-align: center;">
                        <a href="{{ route('merchant.orders.show', $order->id) }}">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding: 20px; text-align: center;">Belum ada pesanan masuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>