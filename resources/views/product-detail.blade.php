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
            
            <div class="h-4 w-px bg-slate-200 mx-2"></div>

            @guest
                <div x-data class="flex items-center bg-slate-100/80 backdrop-blur-sm rounded-full p-1 border border-slate-200">
                    <button @click.prevent="$dispatch('open-auth-modal', { tab: 'login' })" class="px-4 py-1.5 text-sm font-semibold text-slate-600 hover:text-iosBlue transition-colors rounded-full hover:bg-white hover:shadow-sm">Masuk</button>
                    <button @click.prevent="$dispatch('open-auth-modal', { tab: 'register' })" class="px-4 py-1.5 text-sm font-semibold bg-white text-iosBlue shadow-sm rounded-full transition-transform active:scale-95">Daftar</button>
                </div>
            @else
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 bg-slate-100 hover:bg-slate-200 border border-slate-200 px-3 py-1.5 rounded-full transition-colors">
                        <div class="w-6 h-6 rounded-full bg-gradient-to-r from-iosBlue to-iosPurple flex items-center justify-center text-white text-xs font-bold uppercase">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <span class="text-sm font-semibold text-slate-700 max-w-[80px] break-keep truncate">{{ explode(' ', auth()->user()->name)[0] }}</span>
                        <i class="ri-arrow-down-s-line text-slate-500"></i>
                    </button>
                    <div x-show="open" x-transition x-cloak class="absolute top-full right-0 mt-3 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden z-[100] py-2">
                        <div class="px-4 py-2 border-b border-slate-50 mb-2">
                            <p class="text-xs text-slate-500">Telah Masuk:</p>
                            <p class="text-sm font-bold text-slate-900 truncate" title="{{ auth()->user()->email }}">{{ auth()->user()->email }}</p>
                        </div>
                        @if(auth()->user()->is_admin)
                        <a href="/admin" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-purple-50 hover:text-iosPurple transition-colors">
                            <i class="ri-dashboard-3-line"></i> Admin Panel
                        </a>
                        @endif
                        <a href="/orders" class="flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-blue-50 hover:text-iosBlue transition-colors">
                            <i class="ri-shopping-bag-3-line"></i> Pesanan Saya
                        </a>
                        <button onclick="fetch('/ajax/logout', {method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}}).then(()=>window.location.reload())" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors text-left mt-1 border-t border-slate-50 pt-3">
                            <i class="ri-logout-box-r-line"></i> Keluar
                        </button>
                    </div>
                </div>
            @endguest
        </nav>

        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting['whatsapp_number'] ?? '6287751299911') }}" target="_blank" class="flex items-center gap-2 bg-slate-900 hover:bg-iosBlue text-white px-5 py-2.5 rounded-full text-sm font-semibold transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:scale-95 absolute right-4 sm:right-6">
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
                    <img src="{{ $productData['image'] ?? 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 500 500%22%3E%3Crect fill=%22%23f0f0f0%22 width=%22500%22 height=%22500%22/%3E%3C/svg%3E' }}" 
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
                        <span class="font-bold text-slate-900">{{ number_format($productData['rating'], 1) }}</span>
                        <span class="text-slate-500 text-sm">({{ $productData['reviews_count'] }} ulasan)</span>
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
                        @forelse($product->benefits ?? [] as $benefit)
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-green-500 font-bold"></i>
                                {{ $benefit['text'] ?? '' }}
                            </li>
                        @empty
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-green-500 font-bold"></i>
                                Produk digital berkualitas tinggi
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="ri-check-line text-green-500 font-bold"></i>
                                Customer support 24/7
                            </li>
                        @endforelse
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
                <button @click="tab = 'faq'" 
                        :class="tab === 'faq' ? 'border-b-2 border-iosBlue text-iosBlue' : 'text-slate-600 hover:text-slate-900'"
                        class="pb-4 font-bold transition-colors">
                    FAQ
                </button>
                <button @click="tab = 'ulasan'" 
                        :class="tab === 'ulasan' ? 'border-b-2 border-iosBlue text-iosBlue' : 'text-slate-600 hover:text-slate-900'"
                        class="pb-4 font-bold transition-colors">
                    Ulasan ({{ $productData['reviews_count'] }})
                </button>
            </div>

            <div x-show="tab === 'deskripsi'" x-transition class="prose max-w-none text-slate-600 leading-relaxed">
                <p>{{ $product->description ?? 'Deskripsi produk tidak tersedia' }}</p>
                <p>Produk ini telah dipilih oleh ribuan pengguna dan terbukti meningkatkan efisiensi kerja hingga 40%.</p>
            </div>

            <div x-show="tab === 'faq'" x-transition class="space-y-4">
                @forelse($product->faqs ?? [] as $faq)
                    <div class="bg-slate-50 p-4 rounded-lg border border-slate-100">
                        <h4 class="font-bold text-slate-900 mb-2">{{ $faq['question'] ?? '' }}</h4>
                        <p class="text-sm text-slate-600">{{ $faq['answer'] ?? '' }}</p>
                    </div>
                @empty
                    <div class="bg-slate-50 p-4 rounded-lg">
                        <h4 class="font-bold text-slate-900 mb-2">Belum ada FAQ</h4>
                        <p class="text-sm text-slate-600">FAQ untuk produk ini belum ditambahkan.</p>
                    </div>
                @endforelse
            </div>

            <div x-show="tab === 'ulasan'" x-transition class="space-y-6">

                {{-- Flash success --}}
                @if (session('review_success'))
                    <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-xl">
                        <i class="ri-checkbox-circle-fill text-2xl text-green-500 flex-shrink-0"></i>
                        <p class="font-semibold text-sm">{{ session('review_success') }}</p>
                    </div>
                @endif

                {{-- FORM BERI ULASAN --}}
                <div class="bg-gradient-to-br from-slate-50 to-blue-50 border border-slate-200 rounded-2xl p-6"
                     x-data="{
                        rating: 0,
                        hovered: 0,
                        submitted: false,
                        setRating(val) { this.rating = val; },
                     }">
                    <h3 class="font-bold text-slate-900 mb-1 text-base">Tulis Ulasan Anda</h3>
                    <p class="text-xs text-slate-500 mb-5">Bagikan pengalaman Anda dengan produk ini kepada pembeli lain.</p>

                    <form method="POST" action="{{ route('reviews.store') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="rating" :value="rating" id="rating_input">

                        {{-- Star Rating Picker --}}
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Rating</label>
                            <div class="flex items-center gap-2">
                                <template x-for="star in [1,2,3,4,5]" :key="star">
                                    <button type="button"
                                        @click="setRating(star)"
                                        @mouseenter="hovered = star"
                                        @mouseleave="hovered = 0"
                                        class="text-3xl transition-transform hover:scale-125 focus:outline-none">
                                        <i :class="(hovered || rating) >= star ? 'fa-solid fa-star text-yellow-400' : 'fa-regular fa-star text-slate-300'"></i>
                                    </button>
                                </template>
                                <span class="ml-2 text-sm font-medium text-slate-600"
                                      x-text="rating === 0 ? 'Pilih bintang' : ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Puas', 'Sangat Puas'][rating]">
                                </span>
                            </div>
                            @error('rating')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nama (hanya untuk tamu/guest) --}}
                        @guest
                        <div class="mb-4">
                            <label for="customer_name" class="block text-sm font-semibold text-slate-700 mb-1">Nama Anda</label>
                            <input type="text" name="customer_name" id="customer_name"
                                   value="{{ old('customer_name') }}"
                                   class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-iosBlue focus:border-transparent outline-none transition">
                            @error('customer_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @else
                        <div class="mb-4 flex items-center gap-2 bg-white border border-slate-200 px-4 py-2.5 rounded-lg">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-r from-iosBlue to-iosPurple flex items-center justify-center text-white text-xs font-bold">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="text-sm text-slate-700 font-medium">{{ auth()->user()->name }}</span>
                            <span class="text-xs text-slate-400 ml-auto">(Anda sudah login)</span>
                        </div>
                        @endguest

                        {{-- Komentar --}}
                        <div class="mb-5">
                            <label for="comment" class="block text-sm font-semibold text-slate-700 mb-1">Komentar</label>
                            <textarea name="comment" id="comment" rows="4"
                                      placeholder="Ceritakan pengalaman Anda mengenai produk ini"
                                      class="w-full px-4 py-3 border border-slate-300 rounded-lg text-sm resize-none focus:ring-2 focus:ring-iosBlue focus:border-transparent outline-none transition">{{ old('comment') }}</textarea>
                            @error('comment')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                                :disabled="rating === 0"
                                :class="rating === 0 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-iosPurple hover:shadow-lg hover:-translate-y-0.5'"
                                class="w-full bg-iosBlue text-white font-bold py-3 px-6 rounded-xl transition-all active:scale-95">
                            <i class="ri-send-plane-fill mr-2"></i>Kirim Ulasan
                        </button>
                    </form>
                </div>

                {{-- DIVIDER --}}
                @if($reviews->count() > 0)
                <div class="flex items-center gap-3">
                    <div class="flex-1 h-px bg-slate-200"></div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">{{ $reviews->count() }} Ulasan</span>
                    <div class="flex-1 h-px bg-slate-200"></div>
                </div>
                @endif

                {{-- LIST ULASAN --}}
                @forelse($reviews as $review)
                    <div class="pb-6 border-b border-slate-100 last:border-0">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-iosBlue/20 to-iosPurple/20 flex items-center justify-center font-bold text-slate-700 text-sm">
                                    {{ strtoupper(substr($review->customer_name ?? $review->user?->name ?? 'U', 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-900 text-sm">{{ $review->customer_name ?? $review->user?->name ?? 'Customer' }}</h4>
                                    <p class="text-[10px] text-slate-400">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-0.5 text-yellow-400 text-sm">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star"></i>
                                @endfor
                            </div>
                        </div>
                        <p class="text-sm text-slate-600 italic leading-relaxed">"{{ $review->comment }}"</p>
                    </div>
                @empty
                    <div class="text-center py-6">
                        <i class="ri-chat-history-line text-4xl text-slate-200 mb-3 block"></i>
                        <p class="text-slate-500 text-sm">Belum ada ulasan. Jadilah yang pertama!</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Produk Terkait -->
        <div class="mb-16">
            <h2 class="font-heading text-3xl font-bold text-slate-900 mb-8">Produk Terkait</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    <a href="{{ route('product', ['id' => $related['id']]) }}" class="group bg-white rounded-2xl shadow-soft hover:shadow-xl border border-transparent hover:border-iosBlue transition-all duration-300 hover:-translate-y-2 cursor-pointer block no-underline overflow-hidden">
                        <div class="relative aspect-square rounded-t-2xl overflow-hidden bg-gradient-to-br from-iosBlue/10 to-iosPurple/10 flex items-center justify-center">
                            <img src="{{ $related['image'] }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" alt="{{ $related['name'] }}">
                            <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-md text-iosBlue text-xs font-bold px-2.5 py-1 rounded-lg flex items-center gap-1 shadow-md">
                                <i class="fa-solid fa-star text-yellow-400 text-xs"></i> 4.9
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-slate-900 text-sm line-clamp-2 group-hover:text-iosBlue transition-colors">{{ $related['name'] }}</h4>
                            <p class="text-xs text-slate-500 mb-3">Template Siap Pakai</p>
                            <div class="flex items-end justify-between">
                                <div>
                                    <div class="text-base font-bold text-iosBlue">Rp {{ number_format($related['price'], 0, ',', '.') }}</div>
                                    @if(isset($related['oldPrice']))
                                        <div class="text-xs text-slate-400 line-through">Rp {{ number_format($related['oldPrice'], 0, ',', '.') }}</div>
                                    @endif
                                </div>
                                <div class="w-8 h-8 rounded-full bg-iosBlue text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform flex-shrink-0">
                                    <i class="fa-solid fa-arrow-right text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
@include('partials.footer')
@endsection
