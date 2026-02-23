@extends('layouts.app')

@section('title', 'Pesanan Saya - Templatenesia Official')

@section('content')
<header class="fixed top-0 w-full z-50 glass-header transition-all duration-300">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 h-20 flex items-center justify-center relative">
        <a href="/" class="flex items-center gap-3 cursor-pointer hover:opacity-80 transition absolute left-4 sm:left-6">
            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjRzyTdfjkBugSP3Ew_vmkaeMQKl0XnZVR83kFV0LtKJXC4gVF_WTGPS57iCampIjdlGU09l_Ct0hw_2Tx51GiHj5uWr6fTYqzJirf8qpAKhwW0AsM-pYcam74_l25KpFvShEYQdkJ-UnuJQsuiP7qa7Ek85k0MWaF0X0pHGmJZ2imL8IQK9ip5M9s2sW0/s16000/Templatenesia%20Logo.jpg" 
                 class="w-10 h-10 rounded-lg object-cover shadow-sm" alt="Templatenesia">
            <div>
                <h1 class="font-heading font-extrabold text-xl text-slate-900 leading-none">Template<span class="text-iosPurple">nesia</span>.</h1>
            </div>
        </a>

        <nav class="hidden md:flex items-center gap-8">
            <a href="/" class="text-slate-900 hover:text-iosBlue font-semibold text-sm transition-colors">
                <i class="ri-home-line mr-2"></i>Beranda
            </a>
            <a href="/products" class="text-slate-900 hover:text-iosBlue font-semibold text-sm transition-colors">
                <i class="ri-shopping-bag-line mr-2"></i>Produk
            </a>
            <a href="/guide" class="text-slate-900 hover:text-iosBlue font-semibold text-sm transition-colors">
                <i class="ri-book-line mr-2"></i>Panduan
            </a>
            <a href="/orders" class="text-iosBlue font-semibold text-sm border-b-2 border-iosBlue pb-1">
                <i class="ri-file-list-line mr-2"></i>Pesanan
            </a>
            <a href="/wishlist" class="text-slate-900 hover:text-iosBlue font-semibold text-sm transition-colors relative" x-data>
                <i class="fa-regular fa-heart mr-2"></i>Wishlist
                <span x-cloak x-show="$store.wishlist.count > 0" x-text="$store.wishlist.count" class="absolute -top-1 -right-4 bg-red-500 text-white min-w-[16px] h-4 rounded-full flex items-center justify-center text-[10px] font-bold px-1"></span>
            </a>
        </nav>

        <a href="https://wa.me/6287751299911" target="_blank" class="flex items-center gap-2 bg-slate-900 hover:bg-iosBlue text-white px-5 py-2.5 rounded-full text-sm font-semibold transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:scale-95 absolute right-4 sm:right-6">
            <i class="ri-whatsapp-line text-lg"></i>
            <span class="hidden sm:inline">Hubungi Admin</span>
        </a>
    </div>
</header>

<div x-data="{ 
    showDetail: false, 
    selectedOrder: null,
    openDetail(order) {
        this.selectedOrder = order;
        this.showDetail = true;
        document.body.style.overflow = 'hidden';
    },
    closeDetail() {
        this.showDetail = false;
        setTimeout(() => { this.selectedOrder = null; }, 300);
        document.body.style.overflow = 'auto';
    }
}" class="min-h-screen bg-slate-50 pt-32 pb-16 relative">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10">
            <h2 class="font-heading text-3xl font-bold text-slate-900">Pesanan Saya</h2>
            <p class="text-slate-500 mt-2">Lacak status pesanan dan dapatkan produk digital Anda di sini.</p>
        </div>

        @if(count($orders) === 0)
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-12 text-center">
                <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-5 text-iosBlue text-4xl">
                    <i class="ri-shopping-bag-3-line"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Belum ada pesanan</h3>
                <p class="text-slate-500 mb-8 max-w-sm mx-auto">Anda belum melakukan pembelian produk atau sesi pesanan Anda tidak ditemukan pada browser ini.</p>
                <a href="/products" class="inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-iosBlue text-white font-bold px-8 py-3.5 rounded-full transition-all shadow-md active:scale-95">
                    <i class="ri-shopping-cart-line"></i> Mulai Belanja
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div @click="openDetail({
                            id: {{ $order->id }},
                            invoice_id: '{{ $order->invoice_id }}',
                            status: '{{ $order->status }}',
                            product_name: '{{ addslashes($order->product->name ?? 'Produk Digital Templatenesia') }}',
                            amount: {{ $order->amount ?? 0 }},
                            admin_fee: {{ $order->admin_fee ?? 0 }},
                            total: {{ $order->total }},
                            customer_name: '{{ addslashes($order->customer_name) }}',
                            customer_email: '{{ addslashes($order->customer_email) }}',
                            customer_phone: '{{ addslashes($order->customer_phone) }}',
                            payment_method: '{{ $order->payment_method ?? '' }}'
                        })"
                        class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col md:flex-row items-center justify-between gap-6 transition-all hover:shadow-md hover:border-blue-100 group cursor-pointer">
                        
                        <div class="flex-1 w-full relative">
                            <!-- Overlay click area khusus tulisan agar jika tombol CTA di klik tidak terjadi propagasi / bentrok -->
                            <div class="flex items-center justify-between mb-3 pointer-events-none">
                                <span class="text-sm font-semibold text-slate-500 bg-slate-100 px-3 py-1 rounded-md">INV: {{ $order->invoice_id }}</span>
                                @if($order->status === 'paid')
                                    <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full flex items-center"><i class="ri-check-line mr-1 text-sm"></i> Lunas</span>
                                @elseif($order->status === 'pending')
                                    <span class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full flex items-center"><i class="ri-time-line mr-1 text-sm"></i> Menunggu Pembayaran</span>
                                @else
                                    <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full flex items-center"><i class="ri-close-line mr-1 text-sm"></i> {{ ucfirst($order->status) }}</span>
                                @endif
                            </div>
                            
                            <h4 class="font-heading text-lg font-bold text-slate-900 mb-1 line-clamp-2">
                                {{ $order->product->name ?? 'Produk Digital Templatenesia' }}
                            </h4>
                            
                            <div class="flex flex-wrap items-center gap-4 text-sm mt-4">
                                <div class="flex items-center text-slate-500">
                                    <i class="ri-calendar-line mr-1.5 text-iosBlue"></i>
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </div>
                                <div class="flex items-center font-bold text-iosBlue text-base">
                                    <i class="ri-wallet-3-line mr-1.5"></i>
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="w-full md:w-auto flex flex-col gap-3 min-w-[200px]" @click.stop>
                            @if($order->status === 'paid')
                                <a href="https://wa.me/6287751299911?text={{ urlencode('Halo Admin, saya ingin mendownload produk dengan Invoice: '.$order->invoice_id) }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-iosBlue hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-full transition-all shadow-md hover:shadow-lg active:scale-95">
                                    <i class="ri-download-cloud-2-line text-lg"></i> Akses Produk
                                </a>
                            @else
                                <a href="https://wa.me/6287751299911?text={{ urlencode('Halo Admin, saya ingin konfirmasi pembayaran untuk Invoice: '.$order->invoice_id) }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-full transition-all shadow-md hover:shadow-lg active:scale-95">
                                    <i class="ri-whatsapp-line text-lg"></i> Konfirmasi Bayar
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Modal Popup Detail Pesanan -->
    <div x-cloak x-show="showDetail" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div x-show="showDetail" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             @click="closeDetail"
             class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>

        <!-- Modal Panel -->
        <div x-show="showDetail" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all w-full max-w-lg">
            
            <template x-if="selectedOrder">
                <div>
                    <!-- Header -->
                    <div class="bg-slate-50 border-b border-slate-100 px-6 py-5 flex items-center justify-between">
                        <h3 class="font-heading text-xl font-bold text-slate-900" id="modal-title">Detail Pesanan</h3>
                        <button @click="closeDetail" class="text-slate-400 hover:text-red-500 bg-white hover:bg-red-50 w-8 h-8 rounded-full flex items-center justify-center transition-colors shadow-sm">
                            <i class="ri-close-line text-xl"></i>
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="px-6 py-6 space-y-6">
                        <!-- Info Status -->
                        <div class="flex flex-col items-center justify-center p-4 bg-slate-50/50 rounded-2xl border border-slate-100">
                            <span class="text-sm text-slate-500 mb-1">Invoice</span>
                            <span class="font-bold text-iosBlue text-lg tracking-wider mb-3" x-text="selectedOrder.invoice_id"></span>
                            
                            <template x-if="selectedOrder.status === 'paid'">
                                <span class="bg-green-100 text-green-700 font-bold px-4 py-1.5 rounded-full flex items-center"><i class="ri-check-double-line mr-1.5"></i> Pembayaran Berhasil</span>
                            </template>
                            <template x-if="selectedOrder.status === 'pending'">
                                <span class="bg-amber-100 text-amber-700 font-bold px-4 py-1.5 rounded-full flex items-center"><i class="ri-time-line mr-1.5"></i> Menunggu Pembayaran</span>
                            </template>
                            <template x-if="selectedOrder.status !== 'paid' && selectedOrder.status !== 'pending'">
                                <span class="bg-red-100 text-red-700 font-bold px-4 py-1.5 rounded-full flex items-center"><i class="ri-close-circle-line mr-1.5"></i> <span x-text="selectedOrder.status"></span></span>
                            </template>
                        </div>

                        <!-- Info Produk -->
                        <div>
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Produk Dibeli</h4>
                            <div class="flex items-start gap-3">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-iosBlue/10 to-iosPurple/10 flex items-center justify-center text-iosBlue">
                                    <i class="ri-code-box-line text-2xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 line-clamp-2" x-text="selectedOrder.product_name || 'Produk Digital Templatenesia'"></p>
                                    <p class="text-sm text-slate-500 mt-0.5">1x Produk Digital</p>
                                </div>
                            </div>
                        </div>

                        <hr class="border-slate-100 border-dashed">

                        <!-- Rincian Biaya -->
                        <div>
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Rincian Pembayaran</h4>
                            <div class="space-y-2 text-sm">
                                <template x-if="selectedOrder.amount > 0">
                                    <div class="flex justify-between text-slate-600">
                                        <span>Subtotal Produk</span>
                                        <span x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(selectedOrder.amount)"></span>
                                    </div>
                                </template>
                                
                                <template x-if="selectedOrder.admin_fee > 0">
                                    <div class="flex justify-between text-slate-600">
                                        <span>Biaya Admin</span>
                                        <span x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(selectedOrder.admin_fee)"></span>
                                    </div>
                                </template>

                                <div class="flex justify-between text-slate-900 font-bold text-lg pt-2 border-t border-slate-100 mt-2">
                                    <span>Total Belanja</span>
                                    <span class="text-iosBlue" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(selectedOrder.total)"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Data Pembeli -->
                        <div class="bg-slate-50 p-4 rounded-xl text-sm space-y-2">
                            <div class="grid grid-cols-3">
                                <span class="text-slate-500">Nama</span>
                                <span class="col-span-2 font-medium text-slate-900" x-text="selectedOrder.customer_name"></span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-slate-500">Email</span>
                                <span class="col-span-2 font-medium text-slate-900" x-text="selectedOrder.customer_email"></span>
                            </div>
                            <div class="grid grid-cols-3">
                                <span class="text-slate-500">No. WA</span>
                                <span class="col-span-2 font-medium text-slate-900" x-text="selectedOrder.customer_phone"></span>
                            </div>
                            <template x-if="selectedOrder.payment_method">
                                <div class="grid justify-between pt-2 mt-2 border-t border-slate-200/60">
                                    <span class="text-slate-500 text-xs text-center">Metode Pembayaran: <span class="font-bold text-slate-900 uppercase" x-text="selectedOrder.payment_method"></span></span>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

@include('partials.footer')
@endsection
