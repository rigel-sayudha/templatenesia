@extends('layouts.app')

@section('title', 'Checkout - Templatenesia Official')

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
    .payment-method-btn { transition: all 0.3s ease; }
    .payment-method-btn.active { @apply border-iosBlue bg-blue-50; }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100">
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

    <div x-data="checkoutApp()" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pt-28">
        <form @submit.prevent="processCheckout" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Checkout Form -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Product Summary -->
                <div class="bg-white rounded-xl p-6 shadow-soft border border-slate-200">
                    <h3 class="font-heading text-lg font-bold text-slate-900 mb-4">Ringkasan Produk</h3>
                    <div class="flex gap-4 pb-4 border-b">
                        <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-iosBlue to-iosPurple flex items-center justify-center text-white text-3xl flex-shrink-0">
                            <i class="fa-solid fa-box"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-slate-900" x-text="product.name"></h4>
                            <p class="text-sm text-slate-500 mt-1" x-text="product.description"></p>
                            <div class="flex gap-2 mt-2">
                                <span class="text-xs bg-iosPurple/10 text-iosPurple px-2 py-1 rounded">Admin Profile</span>
                                <span class="text-xs bg-blue-100 text-iosBlue px-2 py-1 rounded">Dukungan Lengkap</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buyer Information -->
                <div class="bg-white rounded-xl p-6 shadow-soft border border-slate-200">
                    <h3 class="font-heading text-lg font-bold text-slate-900 mb-4">Informasi Pembeli</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap *</label>
                            <input 
                                x-model="form.name" 
                                type="text" 
                                placeholder="Masukkan nama lengkap Anda"
                                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-iosBlue focus:border-transparent outline-none transition"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Email *</label>
                            <input 
                                x-model="form.email" 
                                type="email" 
                                placeholder="contoh@gmail.com"
                                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-iosBlue focus:border-transparent outline-none transition"
                                required
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nomor Telepon *</label>
                            <input 
                                x-model="form.phone" 
                                type="tel" 
                                placeholder="08xxxxxxxxxx"
                                class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-iosBlue focus:border-transparent outline-none transition"
                                required
                            >
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-xl p-6 shadow-soft border border-slate-200">
                    <h3 class="font-heading text-lg font-bold text-slate-900 mb-4">Metode Pembayaran</h3>
                    
                    <div class="space-y-3 mb-6">
                        <label class="payment-method-btn border-2 rounded-lg p-4 cursor-pointer transition" :class="form.paymentMethod === 'transfer' ? 'border-iosBlue bg-blue-50' : 'border-slate-300'">
                            <div class="flex items-center gap-3">
                                <input 
                                    type="radio" 
                                    x-model="form.paymentMethod" 
                                    value="transfer"
                                    class="w-4 h-4"
                                >
                                <div>
                                    <div class="font-semibold text-slate-900">Transfer Manual</div>
                                    <div class="text-sm text-slate-500">Transfer ke rekening bank pilihan Anda</div>
                                </div>
                            </div>
                        </label>

                        <label class="payment-method-btn border-2 rounded-lg p-4 cursor-pointer transition" :class="form.paymentMethod === 'midtrans' ? 'border-iosBlue bg-blue-50' : 'border-slate-300'">
                            <div class="flex items-center gap-3">
                                <input 
                                    type="radio" 
                                    x-model="form.paymentMethod" 
                                    value="midtrans"
                                    class="w-4 h-4"
                                >
                                <div>
                                    <div class="font-semibold text-slate-900">Midtrans</div>
                                    <div class="text-sm text-slate-500">Bayar dengan berbagai metode (Kartu Kredit, E-wallet, dll)</div>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Bank Selection for Transfer -->
                    <div x-show="form.paymentMethod === 'transfer'" x-transition class="space-y-3 border-t pt-6" style="display: none;">
                        <h4 class="font-semibold text-slate-900 mb-3">Pilih Bank Penerima</h4>
                        
                        <label class="border-2 border-slate-300 hover:border-iosBlue rounded-lg p-4 cursor-pointer transition">
                            <div class="flex items-center gap-3">
                                <input type="radio" x-model="form.bankCode" value="bri" class="w-4 h-4">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect fill='%230066CC' width='100' height='100'/%3E%3Ctext x='50' y='60' font-size='40' font-weight='bold' fill='white' text-anchor='middle'%3EBRI%3C/text%3E%3C/svg%3E" alt="BRI" class="w-12 h-10">
                                <div>
                                    <div class="font-semibold text-slate-900">Bank BRI</div>
                                    <div class="text-sm text-slate-500">Transfer via BRI</div>
                                </div>
                            </div>
                        </label>

                        <label class="border-2 border-slate-300 hover:border-iosBlue rounded-lg p-4 cursor-pointer transition">
                            <div class="flex items-center gap-3">
                                <input type="radio" x-model="form.bankCode" value="bca" class="w-4 h-4">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect fill='%231434CB' width='100' height='100'/%3E%3Ctext x='50' y='60' font-size='40' font-weight='bold' fill='white' text-anchor='middle'%3EBCA%3C/text%3E%3C/svg%3E" alt="BCA" class="w-12 h-10">
                                <div>
                                    <div class="font-semibold text-slate-900">Bank BCA</div>
                                    <div class="text-sm text-slate-500">Transfer via BCA</div>
                                </div>
                            </div>
                        </label>

                        <label class="border-2 border-slate-300 hover:border-iosBlue rounded-lg p-4 cursor-pointer transition">
                            <div class="flex items-center gap-3">
                                <input type="radio" x-model="form.bankCode" value="bni" class="w-4 h-4">
                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Crect fill='%23FF6600' width='100' height='100'/%3E%3Ctext x='50' y='60' font-size='40' font-weight='bold' fill='white' text-anchor='middle'%3EBNI%3C/text%3E%3C/svg%3E" alt="BNI" class="w-12 h-10">
                                <div>
                                    <div class="font-semibold text-slate-900">Bank BNI</div>
                                    <div class="text-sm text-slate-500">Transfer via BNI</div>
                                </div>
                            </div>
                        </label>

                        <!-- Payment Steps -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-4">
                            <h5 class="font-semibold text-slate-900 mb-2">Langkah-langkah:</h5>
                            <ol class="text-sm text-slate-700 space-y-1 list-decimal list-inside">
                                <li>Catat nomor rekening penerima</li>
                                <li>Buka aplikasi atau website bank Anda</li>
                                <li>Kirim dana sesuai jumlah yang tertera</li>
                                <li>Kirim bukti transfer untuk verifikasi cepat</li>
                            </ol>
                        </div>

                        <!-- Proof of Payment Upload -->
                        <div class="mt-4">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Upload Bukti Transfer (Opsional)</label>
                            <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center cursor-pointer hover:border-iosBlue transition">
                                <input type="file" class="hidden" accept="image/*">
                                <i class="fa-solid fa-cloud-arrow-up text-2xl text-slate-400 mb-2"></i>
                                <p class="text-sm text-slate-600">Klik untuk upload bukti transfer</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl p-6 shadow-soft border border-slate-200 sticky top-28 space-y-4">
                    <h3 class="font-heading text-lg font-bold text-slate-900">Ringkasan Pesanan</h3>
                    
                    <div class="border-b pb-4 space-y-2">
                        <div class="flex justify-between">
                            <span class="text-slate-600">Harga Normal:</span>
                            <span class="text-slate-600"><del x-text="formatPrice(product.oldPrice)"></del></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Harga Diskon:</span>
                            <span class="text-iosBlue font-semibold" x-text="formatPrice(product.price)"></span>
                        </div>
                    </div>

                    <div class="border-b pb-4 flex justify-between items-center">
                        <span class="font-semibold text-slate-900">Total:</span>
                        <span class="text-2xl font-bold text-iosBlue" x-text="formatPrice(product.price)"></span>
                    </div>

                    <div class="space-y-3">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input 
                                type="checkbox" 
                                x-model="form.agreeTerms"
                                class="mt-1 w-4 h-4 text-iosBlue rounded"
                                required
                            >
                            <span class="text-sm text-slate-600">
                                Saya setuju dengan 
                                <a href="#" class="text-iosBlue hover:underline">syarat dan ketentuan</a> 
                                yang berlaku
                            </span>
                        </label>

                        <button 
                            type="submit"
                            :disabled="!form.agreeTerms || loading"
                            class="w-full bg-iosBlue hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed text-white font-bold py-3 rounded-lg transition"
                        >
                            <span x-show="!loading">Lanjutkan Pembayaran</span>
                            <span x-show="loading">
                                <i class="fa-solid fa-spinner animate-spin"></i> Memproses...
                            </span>
                        </button>

                        <p class="text-xs text-slate-500 text-center">
                            Dengan melanjutkan, Anda setuju untuk menerima WhatsApp notifikasi
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function checkoutApp() {
        return {
            loading: false,
            product: {
                name: '{{ $product->title ?? "Paket SOP" }}',
                description: '{{ $product->description ?? "Admin Profile | Dukungan Lengkap | Editable" }}',
                price: {{ $product->price ?? 249000 }},
                oldPrice: {{ $product->old_price ?? 299000 }},
            },
            form: {
                name: '',
                email: '',
                phone: '',
                paymentMethod: 'transfer',
                bankCode: 'bri',
                agreeTerms: false,
                quantity: 1,
            },
            formatPrice(value) {
                return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            },
            async processCheckout() {
                this.loading = true;
                
                try {
                    const response = await fetch('/checkout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({
                            product_id: {{ $product->id ?? 1 }},
                            quantity: this.form.quantity,
                            name: this.form.name,
                            email: this.form.email,
                            phone: this.form.phone,
                            paymentMethod: this.form.paymentMethod,
                            bankCode: this.form.bankCode,
                        })
                    });

                    const data = await response.json();
                    
                    if (data.ok) {
                        if (this.form.paymentMethod === 'midtrans' && data.paymentUrl) {
                            // Redirect to Midtrans payment
                            window.location.href = data.paymentUrl;
                        } else if (this.form.paymentMethod === 'transfer') {
                            // Show bank transfer details
                            alert(`
Invoice: ${data.invoice}
Nama Bank: ${data.bankName}
Nomor Rekening: ${data.bankAccount}
Atas Nama: ${data.accountName}
Jumlah: ${this.formatPrice(data.total)}

Mohon transfer dan kirimkan bukti transfer untuk verifikasi cepat.
                            `);
                        }
                    } else {
                        alert('Error: ' + (data.message || 'Terjadi kesalahan'));
                    }
                } catch (error) {
                    alert('Error: ' + error.message);
                } finally {
                    this.loading = false;
                }
            }
        }
    }
</script>
            </div>
        </div>
    </div>

    <div class="fixed bottom-6 right-6">
        <button @click="printInvoice" class="bg-white rounded-full p-3 shadow">Print</button>
    </div>
</div>

<script>
    // Midtrans payload injected from server (may be null or a mock)
    var midtrans = @json($midtrans ?? null);

    function paymentApp() {
        return {
            invoiceId: @json($invoiceId ?? null) || Math.floor(Math.random() * 899999) + 100000,
            midtrans: midtrans,
            downloadInvoice() {
                const el = document.getElementById('invoice');
                html2canvas(el).then(canvas => {
                    const imgData = canvas.toDataURL('image/png');
                    const a = document.createElement('a');
                    a.href = imgData;
                    a.download = 'invoice-' + this.invoiceId + '.png';
                    a.click();
                });
            },
            celebrate() { confetti({ particleCount: 120, spread: 70 }); },
            printInvoice() { window.print(); },
            pay() {
                if (! this.midtrans) {
                    alert('Payment gateway not configured; use the debug simulator below.');
                    return;
                }

                if (this.midtrans.redirect_url) {
                    window.location.href = this.midtrans.redirect_url;
                    return;
                }

                if (this.midtrans.client_key && this.midtrans.token) {
                    const script = document.createElement('script');
                    script.src = 'https://app.sandbox.midtrans.com/snap/snap.js';
                    script.setAttribute('data-client-key', this.midtrans.client_key);
                    script.onload = () => {
                        if (window.snap && this.midtrans.token) {
                            window.snap.pay(this.midtrans.token, {
                                onSuccess: function(result){ window.location.reload(); },
                                onPending: function(result){ window.location.reload(); },
                                onError: function(result){ alert('Payment error'); }
                            });
                        } else {
                            alert('Midtrans SDK failed to load.');
                        }
                    };
                    document.head.appendChild(script);
                    return;
                }

                alert('Payment information incomplete.');
            }
        }
    }
</script>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h4 class="font-bold mb-4">Debug / Simulasi Pembayaran</h4>
            <form method="POST" action="{{ route('webhook.payment') }}">
                @csrf
                <input type="hidden" name="invoice_id" value="{{ $invoiceId ?? '' }}">
                <input type="hidden" name="status" value="paid">
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded font-bold">Simulasikan Pembayaran Sukses</button>
            </form>
        </div>
    </div>

@endsection
