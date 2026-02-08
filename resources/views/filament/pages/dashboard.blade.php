<x-filament-panels::page>
    <!-- Time Range Filter -->
    <div class="mb-8">
        <div class="inline-block">
            <label class="block text-sm font-semibold text-gray-900 dark:text-white mb-2">
                Rentang Waktu
            </label>
            <select 
                wire:model.live="timeRange" 
                class="block rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
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
    <div class="mb-8 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        <!-- Total Pesanan -->
        <div class="group rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                        Total Pesanan
                    </p>
                    <p class="mt-2 text-3xl font-bold text-gray-950 dark:text-white">
                        {{ $stats['totalOrders'] }}
                    </p>
                </div>
                <div class="rounded-lg bg-blue-100 p-3 dark:bg-blue-900">
                    <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4l1-12z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pembayaran Manual -->
        <div class="group rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                        Pembayaran Manual
                    </p>
                    <p class="mt-2 text-3xl font-bold text-gray-950 dark:text-white">
                        Rp {{ number_format($stats['manualPayments'], 0, ',', '.') }}
                    </p>
                </div>
                <div class="rounded-lg bg-orange-100 p-3 dark:bg-orange-900">
                    <svg class="h-6 w-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pembayaran Midtrans -->
        <div class="group rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                        Pembayaran Midtrans
                    </p>
                    <p class="mt-2 text-3xl font-bold text-gray-950 dark:text-white">
                        Rp {{ number_format($stats['midtransPayments'], 0, ',', '.') }}
                    </p>
                </div>
                <div class="rounded-lg bg-green-100 p-3 dark:bg-green-900">
                    <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h10m4 0a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Omset -->
        <div class="group rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                        Total Omset
                    </p>
                    <p class="mt-2 text-3xl font-bold text-gray-950 dark:text-white">
                        Rp {{ number_format($stats['totalRevenue'], 0, ',', '.') }}
                    </p>
                </div>
                <div class="rounded-lg bg-purple-100 p-3 dark:bg-purple-900">
                    <svg class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8L5.257 19.257a2 2 0 00-.247 2.693l1.068 1.068c.94.94 2.753.947 3.693.007L21 9"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="rounded-xl border border-gray-100 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
        <div class="border-b border-gray-100 px-6 py-5 dark:border-gray-800">
            <h3 class="text-base font-bold text-gray-950 dark:text-white">
                Latest Orders
            </h3>
        </div>

        @php
            $orders = $this->getLatestOrders();
        @endphp

        @if (count($orders) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50 dark:border-gray-800 dark:bg-gray-800/50">
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300">
                                Info Customer
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300">
                                Order Number
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300">
                                Total Amount
                                <svg class="ml-1 inline-block h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300">
                                Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300">
                                Status Pesanan
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 dark:text-gray-300">
                                Status Pembayaran
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach ($orders as $order)
                            <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $order['customer_name'] }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $order['customer_email'] }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="font-mono text-sm text-gray-900 dark:text-white">
                                        {{ $order['invoice_id'] }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                        Rp {{ number_format($order['total'], 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="text-sm capitalize text-gray-700 dark:text-gray-300">
                                        {{ $order['meta']['payment_method'] ?? '-' }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @if ($order['status'] === 'pending')
                                        <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-semibold text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300">
                                            ⏳ Pending
                                        </span>
                                    @elseif ($order['status'] === 'paid')
                                        <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                            ✅ Paid
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-semibold text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                            {{ ucfirst($order['status']) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    @if ($order['status'] === 'paid')
                                        <span class="text-xs font-semibold text-green-600 dark:text-green-400">
                                            ✅ Lunas
                                        </span>
                                    @else
                                        <span class="text-xs font-semibold text-yellow-600 dark:text-yellow-400">
                                            ⏳ Menunggu
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="flex items-center justify-between border-t border-gray-100 bg-gray-50 px-6 py-4 dark:border-gray-800 dark:bg-gray-800/50">
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-700 dark:text-gray-300">per halaman</span>
                    <select class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium shadow-sm transition focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-16">
                <svg class="mb-4 h-14 w-14 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
                    Tidak ada data yang ditemukan
                </p>
            </div>
            
            <div class="flex items-center justify-between border-t border-gray-100 bg-gray-50 px-6 py-4 dark:border-gray-800 dark:bg-gray-800/50">
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-700 dark:text-gray-300">per halaman</span>
                    <select class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium shadow-sm transition focus:border-primary-500 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
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
