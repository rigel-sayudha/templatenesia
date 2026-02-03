@extends('layouts.app')

@section('title', 'Produk - Templatenesia Official')

@section('head')
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script>
    tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'], heading: ['Plus Jakarta Sans', 'sans-serif'] }, colors: { iosBlue: '#007AFF', iosPurple: '#9333ea', iosDark: '#1D1D1F', iosBg: '#F5F5F7', }, boxShadow: { 'soft': '0 8px 30px rgba(0,0,0,0.04)', 'glow': '0 0 20px rgba(0, 122, 255, 0.3)', } } } }
</script>
<style>
    .glass-header { background: rgba(255,255,255,0.8); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(0,0,0,0.05); }
    .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.5rem; }
    @media (max-width: 768px) { .product-grid { grid-template-columns: repeat(2, 1fr); } }
</style>
@endsection

@section('content')
<header class="fixed top-0 w-full z-50 glass-header transition-all duration-300">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 h-20 flex items-center justify-center relative">
        <!-- Logo di kiri -->
        <a href="/" class="flex items-center gap-3 cursor-pointer hover:opacity-80 transition absolute left-4 sm:left-6">
            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjRzyTdfjkBugSP3Ew_vmkaeMQKl0XnZVR83kFV0LtKJXC4gVF_WTGPS57iCampIjdlGU09l_Ct0hw_2Tx51GiHj5uWr6fTYqzJirf8qpAKhwW0AsM-pYcam74_l25KpFvShEYQdkJ-UnuJQsuiP7qa7Ek85k0MWaF0X0pHGmJZ2imL8IQK9ip5M9s2sW0/s16000/Templatenesia%20Logo.jpg" 
                 class="w-10 h-10 rounded-lg object-cover shadow-sm" alt="Templatenesia Logo">
            <div>
                <h1 class="font-heading font-extrabold text-xl text-slate-900 leading-none">Template<span class="text-iosPurple">nesia</span>.</h1>
            </div>
        </a>

        <!-- Navigation Menu di Tengah -->
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
        </nav>

        <!-- Button di kanan -->
        <a href="https://wa.me/6287751299911" target="_blank" class="flex items-center gap-2 bg-slate-900 hover:bg-iosBlue text-white px-5 py-2.5 rounded-full text-sm font-semibold transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:scale-95 absolute right-4 sm:right-6">
            <i class="ri-whatsapp-line text-lg"></i>
            <span class="hidden sm:inline">Hubungi Admin</span>
        </a>
    </div>
</header>

<div x-data="productsApp()" x-init="init()" class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100 pt-32 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="mb-8">
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-4">
                <a href="/" class="hover:text-iosBlue">Beranda</a>
                <i class="ri-arrow-right-s-line"></i>
                <span class="text-slate-900 font-semibold">Produk</span>
            </div>
            <h1 class="font-heading text-4xl font-extrabold text-slate-900">Semua Produk Digital</h1>
            <p class="text-slate-500 mt-2">Temukan source code dan template terbaik untuk proyek Anda</p>
        </div>

<div x-show="selectedCategory" class="mb-6 flex items-center gap-2">
            <span class="text-sm text-slate-600">Filter aktif:</span>
            <span class="inline-flex items-center gap-2 px-3 py-1 bg-iosBlue text-white text-sm font-semibold rounded-lg">
                Kategori: <span x-text="selectedCategory"></span>
                <button @click="selectedCategory = ''; updateFilteredProducts();" class="hover:opacity-70">
                    <i class="ri-close-line"></i>
                </button>
            </span>
        </div>

        <div class="mb-8 flex items-center gap-3 overflow-x-auto pb-2">
            <button 
                @click="filterType = 'all'; updateFilteredProducts();"
                :class="filterType === 'all' ? 'bg-iosBlue text-white' : 'bg-white text-slate-900 border border-slate-300'"
                class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition-all"
            >
                Semua
            </button>
            <button 
                @click="filterType = 'discount'; updateFilteredProducts();"
                :class="filterType === 'discount' ? 'bg-iosBlue text-white' : 'bg-white text-slate-900 border border-slate-300'"
                class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition-all"
            >
                <i class="ri-price-tag-line mr-1"></i>Diskon
            </button>
            <button 
                @click="filterType = 'popular'; updateFilteredProducts();"
                :class="filterType === 'popular' ? 'bg-iosBlue text-white' : 'bg-white text-slate-900 border border-slate-300'"
                class="px-4 py-2 rounded-lg font-semibold text-sm whitespace-nowrap transition-all"
            >
                <i class="ri-star-line mr-1"></i>Populer
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- LEFT SIDEBAR: FILTERS -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl p-6 shadow-soft border border-slate-200 sticky top-32 space-y-6">
                    <div>
                        <label class="text-sm font-bold text-slate-900 mb-2 block">Pencarian</label>
                        <div class="relative">
                            <i class="ri-search-2-line absolute left-3 top-3 text-slate-400 text-lg"></i>
                            <input 
                                x-model="searchQuery"
                                @input="updateFilteredProducts()"
                                type="text" 
                                placeholder="Cari produk..."
                                class="w-full pl-10 pr-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-iosBlue focus:border-transparent outline-none text-sm"
                            >
                        </div>
                    </div>

                    <!-- KATEGORI -->
                    <div>
                        <label class="text-sm font-bold text-slate-900 mb-3 block">Kategori</label>
                        <div class="space-y-2">
                            <button 
                                @click="selectedCategory = ''; updateFilteredProducts();"
                                :class="!selectedCategory ? 'bg-iosBlue text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="w-full text-left px-4 py-2 rounded-lg text-sm font-semibold transition-colors"
                            >
                                Semua Kategori
                            </button>
                            <template x-for="cat in categories" :key="cat">
                                <button 
                                    @click="selectedCategory = cat; updateFilteredProducts();"
                                    :class="selectedCategory === cat ? 'bg-iosBlue text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                    class="w-full text-left px-4 py-2 rounded-lg text-sm font-semibold transition-colors"
                                    x-text="cat"
                                >
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- URUTAN -->
                    <div>
                        <label class="text-sm font-bold text-slate-900 mb-2 block">Urutan</label>
                        <select 
                            x-model="sortBy"
                            @change="updateFilteredProducts()"
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-iosBlue focus:border-transparent outline-none text-sm"
                        >
                            <option value="newest">Terbaru</option>
                            <option value="popular">Paling Laris</option>
                            <option value="price-low">Harga Terendah</option>
                            <option value="price-high">Harga Tertinggi</option>
                        </select>
                    </div>

                    <button 
                        @click="resetFilters"
                        class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2.5 px-4 rounded-lg transition-all"
                    >
                        <i class="ri-refresh-line mr-2"></i>Reset Filter
                    </button>
                </div>
            </div>

            <div class="lg:col-span-3">
                <!-- Product Stats -->
                <div class="mb-6 text-sm text-slate-600">
                    Menampilkan <span class="font-bold" x-text="filteredProducts.length"></span> dari <span class="font-bold" x-text="allProducts.length"></span> produk
                </div>

                <!-- Product Grid -->
                <div x-show="filteredProducts.length > 0" class="product-grid">
                    <template x-for="product in filteredProducts" :key="product.id">
                        <a 
                            :href="'/product?id=' + product.id"
                            class="group bg-white rounded-2xl shadow-soft hover:shadow-xl border border-transparent hover:border-iosBlue transition-all duration-300 hover:-translate-y-2 cursor-pointer block no-underline overflow-hidden"
                        >
                            <!-- Image -->
                            <div class="relative aspect-square rounded-t-2xl overflow-hidden bg-gradient-to-br from-iosBlue/10 to-iosPurple/10">
                                <img :src="product.image" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" :alt="product.title || product.name || 'Product'">
                                
                                <!-- Category Badge -->
                                <div class="absolute top-3 left-3 bg-iosBlue/90 backdrop-blur-md text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-md">
                                    <span x-text="product.category || 'Produk'"></span>
                                </div>
                                
                                <!-- Discount Badge -->
                                <div x-show="product.old_price && product.price < product.old_price" class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-lg shadow-md flex items-center gap-1">
                                    <span x-text="Math.round((1 - product.price / product.old_price) * 100)"></span>% OFF
                                </div>
                                
                                <!-- Popular Badge -->
                                <div x-show="product.is_popular" class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-md text-iosBlue text-xs font-bold px-2.5 py-1 rounded-lg flex items-center gap-1 shadow-md">
                                    <i class="fa-solid fa-star text-yellow-400 text-xs"></i> Popular
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-4">
                                <h4 class="font-heading font-extrabold text-slate-900 text-base leading-snug mb-2 line-clamp-2 group-hover:text-iosBlue transition-colors h-10" x-text="product.title || product.name || 'Produk'"></h4>
                                <p class="text-xs text-slate-500 mb-3 line-clamp-2 h-9" x-text="product.description || 'Deskripsi tidak tersedia'"></p>
                                
                                <div class="flex items-end justify-between">
                                    <div class="flex flex-col gap-1">
                                        <div x-show="product.old_price && product.price < product.old_price" class="text-xs text-gray-400 line-through">
                                            Rp <span x-text="formatPrice(product.old_price)"></span>
                                        </div>
                                        <div class="text-lg font-bold text-iosBlue">
                                            Rp <span x-text="formatPrice(product.price)"></span>
                                        </div>
                                    </div>
                                    <div class="w-10 h-10 rounded-full bg-iosBlue text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-arrow-right text-sm"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </template>
                </div>

                <!-- Empty State -->
                <div x-show="filteredProducts.length === 0" class="text-center py-20">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400 text-3xl">
                        <i class="ri-emotion-unhappy-line"></i>
                    </div>
                    <h3 class="font-bold text-xl text-slate-900">Produk tidak ditemukan</h3>
                    <p class="text-slate-500 mt-2">Coba gunakan kata kunci atau kategori lain</p>
                    <button @click="resetFilters" class="mt-4 text-iosBlue font-bold hover:underline">
                        Reset Filter
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function productsApp() {
        return {
            searchQuery: '',
            selectedCategory: '',
            filterType: 'all', // 'all', 'discount', 'popular'
            sortBy: 'newest',
            allProducts: [],
            categories: [],
            filteredProducts: [],
            
            init() {
                // Initialize with data from Laravel
                this.allProducts = @json($products ?? []);
                
                // Log for debugging
                console.log('Products App Initialized');
                console.log('Total products:', this.allProducts.length);
                
                // Update derived data
                this.updateCategories();
                this.updateFilteredProducts();
            },

            updateCategories() {
                const uniqueCategories = [...new Set(
                    this.allProducts
                        .map(p => p.category)
                        .filter(c => c && c.length > 0)
                )];
                this.categories = uniqueCategories.sort();
                console.log('Categories:', this.categories);
            },

            updateFilteredProducts() {
                let filtered = this.allProducts.filter(p => {
                    // Support both 'title' and 'name' fields
                    const productTitle = (p.title || p.name || '').toLowerCase();
                    const productDesc = (p.description || '').toLowerCase();
                    const searchQuery = (this.searchQuery || '').toLowerCase();
                    
                    const matchSearch = !searchQuery || 
                        productTitle.includes(searchQuery) ||
                        productDesc.includes(searchQuery);
                    
                    const matchCategory = !this.selectedCategory || p.category === this.selectedCategory;
                    
                    // Filter by type
                    let matchType = true;
                    if (this.filterType === 'discount') {
                        matchType = p.old_price && p.price < p.old_price;
                    } else if (this.filterType === 'popular') {
                        matchType = p.is_popular;
                    }
                    
                    return matchSearch && matchCategory && matchType;
                });

                // Sort
                if (this.sortBy === 'popular') {
                    filtered.sort((a, b) => (b.is_popular ? 1 : 0) - (a.is_popular ? 1 : 0));
                } else if (this.sortBy === 'price-low') {
                    filtered.sort((a, b) => (a.price || 0) - (b.price || 0));
                } else if (this.sortBy === 'price-high') {
                    filtered.sort((a, b) => (b.price || 0) - (a.price || 0));
                }

                this.filteredProducts = filtered;
                console.log('Filtered products:', this.filteredProducts.length);
            },

            formatPrice(value) {
                if (!value) return '0';
                return String(value).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            },

            resetFilters() {
                this.searchQuery = '';
                this.selectedCategory = '';
                this.filterType = 'all';
                this.sortBy = 'newest';
                this.updateFilteredProducts();
            }
        }
    }

</script>

<!-- Footer -->
@include('partials.footer')
@endsection
