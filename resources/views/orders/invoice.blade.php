<style>
    @media print {
        .no-print {
            display: none;
        }

        body {
            padding: 0;
            background: #fff;
        }
    }

    .status-badge {
        padding: 5px 12px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-paid {
        background: #d1fae5;
        color: #065f46;
    }

    .status-cancelled {
        background: #fee2e2;
        color: #991b1b;
    }
</style>

<div
    style="padding: 40px; font-family: 'Courier New', Courier, monospace; max-width: 800px; margin: auto; border: 1px solid #eee; background: #fff; position: relative;">

    @if($order->status == 'paid')
        <div
            style="position: absolute; top: 100px; right: 50px; border: 4px solid #059669; color: #059669; padding: 10px 20px; font-size: 30px; font-weight: bold; transform: rotate(-15deg); opacity: 0.3; border-radius: 10px;">
            LUNAS
        </div>
    @endif

    <div style="text-align: center; margin-bottom: 30px;">
        <h1 style="margin: 0;">INVOICE</h1>
        <p style="color: #666;">No: #INV-{{ $order->id }}-{{ $order->created_at->format('Ymd') }}</p>
    </div>

    <div style="display: flex; justify-content: space-between; margin-bottom: 40px;">
        <div>
            <strong>Dari (Merchant):</strong><br>
            <span
                style="font-size: 18px; font-weight: bold;">{{ $order->merchant->company_name ?? 'Nama Toko' }}</span><br>
            {{ $order->merchant->address ?? 'Alamat belum diatur' }}<br>
            📞 Telp/WA: {{ $order->merchant->contact ?? '-' }}
        </div>
        <div style="text-align: right;">
            <strong>Kepada (Customer):</strong><br>
            <span style="font-size: 16px;">{{ $order->customer->name }}</span><br>
            Tgl Pesan: {{ $order->created_at->format('d/m/Y') }}<br>
            <strong style="color: #4F46E5;">Tgl Pengiriman:
                {{ \Carbon\Carbon::parse($order->delivery_date)->format('d/m/Y') }}</strong>
        </div>
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
        <thead>
            <tr style="border-bottom: 2px solid #000;">
                <th style="text-align: left; padding: 10px;">Menu Makanan</th>
                <th style="text-align: center; padding: 10px;">Porsi</th>
                <th style="text-align: right; padding: 10px;">Harga</th>
                <th style="text-align: right; padding: 10px;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px;">{{ $item->menu->name ?? 'Menu Terhapus' }}</td>
                    <td style="text-align: center; padding: 10px;">{{ $item->quantity }} x</td>
                    <td style="text-align: right; padding: 10px;">Rp
                        {{ number_format($item->price_at_purchase, 0, ',', '.') }}</td>
                    <td style="text-align: right; padding: 10px;">Rp
                        {{ number_format($item->quantity * $item->price_at_purchase, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right; padding: 20px 10px; font-weight: bold; font-size: 18px;">TOTAL
                    BAYAR:</td>
                <td style="text-align: right; padding: 20px 10px; font-weight: bold; font-size: 18px; color: #4F46E5;">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
    </table>

    <div style="margin-bottom: 30px;">
        <p style="margin-bottom: 5px;"><strong>Keterangan/Instruksi Pengiriman:</strong></p>
        <div style="border: 1px solid #eee; padding: 10px; min-height: 50px; color: #555;">
            {{ $order->notes ?? 'Tidak ada catatan tambahan.' }}
        </div>
    </div>

    <div style="background-color: #f9fafb; padding: 15px; border-radius: 8px; font-size: 13px;">
        <p style="margin: 0;"><strong>Metode Pembayaran:</strong> Transfer Bank / Cash on Delivery</p>
        <p style="margin: 5px 0 0 0;">Silakan hubungi Merchant di nomor di atas untuk konfirmasi pembayaran.</p>
    </div>

    <div class="no-print"
        style="margin-top: 50px; border-top: 1px dashed #ccc; padding-top: 20px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            Status:
            <span
                class="status-badge {{ $order->status == 'paid' ? 'status-paid' : ($order->status == 'cancelled' ? 'status-cancelled' : 'status-pending') }}">
                {{ $order->status }}
            </span>
        </div>
        <div>
            <button onclick="window.print()"
                style="padding: 10px 20px; background: #4F46E5; color: #fff; cursor: pointer; border: none; border-radius: 4px; font-weight: bold;">
                🖨️ Cetak Invoice
            </button>
            <a href="javascript:history.back()"
                style="margin-left: 10px; color: #666; text-decoration: none; border: 1px solid #ccc; padding: 9px 18px; border-radius: 4px; display: inline-block;">
                Kembali
            </a>
        </div>
    </div>
</div>