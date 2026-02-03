<div style="font-family: Inter, system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;">
    <h2>Terima kasih atas pembelian Anda</h2>
    <p>Invoice: <strong>{{ $order->invoice_id }}</strong></p>
    <p>Produk: <strong>{{ $order->product->title ?? 'N/A' }}</strong></p>
    <p>Jumlah: {{ $order->quantity }}</p>
    <p>Total: Rp {{ number_format($order->total,0,',','.') }}</p>
    <p>Status: {{ $order->status }}</p>
    <p>Jika ada pertanyaan, balas email ini atau hubungi admin.</p>
</div>
