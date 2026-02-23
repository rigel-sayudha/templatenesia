@extends('layouts.app')

@section('title', 'Detail Produk - Templatenesia Official')

@section('head')
{{-- Page-specific styles only --}}
@endsection

@section('content')
<header class="fixed top-0 w-full z-50 glass-header transition-all duration-300">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 h-20 flex items-center justify-center relative">
        <a href="/" class="flex items-center gap-3 cursor-pointer hover:opacity-80 transition absolute left-4 sm:left-6">
            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjRzyTdfjkBugSP3Ew_vmkaeMQKl0XnZVR83kFV0LtKJXC4gVF_WTGPS57iCampIjdlGU09l_Ct0hw_2Tx51GiHj5uWr6fTYqzJirf8qpAKhwW0AsM-pYcam74_l25KpFvShEYQdkJ-UnuJQsuiP7qa7Ek85k0MWaF0X0pHGmJZ2imL8IQK9ip5M9s2sW0/s16000/Templatenesia%20Logo.jpg" 
                 class="w-10 h-10 rounded-lg object-cover shadow-sm" alt="Templatenesia Logo">
            <div>
                <h1 class="font-heading font-extrabold text-xl text-slate-900 leading-none">Template<span class="text-iosPurple">nesia</span>.</h1>
            </div>
        </a>

        <nav class="hidden md:flex items-center gap-8">
            <a href="/" class="text-slate-900 hover:text-iosBlue font-semibold text-sm transition-colors">
                <i class="ri-home-line mr-2"></i>Beranda
            </a>
            <a href="/products" class="text-iosBlue font-semibold text-sm border-b-2 border-iosBlue pb-1">
                <i class="ri-shopping-bag-line mr-2"></i>Produk
            </a>
            <a href="/guide" class="text-slate-900 hover:text-iosBlue font-semibold text-sm transition-colors">
                <i class="ri-book-line mr-2"></i>Panduan
            </a>
            <a href="/orders" class="text-slate-900 hover:text-iosBlue font-semibold text-sm transition-colors">
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

<div class="min-h-screen bg-slate-50 pt-32 pb-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        <div class="flex items-center gap-2 text-sm text-slate-500 mb-8">
            <a href="/" class="hover:text-iosBlue">Beranda</a>
            <i class="ri-arrow-right-s-line"></i>
            <a href="/products" class="hover:text-iosBlue">Produk</a>
            <i class="ri-arrow-right-s-line"></i>
            <span class="text-slate-900 font-semibold">{{ $product->title ?? 'Detail Produk' }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <div>
                <div class="bg-gradient-to-br from-iosBlue/10 to-iosPurple/10 rounded-2xl overflow-hidden aspect-square flex items-center justify-center sticky top-32">
                    <img src="{{ $product->image ?? 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 500 500%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22500%22 height=%22500%22/%3E%3C/svg%3E' }}" 
                         alt="{{ $product->title ?? 'Product' }}"
                         class="w-full h-full object-cover">
                </div>
            </div>

            <div class="space-y-8">
                <div>
                    <div class="inline-flex items-center gap-2 bg-iosBlue/10 text-iosBlue px-3 py-1 rounded-full text-xs font-bold mb-4">
                        <i class="ri-tag-line"></i>
                        {{ $product->category?->name ?? 'Kategori' }}
                    </div>

                    <h1 class="font-heading text-4xl font-extrabold text-slate-900 mb-2">
                        {{ $product->title ?? $product->name ?? 'Produk' }}
                    </h1>

                    <p class="text-slate-500 text-lg leading-relaxed">
                        {{ $product->description ?? 'Deskripsi produk tidak tersedia' }}
                    </p>
                </div>

                <div class="flex items-center gap-4 pb-8 border-b border-slate-200">
                    <div class="flex items-center gap-1">
                        <i class="fa-solid fa-star text-yellow-400"></i>
                        <span class="font-bold text-slate-900">{{ $product->rating ?? 4.8 }}</span>
                        <span class="text-slate-500 text-sm">({{ $product->review_count ?? 128 }} ulasan)</span>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex items-baseline gap-4">
                        @if($product->discount_price && $product->discount_price < $product->price)
                            <div class="text-4xl font-extrabold text-iosBlue">
                                Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                            </div>
                            <div class="text-xl text-slate-400 line-through">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                            <div class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-bold">
                                {{ round((1 - $product->discount_price / $product->price) * 100) }}% OFF
                            </div>
                        @else
                            <div class="text-4xl font-extrabold text-iosBlue">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                        @endif
                    </div>

                    <p class="text-sm text-slate-500">
                        <i class="ri-checkbox-circle-line text-green-500 mr-1"></i>
                        Produk digital - Instant download setelah pembayaran
                    </p>
                </div>

                <div class="space-y-3 pt-8">
                    <a href="{{ route('checkout', ['product_id' => $product->id ?? 1]) }}" class="w-full bg-gradient-to-r from-iosBlue to-iosPurple hover:shadow-xl text-white font-bold px-6 py-4 rounded-xl transition-all shadow-lg hover:-translate-y-1 inline-flex items-center justify-center">
                        <i class="ri-shopping-cart-line mr-2"></i>
                        Beli Sekarang
                    </a>
                    <button x-data @click.prevent="$store.wishlist.toggle({
                            id: {{ $product->id ?? 1 }},
                            name: '{{ addslashes($product->name ?? 'Produk Digital Templatenesia') }}',
                            price: {{ $product->price ?? 0 }},
                            oldPrice: {{ $product->oldPrice ?? 'null' }},
                            image: '{{ $product->image ?? '' }}'
                        })"
                        :class="$store.wishlist.has({{ $product->id ?? 1 }}) ? 'bg-red-50 text-red-500 hover:bg-red-100 border border-red-200' : 'bg-slate-100 hover:bg-slate-200 text-slate-900 border border-transparent'"
                        class="w-full font-bold px-6 py-4 rounded-xl transition-all flex items-center justify-center">
                        <i class="mr-2" :class="$store.wishlist.has({{ $product->id ?? 1 }}) ? 'fa-solid fa-heart' : 'ri-heart-line'"></i>
                        <span x-text="$store.wishlist.has({{ $product->id ?? 1 }}) ? 'Hapus dari Wishlist' : 'Tambah ke Wishlist'"></span>
                    </button>
                </div>

                <div class="bg-slate-100 rounded-xl p-6 space-y-3">
                    <h3 class="font-bold text-slate-900">Apa yang Anda dapatkan:</h3>
                    <ul class="space-y-2 text-sm text-slate-600">
                        <li class="flex items-center gap-2">
                            <i class="ri-check-line text-green-500 font-bold"></i>
                            File editable (Word, Excel, PDF)
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="ri-check-line text-green-500 font-bold"></i>
                            Download unlimited selamanya
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="ri-check-line text-green-500 font-bold"></i>
                            Gratis update versi terbaru
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="ri-check-line text-green-500 font-bold"></i>
                            Customer support 24/7
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div x-data="{ tab: 'deskripsi' }" class="bg-white rounded-2xl p-8 border border-slate-200 mb-16">
            <div class="flex gap-8 border-b border-slate-200 mb-8 -mx-8 px-8">
                <button @click="tab = 'deskripsi'" 
                        :class="tab === 'deskripsi' ? 'border-b-2 border-iosBlue text-iosBlue' : 'text-slate-600 hover:text-slate-900'"
                        class="pb-4 font-bold transition-colors">
                    Deskripsi Lengkap
                </button>
                <button @click="tab = 'fitur'" 
                        :class="tab === 'fitur' ? 'border-b-2 border-iosBlue text-iosBlue' : 'text-slate-600 hover:text-slate-900'"
                        class="pb-4 font-bold transition-colors">
                    Fitur & Spesifikasi
                </button>
                <button @click="tab = 'faq'" 
                        :class="tab === 'faq' ? 'border-b-2 border-iosBlue text-iosBlue' : 'text-slate-600 hover:text-slate-900'"
                        class="pb-4 font-bold transition-colors">
                    FAQ
                </button>
            </div>

            <div x-show="tab === 'deskripsi'" x-transition class="prose max-w-none text-slate-600 leading-relaxed">
                <p>{{ $product->description ?? 'Deskripsi produk tidak tersedia' }}</p>
                <p>Produk ini telah dipilih oleh ribuan pengguna dan terbukti meningkatkan efisiensi kerja hingga 40%.</p>
            </div>

            <div x-show="tab === 'fitur'" x-transition class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-lg bg-iosBlue/10 text-iosBlue flex items-center justify-center flex-shrink-0">
                            <i class="ri-file-text-line"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">Format File</h4>
                            <p class="text-sm text-slate-600">Word (.docx), Excel (.xlsx), PDF</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-lg bg-iosPurple/10 text-iosPurple flex items-center justify-center flex-shrink-0">
                            <i class="ri-edit-line"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">100% Editable</h4>
                            <p class="text-sm text-slate-600">Sesuaikan dengan kebutuhan Anda</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-lg bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">
                            <i class="ri-download-line"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">Instant Download</h4>
                            <p class="text-sm text-slate-600">Langsung setelah pembayaran</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center flex-shrink-0">
                            <i class="ri-customer-service-2-line"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900">Support 24/7</h4>
                            <p class="text-sm text-slate-600">Tim siap membantu kapan saja</p>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="tab === 'faq'" x-transition class="space-y-4">
                <div class="bg-slate-50 p-4 rounded-lg">
                    <h4 class="font-bold text-slate-900 mb-2">Apakah file bisa diedit?</h4>
                    <p class="text-sm text-slate-600">Ya, semua file 100% editable. Anda dapat mengubah teks, warna, desain sesuai kebutuhan.</p>
                </div>
                <div class="bg-slate-50 p-4 rounded-lg">
                    <h4 class="font-bold text-slate-900 mb-2">Berapa lama file bisa diakses?</h4>
                    <p class="text-sm text-slate-600">Selamanya. Tidak ada batasan waktu akses atau download.</p>
                </div>
                <div class="bg-slate-50 p-4 rounded-lg">
                    <h4 class="font-bold text-slate-900 mb-2">Apakah ada update gratis?</h4>
                    <p class="text-sm text-slate-600">Ya, semua update versi terbaru gratis untuk semua pembeli.</p>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="mb-16">
            <h2 class="font-heading text-3xl font-bold text-slate-900 mb-8">Produk Terkait</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @for($i = 1; $i <= 4; $i++)
                    <a href="#" class="group bg-white rounded-2xl shadow-soft hover:shadow-xl border border-transparent hover:border-iosBlue transition-all duration-300 hover:-translate-y-2 cursor-pointer block no-underline overflow-hidden">
                        <div class="relative aspect-square rounded-t-2xl overflow-hidden bg-gradient-to-br from-iosBlue/10 to-iosPurple/10">
                            <img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 300 300%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22300%22 height=%22300%22/%3E%3C/svg%3E" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" alt="Product">
                            <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-md text-iosBlue text-xs font-bold px-2.5 py-1 rounded-lg flex items-center gap-1 shadow-md">
                                <i class="fa-solid fa-star text-yellow-400 text-xs"></i> 4.9
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-slate-900 text-sm line-clamp-2 group-hover:text-iosBlue transition-colors">Produk Terkait {{ $i }}</h4>
                            <p class="text-xs text-slate-500 mb-3">Template Siap Pakai</p>
                            <div class="flex items-end justify-between">
                                <div class="text-base font-bold text-iosBlue">Rp 49.900</div>
                                <div class="w-8 h-8 rounded-full bg-iosBlue text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-arrow-right text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @endfor
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
@include('partials.footer')
@endsection
