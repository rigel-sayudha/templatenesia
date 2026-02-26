<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Templatenesia')</title>

    {{-- Preconnect untuk percepat koneksi ke CDN --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Icon Libraries --}}
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Plus Jakarta Sans', 'sans-serif']
                    },
                    colors: {
                        iosBlue: '#007AFF',
                        iosPurple: '#9333ea',
                        iosDark: '#1D1D1F',
                        iosBg: '#F5F5F7',
                    },
                    boxShadow: {
                        'soft': '0 8px 30px rgba(0,0,0,0.04)',
                        'glow': '0 0 20px rgba(0, 122, 255, 0.3)',
                    }
                }
            }
        }
    </script>

    {{-- Alpine.js --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
            const userId = {{ auth()->check() ? auth()->id() : 'null' }};
            const storageKey = isLoggedIn ? 'wishlist_user_' + userId : 'wishlist_guest';

            Alpine.store('wishlist', {
                items: JSON.parse(localStorage.getItem(storageKey) || '[]'),
                isLoggedIn: isLoggedIn,
                storageKey: storageKey,
                
                async init() {
                    // Penarikan otentik sinkronisasi state dari server (jika user logged in)
                    if (this.isLoggedIn) {
                        try {
                            const res = await fetch('/ajax/wishlist', { headers: { 'Accept': 'application/json' } });
                            if (res.ok) {
                                const data = await res.json();
                                if (data.ok) {
                                    this.items = data.items;
                                    this.save();
                                }
                            }
                        } catch (e) { console.error('Wishlist Sync Error:', e); }
                    }
                },
                
                async toggle(product) {
                    const index = this.items.findIndex(i => i.id === product.id);
                    // UI Optimistic Update
                    if (index > -1) {
                        this.items.splice(index, 1);
                    } else {
                        this.items.push({
                            id: product.id,
                            name: product.name || product.title || 'Produk Custom',
                            price: product.price || 0,
                            oldPrice: product.oldPrice || product.old_price || null,
                            image: product.image || product.thumbnail || 'https://images.unsplash.com/photo-1542831371-29b0f74f9713?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                        });
                    }
                    this.save();

                    // Sinkronisasi server diam-diam (jika logged in)
                    if (this.isLoggedIn) {
                        try {
                            const res = await fetch('/ajax/wishlist/toggle', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({ product_id: product.id })
                            });
                            const data = await res.json();
                            if (data.ok) {
                                this.items = data.items; // Jaminan akurasi dari DB
                                this.save();
                            }
                        } catch (e) { console.error('Wishlist Sync Error:', e); }
                    }
                },
                
                has(id) {
                    return this.items.some(i => i.id === id);
                },
                
                get count() {
                    return this.items.length;
                },
                
                save() {
                    localStorage.setItem(this.storageKey, JSON.stringify(this.items));
                }
            });
        });
    </script>

    {{-- Centralized CSS --}}
    <link rel="stylesheet" href="{{ asset('css/templatenesia.css') }}">

    {{-- Page Transition Styles --}}
    <style>
        /* Page transition */
        #page-content {
            animation: pageEnter 0.25s ease-out both;
        }
        @keyframes pageEnter {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            width: 0%;
            background: linear-gradient(90deg, #007AFF, #9333ea);
            z-index: 9999;
            transition: width 0.3s ease, opacity 0.4s ease;
            border-radius: 0 2px 2px 0;
        }
        #page-loader.loading {
            width: 80%;
        }
        #page-loader.done {
            width: 100%;
            opacity: 0;
        }

        .glass-header {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
    </style>

    @yield('head')
</head>
<body>
    {{-- Top Loading Bar --}}
    <div id="page-loader"></div>

    <div id="page-content">
        @yield('content')
    </div>

    {{-- Mobile Bottom Navigation — di luar #page-content agar position:fixed tidak terganggu oleh CSS transform --}}
    @include('partials.bottom-nav')

    {{-- Global Auth Modal Container --}}
    @include('partials.auth-modal')

    {{-- Page Transition Script --}}
    <script>
        const loader = document.getElementById('page-loader');

        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (!link) return;
            const href = link.getAttribute('href');
            if (!href || href.startsWith('#') || href.startsWith('javascript') || href.startsWith('mailto') || href.startsWith('tel')) return;
            if (link.target === '_blank') return;
            try {
                const url = new URL(href, window.location.origin);
                if (url.origin !== window.location.origin) return;
            } catch(e) { return; }

            loader.classList.remove('done');
            loader.classList.add('loading');
        });

        window.addEventListener('pageshow', function() {
            loader.classList.remove('loading');
            loader.classList.add('done');
            setTimeout(() => { loader.style.width = '0%'; loader.classList.remove('done'); }, 450);
        });

        document.addEventListener('submit', function() {
            loader.classList.remove('done');
            loader.classList.add('loading');
        });
    </script>
</body>
</html>