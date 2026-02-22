<x-filament-panels::page>

<style>
 
    .fi-dash-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    @media (min-width: 1024px) {
        .fi-dash-stats { grid-template-columns: repeat(4, 1fr); }
    }

    .fi-stat-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 1.25rem 1.25rem 1rem;
    }
    .dark .fi-stat-card { background: #1f2937; border-color: #374151; }

    .fi-stat-label {
        font-size: 0.75rem;
        font-weight: 500;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }
    .dark .fi-stat-label { color: #9ca3af; }

    .fi-stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        line-height: 1;
    }
    .dark .fi-stat-value { color: #f9fafb; }

    .fi-stat-value.sm {
        font-size: 1rem;
        font-weight: 700;
    }

    .fi-dash-main {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    @media (min-width: 1024px) {
        .fi-dash-main { grid-template-columns: 1fr 288px; }
    }

    .fi-table-wrap {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        overflow: hidden;
    }
    .dark .fi-table-wrap { background: #1f2937; border-color: #374151; }

    .fi-tbl-head {
        padding: 0.875rem 1.25rem;
        border-bottom: 1px solid #f3f4f6;
    }
    .dark .fi-tbl-head { border-color: #374151; }

    .fi-tbl-title { font-size: 0.875rem; font-weight: 600; color: #111827; }
    .dark .fi-tbl-title { color: #f9fafb; }
    .fi-tbl-sub { font-size: 0.75rem; color: #6b7280; margin-top: 1px; }
    .dark .fi-tbl-sub { color: #9ca3af; }

    .fi-table { width: 100%; border-collapse: collapse; }

    .fi-table thead tr {
        border-bottom: 1px solid #f3f4f6;
    }
    .dark .fi-table thead tr { border-color: #374151; }

    .fi-table thead th {
        padding: 0.625rem 1rem;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 600;
        color: #374151;
        white-space: nowrap;
    }
    .dark .fi-table thead th { color: #d1d5db; }

    .fi-table tbody tr {
        border-bottom: 1px solid #f9fafb;
        transition: background 0.1s;
    }
    .dark .fi-table tbody tr { border-color: #374151; }
    .fi-table tbody tr:last-child { border-bottom: none; }
    .fi-table tbody tr:hover { background: #f9fafb; }
    .dark .fi-table tbody tr:hover { background: rgba(55,65,81,0.3); }

    .fi-table td {
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        color: #374151;
        vertical-align: middle;
    }
    .dark .fi-table td { color: #d1d5db; }

    .fi-cust-name { font-size: 0.875rem; font-weight: 500; color: #111827; }
    .dark .fi-cust-name { color: #f3f4f6; }
    .fi-cust-email { font-size: 0.75rem; color: #6b7280; }
    .dark .fi-cust-email { color: #9ca3af; }

    .fi-invoice {
        font-family: ui-monospace, 'SF Mono', monospace;
        font-size: 0.8rem;
        color: #374151;
    }
    .dark .fi-invoice { color: #d1d5db; }

    .fi-amount { font-size: 0.875rem; font-weight: 500; color: #111827; }
    .dark .fi-amount { color: #f3f4f6; }

    .fi-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 9999px;
        padding: 0.1rem 0.55rem;
        font-size: 0.7rem;
        font-weight: 600;
        border-width: 1px;
        border-style: solid;
    }
    .fi-badge-pending {
        background: #fef3c7;
        color: #92400e;
        border-color: #fde68a;
    }
    .dark .fi-badge-pending { background: rgba(120,53,15,0.3); color: #fcd34d; border-color: rgba(120,53,15,0.5); }
    .fi-badge-paid {
        background: #dcfce7;
        color: #166534;
        border-color: #bbf7d0;
    }
    .dark .fi-badge-paid { background: rgba(20,83,45,0.3); color: #86efac; border-color: rgba(20,83,45,0.5); }
    .fi-badge-other {
        background: #fee2e2;
        color: #991b1b;
        border-color: #fecaca;
    }
    .dark .fi-badge-other { background: rgba(127,29,29,0.3); color: #fca5a5; border-color: rgba(127,29,29,0.5); }

    .fi-tbl-foot {
        padding: 0.75rem 1rem;
        border-top: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .dark .fi-tbl-foot { border-color: #374151; }
    .fi-tbl-foot p { font-size: 0.75rem; color: #6b7280; }
    .dark .fi-tbl-foot p { color: #9ca3af; }
    .fi-tbl-foot select {
        font-size: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.2rem 0.5rem;
        background: #fff;
        color: #374151;
    }
    .dark .fi-tbl-foot select { background: #374151; border-color: #4b5563; color: #d1d5db; }

    .fi-sidebar-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        padding: 1.25rem;
        margin-bottom: 1rem;
    }
    .dark .fi-sidebar-card { background: #1f2937; border-color: #374151; }

    .fi-sidebar-title { font-size: 0.875rem; font-weight: 600; color: #111827; margin-bottom: 0.25rem; }
    .dark .fi-sidebar-title { color: #f9fafb; }
    .fi-sidebar-sub { font-size: 0.75rem; color: #6b7280; margin-bottom: 1rem; }
    .dark .fi-sidebar-sub { color: #9ca3af; }

    .fi-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f3f4f6;
        font-size: 0.8125rem;
    }
    .dark .fi-row { border-color: #374151; }
    .fi-row:last-child { border-bottom: none; }
    .fi-row-label { color: #6b7280; }
    .dark .fi-row-label { color: #9ca3af; }
    .fi-row-val { font-weight: 600; color: #111827; }
    .dark .fi-row-val { color: #f3f4f6; }
    .fi-row-val.green { color: #16a34a; }
    .dark .fi-row-val.green { color: #4ade80; }

    .fi-prog-row { margin-bottom: 0.75rem; }
    .fi-prog-label { display: flex; justify-content: space-between; font-size: 0.75rem; margin-bottom: 0.25rem; }
    .fi-prog-label span:first-child { color: #6b7280; }
    .dark .fi-prog-label span:first-child { color: #9ca3af; }
    .fi-prog-label span:last-child { font-weight: 600; color: #374151; }
    .dark .fi-prog-label span:last-child { color: #d1d5db; }
    .fi-prog-track { height: 0.35rem; background: #f3f4f6; border-radius: 9999px; overflow: hidden; }
    .dark .fi-prog-track { background: #374151; }
    .fi-prog-fill { height: 100%; border-radius: 9999px; }

    .fi-empty { display: flex; flex-direction: column; align-items: center; padding: 3rem 1rem; text-align: center; }
    .fi-empty svg { color: #d1d5db; margin-bottom: 0.75rem; }
    .dark .fi-empty svg { color: #4b5563; }
    .fi-empty p { font-size: 0.875rem; color: #6b7280; }
    .dark .fi-empty p { color: #9ca3af; }

    .fi-range-select {
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        padding: 0.4rem 0.75rem;
        font-size: 0.875rem;
        background: #fff;
        color: #374151;
        outline: none;
    }
    .dark .fi-range-select { background: #374151; border-color: #4b5563; color: #d1d5db; }
</style>

    <div style="display:flex; justify-content:flex-end; margin-bottom:0.25rem;">
        <select wire:model.live="timeRange" class="fi-range-select">
            <option value="today">Hari Ini</option>
            <option value="week">Minggu Ini</option>
            <option value="month">Bulan Ini</option>
            <option value="year">Tahun Ini</option>
        </select>
    </div>

    @php
        $stats = $this->getStatistics();
    @endphp

    {{-- Stat Cards --}}
    <div class="fi-dash-stats">
        <div class="fi-stat-card">
            <p class="fi-stat-label">Total Pesanan</p>
            <p class="fi-stat-value">{{ $stats['totalOrders'] }}</p>
        </div>
        <div class="fi-stat-card">
            <p class="fi-stat-label">Pembayaran Manual</p>
            <p class="fi-stat-value sm">Rp {{ number_format($stats['manualPayments'], 0, ',', '.') }}</p>
        </div>
        <div class="fi-stat-card">
            <p class="fi-stat-label">Pembayaran Midtrans</p>
            <p class="fi-stat-value sm">Rp {{ number_format($stats['midtransPayments'], 0, ',', '.') }}</p>
        </div>
        <div class="fi-stat-card">
            <p class="fi-stat-label">Total Omset</p>
            <p class="fi-stat-value sm" style="color:#16a34a;">Rp {{ number_format($stats['totalRevenue'], 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Main Grid --}}
    <div class="fi-dash-main">

        {{-- Table --}}
        <div class="fi-table-wrap">
            <div class="fi-tbl-head">
                <p class="fi-tbl-title">Pesanan Terbaru</p>
                <p class="fi-tbl-sub">Ringkasan pesanan terbaru yang masuk ke sistem</p>
            </div>

            @php $orders = $this->getLatestOrders(); @endphp

            @if (count($orders) > 0)
                <div style="overflow-x:auto;">
                    <table class="fi-table">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>No. Invoice</th>
                                <th>Total</th>
                                <th>Metode</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <div class="fi-cust-name">{{ $order['customer_name'] }}</div>
                                        <div class="fi-cust-email">{{ $order['customer_email'] }}</div>
                                    </td>
                                    <td>
                                        <span class="fi-invoice">{{ $order['invoice_id'] }}</span>
                                    </td>
                                    <td>
                                        <span class="fi-amount">Rp {{ number_format($order['total'], 0, ',', '.') }}</span>
                                    </td>
                                    <td>{{ ucfirst($order['meta']['payment_method'] ?? '-') }}</td>
                                    <td>
                                        @if ($order['status'] === 'paid')
                                            <span class="fi-badge fi-badge-paid">paid</span>
                                        @elseif ($order['status'] === 'pending')
                                            <span class="fi-badge fi-badge-pending">pending</span>
                                        @else
                                            <span class="fi-badge fi-badge-other">{{ $order['status'] }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="fi-tbl-foot">
                    <p>Menampilkan {{ count($orders) }} pesanan terbaru</p>
                    <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.75rem;color:#6b7280;">
                        <span>Per halaman</span>
                        <select class="fi-tbl-foot select">
                            <option>10</option><option>25</option><option>50</option><option>100</option>
                        </select>
                    </div>
                </div>
            @else
                <div class="fi-empty">
                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <p>Belum ada pesanan</p>
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div>
            {{-- Ringkasan --}}
            <div class="fi-sidebar-card">
                <p class="fi-sidebar-title">Ringkasan Pesanan</p>
                <p class="fi-sidebar-sub">Berdasarkan periode yang dipilih</p>
                <div>
                    <div class="fi-row">
                        <span class="fi-row-label">Total Pesanan</span>
                        <span class="fi-row-val">{{ $stats['totalOrders'] }}</span>
                    </div>
                    <div class="fi-row">
                        <span class="fi-row-label">Manual</span>
                        <span class="fi-row-val">Rp {{ number_format($stats['manualPayments'], 0, ',', '.') }}</span>
                    </div>
                    <div class="fi-row">
                        <span class="fi-row-label">Midtrans</span>
                        <span class="fi-row-val">Rp {{ number_format($stats['midtransPayments'], 0, ',', '.') }}</span>
                    </div>
                    <div class="fi-row">
                        <span class="fi-row-label">Total Omset</span>
                        <span class="fi-row-val green">Rp {{ number_format($stats['totalRevenue'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Status Breakdown --}}
            @php
                $paidCount   = collect($orders)->where('status', 'paid')->count();
                $pendingCount = collect($orders)->where('status', 'pending')->count();
                $otherCount  = count($orders) - $paidCount - $pendingCount;
                $totalCount  = max(count($orders), 1);
            @endphp
            <div class="fi-sidebar-card" style="margin-bottom:0;">
                <p class="fi-sidebar-title">Status Pesanan</p>
                <p class="fi-sidebar-sub">Distribusi status pesanan terbaru</p>
                <div>
                    <div class="fi-prog-row">
                        <div class="fi-prog-label">
                            <span>Paid</span>
                            <span>{{ $paidCount }}</span>
                        </div>
                        <div class="fi-prog-track">
                            <div class="fi-prog-fill" style="width:{{ round($paidCount / $totalCount * 100) }}%;background:#22c55e;"></div>
                        </div>
                    </div>
                    <div class="fi-prog-row">
                        <div class="fi-prog-label">
                            <span>Pending</span>
                            <span>{{ $pendingCount }}</span>
                        </div>
                        <div class="fi-prog-track">
                            <div class="fi-prog-fill" style="width:{{ round($pendingCount / $totalCount * 100) }}%;background:#f59e0b;"></div>
                        </div>
                    </div>
                    @if($otherCount > 0)
                    <div class="fi-prog-row" style="margin-bottom:0;">
                        <div class="fi-prog-label">
                            <span>Lainnya</span>
                            <span>{{ $otherCount }}</span>
                        </div>
                        <div class="fi-prog-track">
                            <div class="fi-prog-fill" style="width:{{ round($otherCount / $totalCount * 100) }}%;background:#ef4444;"></div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

</x-filament-panels::page>
