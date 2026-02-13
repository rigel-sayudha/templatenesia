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
    tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'], heading: ['Plus Jakarta Sans', 'sans-serif'] }, colors: { iosBlue: '#007AFF', iosPurple: '#9333ea' } } } }
</script>
<style>
    .underline-accent { border-bottom: 2px solid #000; padding-bottom: 12px; }
</style>
@endsection

@section('content')
<!-- Header Topbar -->
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
            <a href="/products" class="text-slate-900 hover:text-iosBlue font-semibold text-sm transition-colors">
                <i class="ri-shopping-bag-line mr-2"></i>Produk
            </a>
            <a href="/guide" class="text-slate-900 hover:text-iosBlue font-semibold text-sm transition-colors">
                <i class="ri-book-line mr-2"></i>Panduan
            </a>
        </nav>

        <a href="https://wa.me/6287751299911" target="_blank" class="flex items-center gap-2 bg-slate-900 hover:bg-iosBlue text-white px-5 py-2.5 rounded-full text-sm font-semibold transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:scale-95 absolute right-4 sm:right-6">
            <i class="ri-whatsapp-line text-lg"></i>
            <span class="hidden sm:inline">Hubungi Admin</span>
        </a>
    </div>
</header>

<div class="min-h-screen bg-gray-50 py-8 pt-32">
    <div x-data="checkoutApp()" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Payment Success Modal/Section -->
        <div x-show="paymentSuccess" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="sticky top-0 bg-white border-b border-gray-200 p-6 flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900">Konfirmasi Pesanan</h2>
                    <button @click="resetForm()" class="text-gray-400 hover:text-gray-600">
                        <i class="ri-close-line text-2xl"></i>
                    </button>
                </div>

                <div class="p-6 space-y-6">
                    <div class="text-center py-4">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                            <i class="ri-check-line text-3xl text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Pesanan Berhasil Dibuat!</h3>
                        <p class="text-gray-600">Invoice: <span class="font-semibold text-gray-900" x-text="paymentData.invoice"></span></p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                        <h4 class="font-semibold text-gray-900 mb-3">Detail Pesanan</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nama:</span>
                                <span class="font-medium text-gray-900" x-text="form.name"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Email:</span>
                                <span class="font-medium text-gray-900" x-text="form.email"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Telepon:</span>
                                <span class="font-medium text-gray-900" x-text="form.phone"></span>
                            </div>
                            <div class="border-t pt-2 mt-2 flex justify-between font-semibold">
                                <span class="text-gray-900">Total:</span>
                                <span class="text-iosBlue text-lg" x-text="formatPrice(paymentData.total)"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Manual Transfer Details -->
                    <div x-show="form.paymentMethod === 'manual'" x-transition class="bg-blue-50 border-2 border-blue-200 rounded-lg p-4 space-y-3">
                        <h4 class="font-semibold text-gray-900 mb-3">
                            <i class="ri-bank-card-line mr-2"></i>Detail Rekening Bank
                        </h4>
                        <div class="space-y-3 text-sm">
                            <div>
                                <p class="text-gray-600 text-xs mb-1">Bank</p>
                                <p class="font-semibold text-blue-600" x-text="paymentData.bankName"></p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-xs mb-1">Nomor Rekening</p>
                                <p class="font-mono font-bold text-gray-900 text-lg" x-text="paymentData.bankAccount"></p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-xs mb-1">Atas Nama</p>
                                <p class="font-semibold text-gray-900" x-text="paymentData.accountName"></p>
                            </div>
                            <div class="bg-white rounded p-3 mt-4">
                                <p class="text-gray-600 text-xs mb-2 font-semibold">Jumlah Transfer:</p>
                                <p class="text-2xl font-bold text-iosBlue" x-text="formatPrice(paymentData.total)"></p>
                            </div>
                        </div>

                        <!-- Transfer Instructions -->
                        <div class="mt-6 pt-6 border-t border-blue-200">
                            <h5 class="font-semibold text-gray-900 mb-3">Langkah-langkah:</h5>
                            <ol class="list-decimal list-inside space-y-2 text-sm text-gray-700">
                                <li>Transfer jumlah sesuai nominal ke rekening di atas</li>
                                <li>Simpan bukti transfer (screenshot/foto)</li>
                                <li>Kirim bukti pembayaran ke WhatsApp admin</li>
                                <li>Tunggu konfirmasi admin dalam waktu 1x24 jam</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Midtrans Details -->
                    <div x-show="form.paymentMethod === 'midtrans'" x-transition class="bg-purple-50 border-2 border-purple-200 rounded-lg p-4 space-y-3">
                        <h4 class="font-semibold text-gray-900 mb-3">
                            <i class="ri-credit-card-line mr-2"></i>Pembayaran melalui Midtrans
                        </h4>
                        <p class="text-sm text-gray-700 mb-4">Pesanan Anda telah dibuat. Silakan lakukan pembayaran melalui tombol di bawah.</p>
                        <div x-show="paymentData.paymentUrl">
                            <a :href="paymentData.paymentUrl" target="_blank" class="block w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-4 rounded text-center transition">
                                <i class="ri-external-link-line mr-2"></i>Lanjutkan Pembayaran
                            </a>
                            <p class="text-xs text-gray-600 text-center mt-2">Anda akan diarahkan ke halaman pembayaran Midtrans</p>
                        </div>
                        <div x-show="!paymentData.paymentUrl" class="bg-red-50 border border-red-200 rounded p-3">
                            <p class="text-sm text-red-700"><i class="ri-alert-line mr-2"></i>Terjadi kesalahan saat membuat transaksi Midtrans. Silakan hubungi admin untuk bantuan.</p>
                        </div>
                    </div>

                    <!-- Admin Contact -->
                    <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                        <p class="text-sm text-gray-700 mb-3"><i class="ri-question-line mr-2 text-iosBlue"></i><span class="font-semibold">Pertanyaan?</span> Hubungi admin kami:</p>
                        <a href="https://wa.me/6287751299911" target="_blank" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-iosBlue text-white px-4 py-2 rounded font-semibold text-sm transition">
                            <i class="ri-whatsapp-line"></i>Hubungi Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <form @submit.prevent="processCheckout" class="space-y-6" x-show="!paymentSuccess" x-transition>
            
            <!-- Top Row: Product Summary & Order Summary -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <!-- Product Summary -->
                <div class="bg-white rounded-lg p-6 border-b-2 border-gray-200">
                    <h3 class="text-lg font-bold mb-4 underline-accent">Ringkasan Produk</h3>
                    
                    <div class="flex gap-4 items-start">
                        <!-- Product Image -->
                        <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-iosBlue to-iosPurple flex items-center justify-center text-white text-2xl flex-shrink-0">
                            <i class="fa-solid fa-box"></i>
                        </div>
                        
                        <!-- Product Info -->
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-900 text-sm" x-text="product.name"></h4>
                            <p class="text-xs text-gray-600 mt-1">Varian yang dipilih:</p>
                            <p class="text-xs text-iosBlue font-medium">Akun: Invite | Durasi: 1 Bulan</p>
                        </div>
                        
                        <!-- Price -->
                        <div class="text-right flex-shrink-0">
                            <p class="text-xs text-red-500 line-through font-medium" x-text="formatPrice(product.oldPrice)"></p>
                            <p class="text-lg font-bold text-gray-900" x-text="formatPrice(product.price)"></p>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-white rounded-lg p-6 border-b-2 border-gray-200">
                    <h3 class="text-lg font-bold mb-4 underline-accent">Ringkasan Pesanan</h3>

                    <div class="flex gap-2 mb-6">
                        <input 
                            type="text" 
                            placeholder="Masukan kode voucher"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-iosBlue focus:border-transparent outline-none"
                        >
                        <button type="button" class="bg-iosBlue text-white px-6 py-2 rounded font-semibold text-sm hover:bg-blue-600 transition">
                            Terapkan
                        </button>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Harga Normal:</span>
                            <span class="text-red-500 font-semibold line-through" x-text="formatPrice(product.oldPrice)"></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Harga Diskon:</span>
                            <span class="text-gray-900 font-semibold" x-text="formatPrice(product.price)"></span>
                        </div>
                    </div>

                    <div class="border-t border-b py-4 mb-6 flex justify-between">
                        <span class="font-bold text-gray-900">Total:</span>
                        <span class="text-2xl font-bold text-iosBlue" x-text="formatPrice(product.price)"></span>
                    </div>

                    <label class="flex items-start gap-2 cursor-pointer text-xs text-gray-600 mb-5">
                        <input 
                            type="checkbox" 
                            x-model="form.agreeTerms"
                            class="mt-0.5 w-4 h-4 text-iosBlue rounded cursor-pointer"
                            required
                        >
                        <span>
                            Saya setuju dengan 
                            <a href="#" class="text-iosBlue hover:underline font-medium">syarat dan ketentuan</a>
                            yang berlaku
                        </span>
                    </label>
                </div>

            </div>

            <!-- Buyer Information & Payment Method Section -->
            <div class="space-y-6">
                
                <!-- Buyer Information -->
                <div class="bg-white rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-5 underline-accent">Informasi Pembeli</h3>
                    
                    <div class="space-y-3">
                        <div>
                            <label class="text-xs font-medium text-gray-700 mb-1.5 block">Nama Lengkap *</label>
                            <input 
                                x-model="form.name" 
                                type="text" 
                                placeholder="Masukkan nama lengkap Anda"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-iosBlue focus:border-transparent outline-none"
                                required
                            >
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-700 mb-1.5 block">Email *</label>
                            <input 
                                x-model="form.email" 
                                type="email" 
                                placeholder="contoh@email.com"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-iosBlue focus:border-transparent outline-none"
                                required
                            >
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-700 mb-1.5 block">Nomor Telepon *</label>
                            <input 
                                x-model="form.phone" 
                                type="tel" 
                                placeholder="08xxxxxxxxxx"
                                class="w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-iosBlue focus:border-transparent outline-none"
                                required
                            >
                        </div>
                    </div>
                </div>


                <!-- Payment Method -->
                <div class="bg-white rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-5 underline-accent">Metode Pembayaran</h3>
                    
                    <!-- 2 Fixed Payment Method Options -->
                    <div class="grid grid-cols-2 gap-3 mb-5">
                        <!-- Transfer Manual Option -->
                        <label class="border-2 rounded-lg p-3 cursor-pointer transition" :class="form.paymentMethod === 'manual' ? 'border-iosBlue bg-blue-50' : 'border-gray-300'">
                            <div class="flex items-center gap-2">
                                <input 
                                    type="radio" 
                                    x-model="form.paymentMethod" 
                                    value="manual"
                                    class="w-4 h-4 text-iosBlue"
                                >
                                <div>
                                    <div class="font-medium text-gray-900 text-sm">Transfer Manual</div>
                                    <div class="text-xs text-gray-500">Ke rekening bank</div>
                                </div>
                            </div>
                        </label>

                        <label class="border-2 rounded-lg p-3 cursor-pointer transition" :class="form.paymentMethod === 'midtrans' ? 'border-iosBlue bg-blue-50' : 'border-gray-300'">
                            <div class="flex items-center gap-2">
                                <input 
                                    type="radio" 
                                    x-model="form.paymentMethod" 
                                    value="midtrans"
                                    class="w-4 h-4 text-iosBlue"
                                >
                                <div>
                                    <div class="font-medium text-gray-900 text-sm">Midtrans</div>
                                    <div class="text-xs text-gray-500">Multi payment</div>
                                </div>
                            </div>
                        </label>
 
                    @if($manualPaymentMethods->count() > 0)
                        <div x-show="form.paymentMethod === 'manual'" x-transition class="space-y-2 mb-5">
                            @foreach($manualPaymentMethods as $method)
                                <label class="border-2 border-gray-300 hover:border-iosBlue rounded-lg p-3 cursor-pointer transition flex items-center justify-between">
                                    <div class="flex items-center gap-2 flex-1">
                                        <input type="radio" x-model="form.bankCode" value="{{ $method->bank_code }}" class="w-4 h-4">
                                        <div class="flex-1">
                                            <span class="text-sm font-semibold text-blue-600">{{ $method->name }}</span>
                                            @if($method->account_number)
                                                <div class="text-xs text-gray-500">{{ $method->account_number }}</div>
                                            @endif
                                            @if($method->account_name)
                                                <div class="text-xs text-gray-500">{{ $method->account_name }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </label>
                            @endforeach

                            <!-- Instructions -->
                            <div class="bg-blue-50 border border-blue-200 rounded p-3 mt-4 text-xs text-gray-600">
                                <h5 class="font-semibold text-gray-900 mb-1 text-sm">Langkah-langkah:</h5>
                                <ol class="list-decimal list-inside space-y-0.5 text-xs">
                                    <li>Transfer sesuai nominal</li>
                                    <li>Simpan bukti transfer</li>
                                    <li>Kirim bukti pembayaran</li>
                                    <li>Konfirmasi admin 1x24 jam</li>
                                </ol>
                            </div>
                        </div>
                    @else
                        <div x-show="form.paymentMethod === 'manual'" x-transition class="mb-5">
                            <p class="text-gray-500 text-xs">Tidak ada metode transfer manual yang tersedia. Hubungi admin.</p>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        :disabled="!form.agreeTerms || loading"
                        class="w-full bg-slate-900 hover:bg-slate-800 disabled:opacity-50 disabled:cursor-not-allowed text-white font-semibold py-2.5 px-4 rounded transition text-center text-sm mt-6"
                    >
                        <span x-show="!loading">Lanjutkan Pembayaran</span>
                        <span x-show="loading">
                            <i class="fa-solid fa-spinner animate-spin"></i> Memproses...
                        </span>
                    </button>
                </div>

            </div>

        </form>

    </div>
</div>

<script>
    function checkoutApp() {
        return {
            loading: false,
            paymentSuccess: false,
            paymentData: {},
            product: {
                name: '{{ $product->title ?? "Paket SOP" }}',
                description: '{{ $product->description ?? "Admin Profile | Dukungan Lengkap | Editable" }}',
                price: {{ $product->price ?? 15000 }},
                oldPrice: {{ $product->old_price ?? 75000 }},
            },
            form: {
                name: '',
                email: '',
                phone: '',
                paymentMethod: 'manual',
                bankCode: '{{ $manualPaymentMethods->first()?->bank_code ?? "" }}',
                agreeTerms: false,
            },
            formatPrice(value) {
                if (!value) return 'Rp 0';
                return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            },
            async processCheckout() {
                if (!this.form.name || !this.form.email || !this.form.phone) {
                    alert('Harap isi semua data pembeli');
                    return;
                }
                if (!this.form.agreeTerms) {
                    alert('Harap setujui syarat dan ketentuan');
                    return;
                }

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
                            quantity: 1,
                            name: this.form.name,
                            email: this.form.email,
                            phone: this.form.phone,
                            paymentMethod: this.form.paymentMethod,
                            bankCode: this.form.bankCode,
                        })
                    });

                    const data = await response.json();
                    
                    if (data.ok) {
                        // Store payment data and show confirmation modal
                        this.paymentData = data;
                        this.paymentSuccess = true;
                        
                        // Auto-scroll to modal
                        setTimeout(() => {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                        }, 100);
                    } else {
                        alert('Error: ' + (data.message || 'Terjadi kesalahan'));
                    }
                } catch (error) {
                    alert('Error: ' + error.message);
                } finally {
                    this.loading = false;
                }
            },
            resetForm() {
                this.paymentSuccess = false;
                this.paymentData = {};
                this.form = {
                    name: '',
                    email: '',
                    phone: '',
                    paymentMethod: 'manual',
                    bankCode: '{{ $manualPaymentMethods->first()?->bank_code ?? "" }}',
                    agreeTerms: false,
                };
            }
        }
    }
</script>
@endsection
