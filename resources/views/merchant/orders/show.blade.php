<div class="invoice-box">
    <h2>Detail Pesanan #{{ $order->id }}</h2>
    <hr>
    
    <div style="margin-bottom: 20px;">
        <strong>Informasi Pemesan:</strong><br>
        Nama Kantor: {{ $order->customer->name }}<br>
        Email: {{ $order->customer->email }}<br>
        Tanggal Pengiriman: <strong>{{ \Carbon\Carbon::parse($order->delivery_date)->format('d F Y') }}</strong>
    </div>

    <table width="100%" border="1" cellpadding="10" style="border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f4f4f4;">
                <th>Menu</th>
                <th>Harga Satuan</th>
                <th>Jumlah (Qty)</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->menu->name }}</td>
                <td>Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}</td>
                <td>{{ $item->quantity }} Porsi</td>
                <td>Rp {{ number_format($item->price_at_purchase * $item->quantity, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="font-weight: bold; background-color: #f4f4f4;">
                <td colspan="3" align="right">Total Bayar</td>
                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <div style="margin-top: 20px;">
        <p>Status Pesanan: <strong>{{ strtoupper($order->status) }}</strong></p>
        <a href="{{ route('merchant.orders.index') }}">← Kembali ke Daftar Order</a>
    </div>
</div>