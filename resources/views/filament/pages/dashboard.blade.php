<x-filament-panels::page class="space-y-6">
    <div class="flex items-end gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Rentang Waktu
            </label>
            <select 
                wire:model.live="timeRange" 
                class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
            >
                <option value="today">Hari Ini</option>
                <option value="week">Minggu Ini</option>
                <option value="month">Bulan Ini</option>
                <option value="year">Tahun Ini</option>
            </select>
        </div>
    </div>

    @php
        $stats = $this->getStatistics();
    @endphp

    <!-- Statistics Cards -->
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Pesanan -->
        <div class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
            <p class="text-xs font-medium text-gray-600 dark:text-gray-400">Total Pesanan</p>
            <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['totalOrders'] }}</p>
        </div>

        <!-- Pembayaran Manual -->
        <div class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
            <p class="text-xs font-medium text-gray-600 dark:text-gray-400">Pembayaran Manual</p>
            <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($stats['manualPayments'], 0, ',', '.') }}</p>
        </div>

        <!-- Pembayaran Midtrans -->
        <div class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
            <p class="text-xs font-medium text-gray-600 dark:text-gray-400">Pembayaran Midtrans</p>
            <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($stats['midtransPayments'], 0, ',', '.') }}</p>
        </div>

        <!-- Total Omset -->
        <div class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
            <p class="text-xs font-medium text-gray-600 dark:text-gray-400">Total Omset</p>
            <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($stats['totalRevenue'], 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="rounded-lg border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
        <div class="border-b border-gray-200 px-4 py-3 dark:border-gray-700">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">
                Latest Orders
            </h3>
        </div>

        @php
            $orders = $this->getLatestOrders();
        @endphp

        @if (count($orders) > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-900">
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 dark:text-gray-300">Info Customer</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 dark:text-gray-300">Order Number</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 dark:text-gray-300">Total Amount</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 dark:text-gray-300">Pembayaran</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 dark:text-gray-300">Status Pesanan</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 dark:text-gray-300">Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($orders as $order)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="whitespace-nowrap px-4 py-2">
                                    <div class="text-xs font-medium text-gray-900 dark:text-white">{{ $order['customer_name'] }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $order['customer_email'] }}</div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-2 text-xs font-mono text-gray-900 dark:text-white">{{ $order['invoice_id'] }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-xs font-semibold text-gray-900 dark:text-white">Rp {{ number_format($order['total'], 0, ',', '.') }}</td>
                                <td class="whitespace-nowrap px-4 py-2 text-xs text-gray-700 dark:text-gray-300">{{ $order['meta']['payment_method'] ?? '-' }}</td>
                                <td class="whitespace-nowrap px-4 py-2">
                                    @if ($order['status'] === 'pending')
                                        <span class="inline-block rounded-full bg-yellow-100 px-2 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">⏳ Pending</span>
                                    @elseif ($order['status'] === 'paid')
                                        <span class="inline-block rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900/30 dark:text-green-300">✅ Paid</span>
                                    @else
                                        <span class="inline-block rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900/30 dark:text-red-300">{{ ucfirst($order['status']) }}</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-2">
                                    @if ($order['status'] === 'paid')
                                        <span class="text-xs font-medium text-green-600 dark:text-green-400">✅ Lunas</span>
                                    @else
                                        <span class="text-xs font-medium text-yellow-600 dark:text-yellow-400">⏳ Menunggu</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="border-t border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-900">
                <div class="flex items-center gap-2">
                    <span class="text-xs text-gray-700 dark:text-gray-300">per halaman</span>
                    <select class="rounded border border-gray-300 bg-white px-2 py-1 text-xs dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-8 text-center">
                <svg class="mb-2 h-10 w-10 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <p class="text-xs font-medium text-gray-600 dark:text-gray-400">No orders found</p>
            </div>
            
            <div class="border-t border-gray-200 bg-gray-50 px-4 py-3 dark:border-gray-700 dark:bg-gray-900">
                <div class="flex items-center gap-2">
                    <span class="text-xs text-gray-700 dark:text-gray-300">per halaman</span>
                    <select class="rounded border border-gray-300 bg-white px-2 py-1 text-xs dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>
            </div>
        @endif
    </div>
</x-filament-panels::page>
