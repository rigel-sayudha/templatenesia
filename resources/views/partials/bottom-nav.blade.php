{{-- Mobile Bottom Navigation Bar --}}
{{-- Hanya tampil di mobile (md:hidden), sinkron dengan desktop navbar --}}
@php
    $currentPath = request()->path();
    $isHome     = $currentPath === '/' || $currentPath === '';
    $isProducts = str_starts_with($currentPath, 'products');
    $isGuide    = str_starts_with($currentPath, 'guide');
@endphp

<nav id="mobile-bottom-nav" class="md:hidden fixed bottom-0 left-0 right-0 z-50" aria-label="Bottom Navigation">
    <div class="glass-bottom-nav">
        <div class="bottom-nav-inner">

            <a href="/" class="bottom-nav-item {{ request()->is('/') || request()->routeIs('home') ? 'active' : '' }}"
               aria-label="Beranda">
                <div class="bottom-nav-icon-wrap">
                    <i class="ri-home-{{ request()->is('/') ? 'fill' : 'line' }}"></i>
                </div>
                <span class="bottom-nav-label">Beranda</span>
            </a>

            <a href="/products" class="bottom-nav-item {{ request()->is('products*') ? 'active' : '' }}"
               aria-label="Produk">
                <div class="bottom-nav-icon-wrap">
                    <i class="ri-shopping-bag-{{ request()->is('products*') ? 'fill' : 'line' }}"></i>
                </div>
                <span class="bottom-nav-label">Produk</span>
            </a>

            <a href="https://wa.me/6287751299911" target="_blank"
               class="bottom-nav-cta"
               aria-label="Hubungi Admin via WhatsApp">
                <div class="bottom-nav-cta-btn">
                    <i class="ri-whatsapp-line"></i>
                </div>
                <span class="bottom-nav-label" style="color:#1D1D1F;">Admin</span>
            </a>

            <a href="/guide" class="bottom-nav-item {{ request()->is('guide*') ? 'active' : '' }}"
               aria-label="Panduan">
                <div class="bottom-nav-icon-wrap">
                    <i class="ri-book-{{ request()->is('guide*') ? 'fill' : 'line' }}"></i>
                </div>
                <span class="bottom-nav-label">Panduan</span>
            </a>

            <a href="/orders" class="bottom-nav-item {{ request()->is('orders*') ? 'active' : '' }}"
               aria-label="Pesanan Saya">
                <div class="bottom-nav-icon-wrap">
                    <i class="ri-file-list-{{ request()->is('orders*') ? 'fill' : 'line' }}"></i>
                </div>
                <span class="bottom-nav-label">Pesanan</span>
            </a>

        </div>
    </div>
</nav>

<style>
    #mobile-bottom-nav {
        padding-bottom: env(safe-area-inset-bottom, 0px);
    }
    .glass-bottom-nav {
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-top: 1px solid rgba(0, 0, 0, 0.06);
        box-shadow: 0 -4px 24px rgba(0, 0, 0, 0.06);
    }

    .bottom-nav-inner {
        display: flex;
        align-items: flex-end;
        justify-content: space-around;
        padding: 0.5rem 0.25rem 0.375rem;
        max-width: 480px;
        margin: 0 auto;
    }

    .bottom-nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.15rem;
        flex: 1;
        min-width: 0;
        text-decoration: none;
        color: #94a3b8;
        transition: color 0.2s ease;
        -webkit-tap-highlight-color: transparent;
    }
    .bottom-nav-item:active { opacity: 0.7; }

    .bottom-nav-icon-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.25rem;
        height: 1.75rem;
        border-radius: 9999px;
        font-size: 1.3rem;
        transition: background 0.2s ease, transform 0.15s ease;
    }
    .bottom-nav-item:active .bottom-nav-icon-wrap {
        transform: scale(0.88);
    }

    .bottom-nav-item.active {
        color: #007AFF;
    }
    .bottom-nav-item.active .bottom-nav-icon-wrap {
        background: rgba(0, 122, 255, 0.1);
    }

    .bottom-nav-label {
        font-size: 0.6rem;
        font-weight: 600;
        letter-spacing: 0.01em;
        line-height: 1;
        white-space: nowrap;
    }

    .bottom-nav-cta {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
        flex: 1;
        min-width: 0;
        text-decoration: none;
        -webkit-tap-highlight-color: transparent;
        position: relative;
        padding-top: 0.1rem;
    }
    .bottom-nav-cta-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 3rem;
        height: 3rem;
        border-radius: 9999px;
        background: #1D1D1F;
        color: white;
        font-size: 1.4rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: background 0.2s ease, transform 0.15s ease, box-shadow 0.2s ease;
        margin-top: -0.75rem; 
    }
    .bottom-nav-cta:active .bottom-nav-cta-btn {
        background: #007AFF;
        transform: scale(0.9);
        box-shadow: 0 2px 6px rgba(0, 122, 255, 0.35);
    }
    .bottom-nav-cta .bottom-nav-label {
        margin-top: 0.1rem;
    }
    @media (max-width: 767px) {
        body {
            padding-bottom: calc(4.5rem + env(safe-area-inset-bottom, 0px));
        }
    }
</style>
