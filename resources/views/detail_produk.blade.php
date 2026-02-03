@extends('layouts.app')

@section('title', 'Checkout - Templatenesia Official')

@section('head')
<!-- head taken from original Detail Produk.html for identical look -->
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script>
    tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'], heading: ['Plus Jakarta Sans', 'sans-serif'] }, colors: { iosBlue: '#007AFF', iosPurple: '#9333ea', iosDark: '#1D1D1F', iosBg: '#F5F5F7', }, boxShadow: { 'soft': '0 8px 30px rgba(0,0,0,0.04)', 'glow': '0 0 20px rgba(0, 122, 255, 0.3)', } } } }
</script>
<!-- Centralized CSS -->
<link rel="stylesheet" href="{{ asset('css/templatenesia.css') }}">
<style>
    .glass-header { background: rgba(255,255,255,0.8); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(0,0,0,0.05); }
    @media (max-width: 768px) { .product-grid { grid-template-columns: repeat(2, 1fr); } }
</style>
<script>
    function checkoutApp() {
        return {
            qty: 1,
            form: {
                name: '',
                email: '',
                phone: '',
                agree_terms: false,
            },
            addQty(n) { 
                this.qty = Math.max(1, this.qty + n); 
            },
            validateAndSubmit(e) {
                if (!this.form.name.trim()) {
                    e.preventDefault();
                    alert('Nama lengkap harus diisi');
                    return false;
                }
                if (!this.form.email.trim()) {
                    e.preventDefault();
                    alert('Email harus diisi');
                    return false;
                }
                if (!this.form.phone.trim()) {
                    e.preventDefault();
                    alert('Nomor WhatsApp harus diisi');
                    return false;
                }
                if (!this.form.agree_terms) {
                    e.preventDefault();
                    alert('Anda harus setuju dengan syarat dan ketentuan');
                    return false;
                }
                return true;
            }
        }
    }
</script>
@endsection

@section('content')
<!-- Header Topbar -->
<header class="fixed top-0 w-full z-50 glass-header transition-all duration-300">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 h-20 flex items-center justify-between">
        <a href="/" class="flex items-center gap-3 cursor-pointer hover:opacity-80 transition">
            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjRzyTdfjkBugSP3Ew_vmkaeMQKl0XnZVR83kFV0LtKJXC4gVF_WTGPS57iCampIjdlGU09l_Ct0hw_2Tx51GiHj5uWr6fTYqzJirf8qpAKhwW0AsM-pYcam74_l25KpFvShEYQdkJ-UnuJQsuiP7qa7Ek85k0MWaF0X0pHGmJZ2imL8IQK9ip5M9s2sW0/s16000/Templatenesia%20Logo.jpg" 
                 class="w-10 h-10 rounded-lg object-cover shadow-sm" alt="Templatenesia Logo">
            <div>
                <h1 class="font-heading font-extrabold text-xl text-slate-900 leading-none">Template<span class="text-iosPurple">nesia</span>.</h1>
            </div>
        </a>
        <a href="https://wa.me/6287751299911" target="_blank" class="flex items-center gap-2 bg-slate-900 hover:bg-iosBlue text-white px-5 py-2.5 rounded-full text-sm font-semibold transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:scale-95">
            <i class="ri-whatsapp-line text-lg"></i>
            <span class="hidden sm:inline">Hubungi Admin</span>
        </a>
    </div>
</header>

<div x-data="checkoutApp()" class="min-h-screen bg-gray-50 py-12 pt-32">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-8 flex items-center gap-2 text-sm text-gray-600">
            <a href="/" class="hover:text-iosBlue">Beranda</a>
            <i class="ri-arrow-right-s-line"></i>
            <a href="/product" class="hover:text-iosBlue">Produk</a>
            <i class="ri-arrow-right-s-line"></i>
            <span class="text-gray-900 font-medium">{{ $product->title ?? 'Detail Produk' }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-gradient-to-br from-iosBlue to-iosPurple rounded-2xl p-8 mb-8 flex items-center justify-center" style="aspect-ratio: 3/2;">
                    <img src="{{ $product->image ?? 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22300%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22400%22 height=%22300%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2220%22 fill=%22%23999%22 text-anchor=%22middle%22 dy=%22.3em%22%3EProduct Image%3C/text%3E%3C/svg%3E' }}" 
                         class="w-full h-full object-contain" 
                         alt="{{ $product->title }}">
                </div>

                <div class="bg-white rounded-lg p-6 mb-6">
                    <div class="flex gap-4 mb-4">
                        <div class="w-12 h-12 rounded-full bg-iosPurple/10 flex items-center justify-center text-iosPurple text-xl">
                            <i class="fa-solid fa-tv"></i>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-xl font-bold text-gray-900">{{ $product->title ?? 'Canvas Pro' }}</h2>
                            <div class="flex items-center gap-1 mt-1">
                                <span class="text-xs bg-gray-100 px-2 py-1 rounded">4.3/5 (Terjual)</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-4 border-t space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Harga Normal:</span>
                            <span class="text-red-500 line-through font-medium">Rp {{ isset($product->price) ? number_format($product->price,0,',','.') : '75.000' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-900 font-bold">Harga Diskon:</span>
                            <span class="text-2xl font-bold text-gray-900">Rp {{ isset($product->discount_price) ? number_format($product->discount_price,0,',','.') : '15.000' }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-green-600 font-medium">
                            <span>Hemat {{ isset($product->discount_price, $product->price) ? round((1 - $product->discount_price / $product->price) * 100) : 80 }}%</span>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded text-sm text-green-700">
                        <i class="ri-check-line"></i> Produk digital bersertifikat lengkap
                    </div>
                </div>

                <!-- Tentang Produk -->
                <div class="bg-white rounded-lg p-6 mb-6">
                    <h3 class="font-bold text-lg mb-3">Tentang {{ $product->title ?? 'Canvas Pro' }}</h3>
                    <p class="text-sm text-gray-600 leading-relaxed mb-4">
                        Aplikasi {{ $product->title ?? 'Canvas Pro' }} untuk kebutuhan desain profesional brand kit, background remover, editor premium, dan stock assets.
                    </p>
                </div>

                <!-- Benefit -->
                <div class="bg-white rounded-lg p-6 mb-6">
                    <h3 class="font-bold text-lg mb-4">Benefit</h3>
                    <ul class="space-y-3">
                        <li class="flex gap-3">
                            <i class="ri-check-circle-line text-iosBlue text-lg flex-shrink-0 mt-0.5"></i>
                            <span class="text-sm text-gray-700">Akses seumur hidup Blue Pro</span>
                        </li>
                        <li class="flex gap-3">
                            <i class="ri-check-circle-line text-iosBlue text-lg flex-shrink-0 mt-0.5"></i>
                            <span class="text-sm text-gray-700">Brand Kit & Template premium</span>
                        </li>
                        <li class="flex gap-3">
                            <i class="ri-check-circle-line text-iosBlue text-lg flex-shrink-0 mt-0.5"></i>
                            <span class="text-sm text-gray-700">Stock foto, video, dan audio</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-lg p-6">
                    <h3 class="font-bold text-lg mb-4">Cara Pemesanan</h3>
                    <ol class="space-y-3 text-sm text-gray-700">
                        <li class="flex gap-3">
                            <span class="font-bold text-iosBlue flex-shrink-0">1.</span>
                            <span>Pilih paket yang ingin Anda inginkan dari katalog tabel</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-iosBlue flex-shrink-0">2.</span>
                            <span>Lakukan pembayaran melalui metode yang tersedia</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-iosBlue flex-shrink-0">3.</span>
                            <span>Dapatkan software langsung setelah pembayaran dikonfirmasi</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-iosBlue flex-shrink-0">4.</span>
                            <span>Download software dari akun premium yang tersedia</span>
                        </li>
                        <li class="flex gap-3">
                            <span class="font-bold text-iosBlue flex-shrink-0">5.</span>
                            <span>Hubungi support jika ada kendala dalam proses</span>
                        </li>
                    </ol>

                    <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded text-sm text-green-700">
                        <i class="ri-check-line"></i> Garansi uang kembali 100% jika produk tidak sesuai dengan desk/spek atau mengalami masalah teknis.
                    </div>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-lg p-6 sticky top-28 space-y-4">
                    <div class="mb-6">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600 text-sm">Harga Normal:</span>
                            <span class="text-red-500 line-through font-medium text-sm">Rp {{ isset($product->price) ? number_format($product->price,0,',','.') : '75.000' }}</span>
                        </div>
                        <div class="flex justify-between mb-4">
                            <span class="text-gray-600 text-sm">Harga Diskon:</span>
                            <span class="text-gray-900 font-semibold text-sm">Rp {{ isset($product->discount_price) ? number_format($product->discount_price,0,',','.') : '15.000' }}</span>
                        </div>
                        <div class="border-t pt-4 flex justify-between">
                            <span class="font-bold text-gray-900">Total:</span>
                            <span class="text-2xl font-bold text-iosBlue">Rp {{ isset($product->discount_price) ? number_format($product->discount_price,0,',','.') : '15.000' }}</span>
                        </div>
                    </div>

                    <!-- Variant Options -->
                    <div class="space-y-3 pb-6 border-b">
                        <div>
                            <label class="text-xs font-semibold text-gray-700 block mb-2">Akun: Invite</label>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 p-2 border rounded cursor-pointer hover:bg-blue-50">
                                    <input type="radio" name="variant" class="w-4 h-4" checked>
                                    <span class="text-sm text-gray-700">Invite</span>
                                </label>
                                <label class="flex items-center gap-2 p-2 border rounded cursor-pointer hover:bg-blue-50">
                                    <input type="radio" name="variant" class="w-4 h-4">
                                    <span class="text-sm text-gray-700">Starter</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-gray-700 block mb-2">Durasi: 1 Bulan</label>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 p-2 border rounded cursor-pointer hover:bg-blue-50">
                                    <input type="radio" name="duration" class="w-4 h-4" checked>
                                    <span class="text-sm text-gray-700">1 Bulan</span>
                                </label>
                                <label class="flex items-center gap-2 p-2 border rounded cursor-pointer hover:bg-blue-50">
                                    <input type="radio" name="duration" class="w-4 h-4">
                                    <span class="text-sm text-gray-700">3 Bulan</span>
                                </label>
                                <label class="flex items-center gap-2 p-2 border rounded cursor-pointer hover:bg-blue-50">
                                    <input type="radio" name="duration" class="w-4 h-4">
                                    <span class="text-sm text-gray-700">12 Bulan</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3 pt-4">
                        <form method="POST" action="{{ route('checkout') }}" class="w-full">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3 rounded-lg transition">
                                Lihat Pesanan
                            </button>
                        </form>
                        
                        <a href="https://wa.me/6287751299911" target="_blank" class="w-full flex items-center justify-center gap-2 border-2 border-iosBlue text-iosBlue hover:bg-blue-50 font-bold py-3 rounded-lg transition">
                            <i class="ri-whatsapp-line"></i>
                            Konsultasi
                        </a>
                    </div>
                </div>
            </aside>
        </div>

        <!-- Related Products -->
        @if(!empty($relatedProducts))
        <div class="mt-16">
            <div class="flex items-center gap-2 mb-8">
                <i class="ri-layout-grid-line text-iosBlue text-2xl"></i>
                <h3 class="font-heading text-2xl font-bold text-slate-900">Produk Lainnya</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                <a href="/product?id={{ $related['id'] }}" class="group bg-white rounded-[2rem] p-4 shadow-soft hover:shadow-lg border border-transparent hover:border-blue-100 transition-all duration-300 hover:-translate-y-1 no-underline block">
                    <div class="relative aspect-square rounded-[1.5rem] overflow-hidden mb-4 bg-gray-100">
                        <img src="{{ $related['image'] ?? 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22300%22 height=%22300%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22300%22 height=%22300%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2216%22 fill=%22%23999%22 text-anchor=%22middle%22 dy=%22.3em%22%3EProduct%3C/text%3E%3C/svg%3E' }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" 
                             alt="{{ $related['name'] }}">
                        <div class="absolute top-3 right-3 bg-white/80 backdrop-blur-md text-slate-900 text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1 shadow-sm">
                            <i class="fa-solid fa-star text-yellow-400"></i> 4.9
                        </div>
                    </div>
                    <h4 class="font-bold text-slate-800 text-lg leading-snug mb-1 line-clamp-2 group-hover:text-iosBlue">{{ $related['name'] }}</h4>
                    <p class="text-xs text-gray-400 mb-4">500+ Terjual</p>
                    <div class="flex items-center justify-between">
                        <div>
                            @if($related['oldPrice'])
                            <div class="text-xs text-gray-400 line-through">Rp {{ number_format($related['oldPrice'],0,',','.') }}</div>
                            @endif
                            <div class="text-lg font-bold text-iosBlue">Rp {{ number_format($related['price'],0,',','.') }}</div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center shadow-md group-hover:bg-iosBlue transition-colors">
                            <i class="fa-solid fa-arrow-right text-sm"></i>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Footer -->
@include('partials.footer')

@endsection
