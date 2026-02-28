{{-- Mobile Bottom Navigation Bar --}}
{{-- Hanya tampil di mobile (md:hidden), sinkron dengan desktop navbar --}}
@php
    $currentPath = request()->path();
    $isHome     = request()->is('/') || request()->routeIs('home');
    $isProducts = request()->is('products*');
    $isGuide    = request()->is('guide*');
    $isOrders   = request()->is('orders*');
    $isWishlist = request()->routeIs('wishlist');
@endphp

<nav id="mobile-bottom-nav" class="md:hidden fixed bottom-4 left-4 right-4 z-[90]" aria-label="Bottom Navigation">
    <div class="glass-bottom-nav">
        <div class="bottom-nav-inner grid grid-cols-6 place-items-center w-full">

            {{-- 1. Beranda --}}
            <a href="/" class="bottom-nav-item {{ $isHome ? 'active' : '' }}" aria-label="Beranda">
                <div class="bottom-nav-icon-wrap">
                    <i class="ri-home-5-{{ $isHome ? 'fill' : 'line' }}"></i>
                </div>
                <span class="bottom-nav-label">Home</span>
            </a>

            {{-- 2. Produk --}}
            <a href="/products" class="bottom-nav-item {{ $isProducts ? 'active' : '' }}" aria-label="Produk">
                <div class="bottom-nav-icon-wrap">
                    <i class="ri-shopping-bag-3-{{ $isProducts ? 'fill' : 'line' }}"></i>
                </div>
                <span class="bottom-nav-label">Produk</span>
            </a>

            {{-- 3. Panduan --}}
            <a href="/guide" class="bottom-nav-item {{ $isGuide ? 'active' : '' }}" aria-label="Panduan">
                <div class="bottom-nav-icon-wrap">
                    <i class="ri-book-{{ $isGuide ? 'fill' : 'line' }}"></i>
                </div>
                <span class="bottom-nav-label">Panduan</span>
            </a>

            {{-- 4. Pesanan --}}
            <a href="/orders" class="bottom-nav-item {{ $isOrders ? 'active' : '' }}" aria-label="Pesanan">
                <div class="bottom-nav-icon-wrap">
                    <i class="ri-file-list-3-{{ $isOrders ? 'fill' : 'line' }}"></i>
                </div>
                <span class="bottom-nav-label">Pesanan</span>
            </a>

            {{-- 5. Wishlist --}}
            <a href="/wishlist" class="bottom-nav-item {{ $isWishlist ? 'active' : '' }}" aria-label="Wishlist" x-data>
                <div class="bottom-nav-icon-wrap relative">
                    <i class="ri-heart-3-{{ $isWishlist ? 'fill' : 'line' }}"></i>
                    <span x-show="$store.wishlist.count > 0" x-text="$store.wishlist.count" class="absolute -top-1 -right-2 bg-red-500 text-white min-w-[14px] h-[14px] rounded-full flex items-center justify-center text-[9px] font-bold px-1 ring-2 ring-white" x-cloak></span>
                </div>
                <span class="bottom-nav-label">Wishlist</span>
            </a>

            {{-- 6. Akun/Profil --}}
            @guest
                <button x-data @click.prevent="$dispatch('open-auth-modal', { tab: 'login' })" class="bottom-nav-item" aria-label="Akun">
                    <div class="bottom-nav-icon-wrap">
                        <i class="ri-user-unfollow-line"></i>
                    </div>
                    <span class="bottom-nav-label">Masuk</span>
                </button>
            @else
                <div class="relative flex w-full h-full justify-center" x-data="{ openProfile: false }">
                    <button @click="openProfile = !openProfile" @click.away="openProfile = false" class="bottom-nav-item w-full" aria-label="Akun">
                        <div class="bottom-nav-icon-wrap relative">
                            <div class="w-6 h-6 rounded-full bg-gradient-to-r from-iosBlue to-iosPurple flex items-center justify-center text-white text-xs font-bold ring-2 ring-offset-1 {{ request()->routeIs('profile*') ? 'ring-iosPurple' : 'ring-transparent' }}">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        </div>
                        <span class="bottom-nav-label">Akun</span>
                    </button>
                    
                    {{-- Popup Dropdown Bottom Modal --}}
                    <div x-show="openProfile" x-transition.opacity.duration.200ms x-transition.scale.90.duration.200ms x-cloak 
                         class="absolute bottom-full right-0 mb-3 w-48 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden z-[100] py-2 origin-bottom-right">
                        <div class="px-4 py-2 border-b border-slate-50 mb-1 text-left">
                            <p class="text-xs text-slate-500">Masuk sebagai:</p>
                            <p class="text-sm font-bold text-slate-900 truncate">{{ explode(' ', auth()->user()->name)[0] }}</p>
                        </div>
                        @if(auth()->user()->is_admin)
                        <a href="/admin" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-purple-50 hover:text-iosPurple transition-colors text-left w-full">
                            <i class="ri-dashboard-3-line"></i> Admin Panel
                        </a>
                        @endif
                        <button onclick="fetch('/ajax/logout', {method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}}).then(()=>window.location.reload())" 
                                class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors text-left border-t border-slate-50">
                            <i class="ri-logout-box-r-line"></i> Keluar
                        </button>
                    </div>
                </div>
            @endguest

        </div>
    </div>
</nav>

<style>
    #mobile-bottom-nav {
        padding-bottom: env(safe-area-inset-bottom, 0px);
        filter: drop-shadow(0 10px 25px rgba(139, 92, 246, 0.15));
    }
    .glass-bottom-nav {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 9999px; 
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }

    .bottom-nav-inner {
        padding: 0.5rem 0.25rem;
        max-width: 500px;
        margin: 0 auto;
        position: relative;
    }

    .bottom-nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.25rem;
        width: 100%;
        text-decoration: none;
        color: #94a3b8;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        -webkit-tap-highlight-color: transparent;
        padding: 0.2rem 0;
        border-radius: 1rem;
    }

    .bottom-nav-item:active { 
        transform: scale(0.92); 
    }

    .bottom-nav-icon-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.75rem;   
        height: 2rem;
        border-radius: 9999px;
        font-size: 1.25rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .bottom-nav-item.active {
        color: #8B5CF6; 
    }
    
    .bottom-nav-item.active .bottom-nav-icon-wrap {
        background: rgba(139, 92, 246, 0.12); 
        color: #8B5CF6;
    }

    .bottom-nav-label {
        font-size: 0.6rem;
        font-weight: 500;
        letter-spacing: 0.01em;
        line-height: 1;
        white-space: nowrap;
        transition: font-weight 0.2s;
    }

    .bottom-nav-item.active .bottom-nav-label {
        font-weight: 700;
    }
    
    @media (max-width: 767px) {
        body {
            padding-bottom: calc(5.5rem + env(safe-area-inset-bottom, 0px));
        }
    }
</style>
