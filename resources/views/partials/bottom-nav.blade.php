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

<nav id="mobile-bottom-nav" class="md:hidden fixed bottom-4 left-4 right-4 z-50" aria-label="Bottom Navigation">
    <div class="glass-bottom-nav">
        <div class="bottom-nav-inner">

            <a href="/" class="bottom-nav-item {{ $isHome ? 'active' : '' }}"
               aria-label="Beranda">
                <div class="bottom-nav-icon-wrap">
                    <i class="ri-home-5-{{ $isHome ? 'fill' : 'line' }}"></i>
                </div>
                <span class="bottom-nav-label">Home</span>
            </a>

            <a href="/products" class="bottom-nav-item {{ $isProducts ? 'active' : '' }}"
               aria-label="Produk">
                <div class="bottom-nav-icon-wrap">
                    <i class="ri-shopping-bag-3-{{ $isProducts ? 'fill' : 'line' }}"></i>
                </div>
                <span class="bottom-nav-label">Produk</span>
            </a>

            <a href="https://wa.me/6287751299911" target="_blank"
               class="bottom-nav-cta"
               aria-label="Hubungi Admin via WhatsApp">
                <div class="bottom-nav-cta-btn">
                    <i class="ri-whatsapp-line"></i>
                </div>
            </a>

            @guest
                <button x-data @click.prevent="$dispatch('open-auth-modal', { tab: 'login' })" class="bottom-nav-item" aria-label="Pesanan">
                    <div class="bottom-nav-icon-wrap">
                        <i class="ri-file-list-3-line"></i>
                    </div>
                    <span class="bottom-nav-label">Pesanan</span>
                </button>
            @else
                <a href="/orders" class="bottom-nav-item {{ $isOrders ? 'active' : '' }}" aria-label="Pesanan">
                    <div class="bottom-nav-icon-wrap">
                        <i class="ri-file-list-3-{{ $isOrders ? 'fill' : 'line' }}"></i>
                    </div>
                    <span class="bottom-nav-label">Pesanan</span>
                </a>
            @endguest

            <a href="/wishlist" class="bottom-nav-item {{ $isWishlist ? 'active' : '' }}"
               aria-label="Wishlist" x-data>
                <div class="bottom-nav-icon-wrap relative">
                    <i class="ri-heart-3-{{ $isWishlist ? 'fill' : 'line' }}"></i>
                    <span x-show="$store.wishlist.count > 0" x-text="$store.wishlist.count" class="absolute -top-1 -right-2 bg-red-500 text-white min-w-[14px] h-[14px] rounded-full flex items-center justify-center text-[9px] font-bold px-1 ring-2 ring-white" x-cloak></span>
                </div>
                <span class="bottom-nav-label">Wishlist</span>
            </a>

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
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem 0.5rem;
        max-width: 480px;
        margin: 0 auto;
        position: relative;
    }

    .bottom-nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
        flex: 1;
        min-width: 0;
        text-decoration: none;
        color: #94a3b8;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        -webkit-tap-highlight-color: transparent;
        padding: 0.25rem;
        border-radius: 1rem;
    }

    .bottom-nav-item:active { 
        transform: scale(0.92); 
    }

    .bottom-nav-icon-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 3.5rem;   
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
        font-size: 0.65rem;
        font-weight: 500;
        letter-spacing: 0.02em;
        line-height: 1;
        white-space: nowrap;
        transition: font-weight 0.2s;
    }

    .bottom-nav-item.active .bottom-nav-label {
        font-weight: 700;
    }

    /* Floating Center Button */
    .bottom-nav-cta {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex: 1;
        text-decoration: none;
        -webkit-tap-highlight-color: transparent;
        position: relative;
    }

    .bottom-nav-cta-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 3.25rem;
        height: 3.25rem;
        border-radius: 9999px;
        background: linear-gradient(135deg, #A78BFA, #8B5CF6); 
        color: white;
        font-size: 1.5rem;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateY(-0.75rem); 
    }

    .bottom-nav-cta:active .bottom-nav-cta-btn {
        transform: translateY(-0.75rem) scale(0.9);
        box-shadow: 0 2px 8px rgba(139, 92, 246, 0.6);
    }
    
    @media (max-width: 767px) {
        body {
            padding-bottom: calc(5.5rem + env(safe-area-inset-bottom, 0px));
        }
    }
</style>
