@extends('layouts.app')

@section('title', 'Wishlist Saya - Templatenesia Official')

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
            <a href="/orders" class="text-slate-900 hover:text-iosBlue font-semibold text-sm transition-colors">
                <i class="ri-file-list-line mr-2"></i>Pesanan
            </a>
            <a href="/wishlist" class="text-iosBlue font-semibold text-sm border-b-2 border-iosBlue pb-1 relative">
                <i class="fa-solid gap-x-2 text-iosBlue fa-heart mr-2"></i>Wishlist
                <span x-data x-show="$store.wishlist.count > 0" x-text="$store.wishlist.count" class="absolute -top-1 -right-4 bg-red-500 text-white min-w-[16px] h-4 rounded-full flex items-center justify-center text-[10px] font-bold px-1" x-cloak></span>
            </a>
        </nav>

        <a href="https://wa.me/6287751299911" target="_blank" class="flex items-center gap-2 bg-slate-900 hover:bg-iosBlue text-white px-5 py-2.5 rounded-full text-sm font-semibold transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:scale-95 absolute right-4 sm:right-6">
            <i class="ri-whatsapp-line text-lg"></i>
            <span class="hidden sm:inline">Hubungi Admin</span>
        </a>
    </div>
</header>

<div class="min-h-screen bg-slate-50 pt-32 pb-16" x-data>
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10">
            <h2 class="font-heading text-3xl font-bold text-slate-900">Wishlist</h2>
            <p class="text-slate-500 mt-2">Daftar template dan kursus yang sudah kamu simpan untuk nanti.</p>
        </div>

        <template x-if="$store.wishlist.count === 0">
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-12 text-center max-w-2xl mx-auto">
                <h3 class="text-xl font-bold text-slate-900 mb-2">Wishlist Masih Kosong</h3>
                <p class="text-slate-500 mb-8">Eksplorasi katalog kami dan temukan template digital yang cocok untuk projectmu.</p>
                <a href="/products" class="inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-iosBlue text-white font-bold px-8 py-3.5 rounded-full transition-all shadow-md active:scale-95">
                    <i class="ri-search-line"></i> Temukan Produk
                </a>
            </div>
        </template>

        <template x-if="$store.wishlist.count > 0">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <template x-for="prod in $store.wishlist.items" :key="prod.id">
                    <a :href="'/product?id=' + prod.id" class="group bg-white rounded-2xl shadow-soft hover:shadow-lg border border-transparent hover:border-iosBlue transition-all cursor-pointer block no-underline overflow-hidden hover:-translate-y-1 relative">
                        <div class="relative aspect-[4/3] rounded-t-2xl overflow-hidden bg-gradient-to-br from-iosBlue/10 to-iosPurple/10">
                            <template x-if="prod.oldPrice">
                                <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-lg shadow-md z-10">
                                    <span x-text="Math.round((1 - prod.price/prod.oldPrice) * 100) + '% OFF'"></span>
                                </div>
                            </template>
                            
                            <img :src="prod.image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" :alt="prod.name">
                            
                            <button @click.prevent="$store.wishlist.toggle(prod)" 
                                    class="absolute top-3 left-3 w-8 h-8 rounded-full flex items-center justify-center shadow-md bg-white text-red-500 hover:bg-red-50 transition-colors z-20">
                                <i class="fa-solid fa-heart text-sm text-red-500"></i>
                            </button>
                        </div>
                        <div class="p-4 md:p-5">
                            <h4 class="font-heading font-extrabold text-slate-900 text-base md:text-lg leading-snug mb-2 line-clamp-2 h-12" x-text="prod.name"></h4>
                            <div class="flex items-center justify-between mt-auto">
                                <div>
                                    <template x-if="prod.oldPrice">
                                        <div class="text-xs text-gray-400 line-through mb-0.5">Rp <span x-text="new Intl.NumberFormat('id-ID').format(prod.oldPrice)"></span></div>
                                    </template>
                                    <span class="font-bold text-iosBlue text-sm md:text-base">Rp <span x-text="new Intl.NumberFormat('id-ID').format(prod.price)"></span></span>
                                </div>
                                <button class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 group-hover:bg-iosBlue group-hover:text-white flex items-center justify-center transition-colors">
                                    <i class="ri-arrow-right-up-line"></i>
                                </button>
                            </div>
                        </div>
                    </a>
                </template>
            </div>
        </template>
    </div>
</div>

@include('partials.footer')
@endsection
