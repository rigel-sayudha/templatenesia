<x-filament-panels::page>
    <!-- Time Range Filter -->
    <div class="mb-6">
        <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <div class="space-y-3">
                <label class="text-sm font-medium text-gray-950 dark:text-white">
                    Rentang Waktu
                </label>
                <div>
                    <select 
                        wire:model.live="timeRange" 
                        class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    >
                        <option value="today">Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month">Bulan Ini</option>
                        <option value="year">Tahun Ini</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    @php
        $stats = $this->getStatistics();
    @endphp

    <!-- Statistics Cards -->
    <div class="mb-6 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
        <!-- Total Pesanan -->
        <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <div class="space-y-1">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total Pesanan
                </p>
                <p class="text-3xl font-bold text-gray-950 dark:text-white">
                    {{ $stats['totalOrders'] }}
                </p>
            </div>
        </div>

        <!-- Pembayaran Manual -->
        <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <div class="space-y-1">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                    Pembayaran Manual
                </p>
                <p class="text-3xl font-bold text-gray-950 dark:text-white">
                    Rp {{ number_format($stats['manualPayments'], 0, ',', '.') }}
                </p>
            </div>
        </div>

        <!-- Pembayaran Midtrans -->
        <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <div class="space-y-1">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                    Pembayaran Midtrans
                </p>
                <p class="text-3xl font-bold text-gray-950 dark:text-white">
                    Rp {{ number_format($stats['midtransPayments'], 0, ',', '.') }}
                </p>
            </div>
        </div>

        <!-- Total Omset -->
        <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <div class="space-y-1">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total Omset
                </p>
                <p class="text-3xl font-bold text-gray-950 dark:text-white">
                    Rp {{ number_format($stats['totalRevenue'], 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>
    <div class="rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
        <div class="border-b border-gray-200 px-5 py-4 dark:border-gray-700">
            <h3 class="text-base font-semibold text-gray-950 dark:text-white">
                Latest Orders
            </h3>
        </div>

        @php
            $orders = $this->getLatestOrders();
        @endphp

        @if (count($orders) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-800">
                            <th scope="col" class="border-r border-gray-200 px-5 py-3 text-left text-xs font-medium text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                Info Customer
                            </th>
                            <th scope="col" class="border-r border-gray-200 px-5 py-3 text-left text-xs font-medium text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                Order Number
                            </th>
                            <th scope="col" class="border-r border-gray-200 px-5 py-3 text-left text-xs font-medium text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                Total Amount
                                <svg class="ml-1 inline-block h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </th>
                            <th scope="col" class="border-r border-gray-200 px-5 py-3 text-left text-xs font-medium text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                Pembayaran
                            </th>
                            <th scope="col" class="border-r border-gray-200 px-5 py-3 text-left text-xs font-medium text-gray-700 dark:border-gray-700 dark:text-gray-300">
                                Status Pesanan
                            </th>
                            <th scope="col" class="px-5 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300">
                                Status Pembayaran
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                        @foreach ($orders as $order)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800">
                                <td class="border-r border-gray-200 whitespace-nowrap px-5 py-4 dark:border-gray-700">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $order['customer_name'] }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $order['customer_email'] }}
                                    </div>
                                </td>
                                <td class="border-r border-gray-200 whitespace-nowrap px-5 py-4 dark:border-gray-700">
                                    <div class="font-mono text-sm text-gray-900 dark:text-white">
                                        {{ $order['invoice_id'] }}
                                    </div>
                                </td>
                                <td class="border-r border-gray-200 whitespace-nowrap px-5 py-4 dark:border-gray-700">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                        Rp {{ number_format($order['total'], 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="border-r border-gray-200 whitespace-nowrap px-5 py-4 dark:border-gray-700">
                                    <span class="text-sm capitalize text-gray-700 dark:text-gray-300">
                                        {{ $order['meta']['payment_method'] ?? '-' }}
                                    </span>
                                </td>
                                <td class="border-r border-gray-200 whitespace-nowrap px-5 py-4 dark:border-gray-700">
                                    @if ($order['status'] === 'pending')
                                        <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                            Pending
                                        </span>
                                    @elseif ($order['status'] === 'paid')
                                        <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                            Paid
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                            {{ ucfirst($order['status']) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-5 py-4">
                                    @if ($order['status'] === 'paid')
                                        <span class="text-sm font-medium text-green-600 dark:text-green-400">
                                            ✅ Lunas
                                        </span>
                                    @else
                                        <span class="text-sm font-medium text-yellow-600 dark:text-yellow-400">
                                            ⏳ Menunggu
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="flex items-center justify-between border-t border-gray-200 bg-gray-50 px-5 py-3 dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-700 dark:text-gray-300">per halaman</span>
                    <select class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-12">
                <svg class="mb-3 h-12 w-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <p class="text-sm font-medium text-gray-900 dark:text-white">
                    Tidak ada data yang ditemukan
                </p>
            </div>
            
            <div class="flex items-center justify-between border-t border-gray-200 bg-gray-50 px-5 py-3 dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-700 dark:text-gray-300">per halaman</span>
                    <select class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm shadow-sm focus:border-primary-500 focus:ring-1 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
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
