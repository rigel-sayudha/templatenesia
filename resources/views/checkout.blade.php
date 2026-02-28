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

<div class="min-h-screen bg-gray-50 py-8 pt-32">
        <div x-data="checkoutApp()" class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div x-show="paymentSuccess" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                    <div class="sticky top-0 bg-white border-b border-gray-200 p-6 flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-900">Konfirmasi Pesanan</h2>
                        <button @click="window.location.href = '/orders'" class="text-gray-400 hover:text-gray-600">
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

                        <div x-show="form.paymentMethod === 'midtrans'" x-transition class="bg-purple-50 border-2 border-purple-200 rounded-lg p-4 space-y-3">
                            <h4 class="font-semibold text-gray-900 mb-3">
                                <i class="ri-credit-card-line mr-2"></i>Pembayaran melalui Midtrans
                            </h4>
                            <p class="text-sm text-gray-700 mb-4">Pesanan Anda telah dibuat. Silakan lakukan pembayaran melalui tombol di bawah.</p>
                            <div x-show="paymentData.paymentUrl">
                                <a :href="paymentData.paymentUrl" class="block w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-4 rounded text-center transition">
                                    <i class="ri-external-link-line mr-2"></i>Lanjutkan ke Midtrans Snap
                                </a>
                                <p class="text-xs text-gray-600 text-center mt-2">Anda akan dialihkan ke layar aman pembayaran resmi Midtrans</p>
                            </div>
                            <div x-show="!paymentData.paymentUrl" class="bg-red-50 border border-red-200 rounded p-3">
                                <p class="text-sm text-red-700"><i class="ri-alert-line mr-2"></i>Link Pembayaran Midtrans batal ditarik. Hubungi Admin.</p>
                            </div>
                        </div>

                        <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                            <p class="text-sm text-gray-700 mb-3"><i class="ri-question-line mr-2 text-iosBlue"></i><span class="font-semibold">Pertanyaan?</span> Hubungi admin kami:</p>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting['whatsapp_number'] ?? '6287751299911') }}" target="_blank" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-iosBlue text-white px-4 py-2 rounded font-semibold text-sm transition">
                                <i class="ri-whatsapp-line"></i>Hubungi Admin
                            </a>
                        </div>
                        
                        <!-- Upload Bukti Pembayaran Section -->
                        <template x-if="form.paymentMethod === 'manual'">
                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200 mt-4 relative">
                                <h4 class="text-sm font-bold text-slate-900 mb-3 uppercase tracking-wider">Unggah Bukti Transfer</h4>
                                <div x-show="!paymentData.proofUploaded" class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">
                                    <p class="text-xs text-slate-500 mb-3">Pesanan Anda belum diproses. Harap unggah struk transfer agar admin dapat memvalidasinya.</p>
                                    <input 
                                        type="file" 
                                        x-ref="postPaymentProof"
                                        accept=".jpg,.jpeg,.png,.pdf"
                                        class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 cursor-pointer outline-none mb-3"
                                    >
                                    <button 
                                        type="button"
                                        @click="uploadPostProof"
                                        :disabled="uploadingProof"
                                        class="w-full bg-slate-900 hover:bg-iosBlue text-white font-bold py-2.5 rounded-xl transition-all shadow-md active:scale-[0.98] flex items-center justify-center gap-2 text-sm disabled:opacity-50"
                                    >
                                        <i class="ri-upload-cloud-2-line"></i>
                                        <span x-show="!uploadingProof">Submit Bukti Pembayaran</span>
                                        <span x-show="uploadingProof"><i class="fa-solid fa-spinner animate-spin"></i> Mengunggah...</span>
                                    </button>
                                    <div class="text-center mt-3">
                                        <button type="button" @click="resetForm(); window.location.href='/orders'" class="text-xs text-iosBlue hover:underline font-medium">Unggah Nanti di Menu Pesanan</button>
                                    </div>
                                </div>
                                <div x-show="paymentData.proofUploaded" x-transition class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 shrink-0">
                                        <i class="ri-check-line text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-green-800 text-sm">Bukti Berhasil Diunggah!</p>
                                        <p class="text-xs text-green-700 mt-0.5">Admin kami akan segera memverifikasi pembayaran Anda.</p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div> 

            <form @submit.prevent="validateAndShowTnc" id="checkoutForm" class="space-y-6" x-show="!paymentSuccess" x-transition>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    
                    <!-- Product Summary -->
                    <div class="bg-white rounded-lg p-6 border-b-2 border-gray-200">
                        <h3 class="text-lg font-bold mb-4 underline-accent">Ringkasan Produk</h3>
                        
                        <div class="flex gap-4 items-start">
                            <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-iosBlue to-iosPurple flex items-center justify-center text-white text-2xl flex-shrink-0">
                                <i class="fa-solid fa-box"></i>
                            </div>

                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 text-sm" x-text="product.name"></h4>
                                <p class="text-xs text-gray-600 mt-1">Varian yang dipilih:</p>
                                <p class="text-xs text-iosBlue font-medium">Akun: Invite | Durasi: 1 Bulan</p>
                            </div>
                            
                            <div class="text-right flex-shrink-0">
                                <p class="text-xs text-red-500 line-through font-medium" x-text="formatPrice(product.oldPrice)"></p>
                                <p class="text-lg font-bold text-gray-900" x-text="formatPrice(product.price)"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="bg-white rounded-lg p-6 border-b-2 border-gray-200">
                        <h3 class="text-lg font-bold mb-4 underline-accent">Ringkasan Pesanan</h3>

                        <div class="flex gap-2 mb-6" x-show="!appliedVoucher">
                            <input 
                                type="text" 
                                x-model="form.voucherCode"
                                placeholder="Masukan kode voucher"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-iosBlue focus:border-transparent outline-none"
                            >
                            <button type="button" @click="applyVoucherCode" :disabled="loading" class="bg-iosBlue text-white px-6 py-2 rounded font-semibold text-sm hover:bg-blue-600 transition disabled:opacity-50">
                                Terapkan
                            </button>
                        </div>

                        <!-- Info Kupon Berhasil -->
                        <div x-show="appliedVoucher" x-transition class="mb-6 bg-green-50 border border-green-200 rounded p-3 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="ri-coupon-3-fill text-green-600 text-lg"></i>
                                <div>
                                    <p class="text-xs text-slate-500 font-medium">Kupon Diterapkan:</p>
                                    <p class="text-sm font-bold text-green-700" x-text="appliedVoucher?.code"></p>
                                </div>
                            </div>
                            <button type="button" @click="removeVoucher" class="text-red-500 hover:bg-red-50 p-1.5 rounded-full transition-colors" title="Hapus Kupon">
                                <i class="ri-close-line text-lg"></i>
                            </button>
                        </div>

                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Harga Normal:</span>
                                <span class="text-slate-400 font-semibold line-through" x-text="formatPrice(product.oldPrice)"></span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Harga Diskon:</span>
                                <span class="text-gray-900 font-semibold" x-text="formatPrice(product.price)"></span>
                            </div>
                            <div class="flex justify-between text-sm" x-show="appliedVoucher">
                                <span class="text-green-600">Potongan Kupon:</span>
                                <span class="text-green-600 font-bold" x-text="'- ' + formatPrice(product.price - finalTotal)"></span>
                            </div>
                        </div>

                        <div class="border-t border-b py-4 mb-6 flex justify-between">
                            <span class="font-bold text-gray-900">Total:</span>
                            <span class="text-2xl font-bold text-iosBlue" x-text="formatPrice(finalTotal)"></span>
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
                                <a href="#" @click.prevent="showTNC = true; document.body.style.overflow = 'hidden';" class="text-iosBlue hover:underline font-medium">syarat dan ketentuan</a>
                                yang berlaku
                            </span>
                        </label>
                    </div>

                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-5 underline-accent">Informasi Pembeli</h3>
                        
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-medium text-gray-700 mb-1.5 block">Nama Lengkap *</label>
                                <input 
                                    x-model="form.name" 
                                    type="text" 
                                    name="name"
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
                                    name="email"
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
                                    name="phone"
                                    placeholder="08xxxxxxxxxx"
                                    class="w-full px-3 py-2.5 border border-gray-300 rounded text-sm focus:ring-2 focus:ring-iosBlue focus:border-transparent outline-none"
                                    required
                                >
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-5 underline-accent">Metode Pembayaran</h3>

                        <div class="grid grid-cols-2 gap-3 mb-5">
                            <label class="border-2 rounded-lg p-3 cursor-pointer transition" :class="form.paymentMethod === 'manual' ? 'border-iosBlue bg-blue-50' : 'border-gray-300'">
                                <div class="flex items-center gap-2">
                                    <input 
                                        type="radio" 
                                        x-model="form.paymentMethod" 
                                        name="paymentMethod"
                                        value="manual"
                                        class="w-4 h-4 text-iosBlue"
                                        required
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
                                        name="paymentMethod"
                                        value="midtrans"
                                        class="w-4 h-4 text-iosBlue"
                                        required
                                    >
                                    <div>
                                        <div class="font-medium text-gray-900 text-sm">Midtrans</div>
                                        <div class="text-xs text-gray-500">Multi payment</div>
                                    </div>
                                </div>
                            </label>
                        </div>
    
                        <div x-show="form.paymentMethod === 'manual'" x-transition class="mb-5 mt-4">
                            @if($manualPaymentMethods->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        @foreach($manualPaymentMethods as $method)
                                            <label class="border-2 border-gray-300 hover:border-iosBlue rounded-lg p-3 cursor-pointer transition flex items-center justify-between" :class="{'border-iosBlue bg-blue-50': form.bankCode === '{{ $method->bank_code }}'}">
                                                <div class="flex items-center gap-3 flex-1">
                                                    <input type="radio" x-model="form.bankCode" name="bankCode" value="{{ $method->bank_code }}" class="w-4 h-4 text-iosBlue mt-0.5 self-start">
                                                    
                                                    @if($method->logo && Storage::disk('public')->exists($method->logo))
                                                        <div class="w-12 h-8 bg-white border border-gray-100 rounded flex items-center justify-center p-1 shrink-0">
                                                            <img src="{{ asset('storage/' . $method->logo) }}" alt="{{ $method->name }}" class="max-w-full max-h-full object-contain">
                                                        </div>
                                                    @endif

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
                                    </div>
                                                                        <!-- Transfer manual instructions -->
                                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-xs text-gray-600 h-fit md:col-span-2">
                                        <h5 class="font-semibold text-gray-900 mb-2 text-sm">Langkah-langkah:</h5>
                                        <ol class="list-decimal list-inside space-y-1.5 text-xs text-gray-700">
                                            <li>Selesaikan pesanan (Checkout) terlebih dahulu.</li>
                                            <li>Transfer sesuai nominal ke rekening bank yang tertera di layar selanjutnya.</li>
                                            <li>Simpan screenshot / foto bukti transfer Anda.</li>
                                            <li>Unggah bukti pembayaran pada jendela Tagihan/Pesanan Saya.</li>
                                        </ol>
                                    </div>
                                </div>
                            @else
                                <div class="mb-5">
                                    <p class="text-gray-500 text-xs">Tidak ada metode transfer manual yang tersedia. Hubungi admin.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button 
                            @click.prevent="validateAndShowTnc"
                            type="button"
                            :class="{'opacity-50 cursor-not-allowed': loading, 'hover:scale-[1.02]': !loading}"
                            :disabled="loading"
                            class="w-full bg-slate-900 hover:bg-iosBlue text-white font-bold px-6 py-4 rounded-xl transition-all shadow-lg hover:shadow-xl active:scale-[0.98] flex items-center justify-center group mt-6 relative overflow-hidden"
                        >
                            <div class="absolute inset-0 w-1/4 h-full bg-white/20 skew-x-12 -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]"></div>
                            <i class="ri-secure-payment-line mr-2 text-xl group-hover:-translate-y-1 transition-transform"></i>
                            <span x-show="!loading">Lanjutkan Pembayaran</span>
                            <span x-show="loading">
                                <i class="fa-solid fa-spinner animate-spin"></i> Memproses...
                            </span>
                        </button>
                    </div>

                </div>

            </form>

    <!-- Modal Syarat & Ketentuan (T&C) Checkout -->
    @if($termsAndConditions)
    <div x-cloak x-show="showTNC" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div x-show="showTNC" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             @click="closeTnc"
             class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>

        <!-- Modal Panel -->
        <div x-show="showTNC" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all w-full max-w-2xl flex flex-col max-h-[90vh]">
            
            <!-- Header -->
            <div class="bg-slate-50 border-b border-slate-100 px-6 py-5 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-iosBlue/10 flex items-center justify-center text-iosBlue">
                        <i class="ri-file-paper-2-line text-xl"></i>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-slate-900" id="modal-title">Syarat & Ketentuan</h3>
                </div>
                <button @click="closeTnc" class="text-slate-400 hover:text-red-500 bg-white hover:bg-red-50 w-8 h-8 rounded-full flex items-center justify-center transition-colors shadow-sm">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>

            <!-- Body (Scrollable) -->
            <div class="px-6 py-6 space-y-4 overflow-y-auto grow custom-scrollbar">
                <div class="prose prose-slate prose-img:rounded-xl prose-a:text-iosBlue max-w-none text-sm text-slate-600 leading-relaxed">
                    {!! $termsAndConditions->content !!}
                </div>
                
                <div class="mt-6 bg-blue-50 border border-iosBlue/20 rounded-xl p-4 flex items-start gap-4">
                    <i class="ri-information-line text-iosBlue text-xl mt-0.5"></i>
                    <p class="text-sm text-slate-700">
                        Dengan menekan tombol <strong>"Saya Setuju & Lanjutkan"</strong>, Anda menyatakan telah membaca, memahami, dan menyetujui seluruh syarat ketentuan layanan untuk pembelian produk digital di atas.
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-5 border-t border-slate-100 flex flex-col sm:flex-row gap-3 justify-end shrink-0">
                <button @click="closeTnc" type="button" class="px-6 py-3 font-semibold text-slate-500 hover:bg-slate-200 bg-slate-100 rounded-xl transition-colors min-w-[120px]">
                    Batal
                </button>
                <button @click="agreeAndSubmit" type="button" class="px-6 py-3 font-bold text-white bg-slate-900 hover:bg-iosBlue rounded-xl shadow-lg transition-all min-w-[180px] flex items-center justify-center gap-2">
                    <i class="ri-check-line"></i> Saya Setuju & Lanjutkan
                </button>
            </div>
            
        </div>
    </div>
    @endif

        </div>
    </div>
<script>
    function checkoutApp() {
        return {
            init() {
                console.log("Alpine checkoutApp initialized successfully!");
            },
            loading: false,
            paymentSuccess: false,
            paymentData: {},
            showTNC: false,
            validateAndShowTnc() {
                if (!this.form.name || !this.form.email || !this.form.phone) {
                    alert('Harap isi semua data pembeli dengan lengkap.');
                    return;
                }
                if (!this.form.agreeTerms) {
                    alert('Harap setujui syarat dan ketentuan ringkasan pesanan.');
                    return;
                }
                if (!this.form.paymentMethod || (this.form.paymentMethod === 'manual' && !this.form.bankCode)) {
                    alert('Harap pilih bank/metode pembayaran.');
                    return;
                }
                
                this.showTNC = true;
                document.body.style.overflow = 'hidden';
            },
            closeTnc() {
                this.showTNC = false;
                document.body.style.overflow = 'auto';
            },
            agreeAndSubmit() {
                this.form.agreeTerms = true;
                this.closeTnc();
                this.processCheckout();
            },
            product: {
                id: {{ $product->id ?? 1 }},
                name: @json($product->name ?? "Paket SOP"),
                description: @json($product->description ?? "Admin Profile | Dukungan Lengkap | Editable"),
                price: {{ $product->price ?? 15000 }},
                oldPrice: {{ $product->old_price ?? 75000 }},
            },
            form: {
                name: '',
                email: '',
                phone: '',
                paymentMethod: 'manual',
                bankCode: @json($manualPaymentMethods->first()?->bank_code ?? ""),
                agreeTerms: false,
                voucherCode: ''
            },
            appliedVoucher: null,
            get finalTotal() {
                let t = this.product.price;
                if (this.appliedVoucher) {
                    if (this.appliedVoucher.type === 'nominal') {
                        t -= this.appliedVoucher.value;
                    } else if (this.appliedVoucher.type === 'percentage') {
                        t -= t * (this.appliedVoucher.value / 100);
                    }
                }
                return t < 0 ? 0 : t;
            },
            formatPrice(value) {
                if (!value && value !== 0) return 'Rp 0';
                return 'Rp ' + Math.round(value).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            },
            async applyVoucherCode() {
                if (!this.form.voucherCode) {
                    alert('Silakan masukkan sandi voucher.');
                    return;
                }
                this.loading = true;
                try {
                    const res = await fetch('/checkout/apply-voucher', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({ 
                            code: this.form.voucherCode,
                            product_id: this.product.id 
                        })
                    });
                    const data = await res.json();
                    if (data.ok) {
                        this.appliedVoucher = data.voucher;
                        alert(data.message);
                    } else {
                        alert(data.message || 'Kupon tidak valid.');
                        this.form.voucherCode = '';
                    }
                } catch (err) {
                    alert('Gagal memverifikasi kupon.');
                } finally {
                    this.loading = false;
                }
            },
            removeVoucher() {
                this.appliedVoucher = null;
                this.form.voucherCode = '';
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
                    let formData = new FormData();
                    formData.append('product_id', this.product.id);
                    formData.append('quantity', 1);
                    formData.append('name', this.form.name);
                    formData.append('email', this.form.email);
                    formData.append('phone', this.form.phone);
                    formData.append('paymentMethod', this.form.paymentMethod);
                    
                    if (this.form.paymentMethod === 'manual') {
                        formData.append('bankCode', this.form.bankCode);

                    }
                    
                    if (this.appliedVoucher) {
                        formData.append('voucherCode', this.appliedVoucher.code);
                    }

                    const response = await fetch('/checkout', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: formData
                    });

                    const data = await response.json();
                    
                    if (data.ok) {
                        if (data.paymentUrl) {
                            window.location.href = data.paymentUrl;
                        } else {
                            Object.assign(this.paymentData, data);
                            this.paymentSuccess = true;

                            setTimeout(() => {
                                window.scrollTo({ top: 0, behavior: 'smooth' });
                            }, 100);
                        }
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
                    bankCode: '',
                    agreeTerms: false,
                    voucherCode: ''
                };
            },
            uploadingProof: false,
            async uploadPostProof() {
                let proofFile = this.$refs.postPaymentProof?.files[0];
                if (!proofFile) {
                    alert('Silakan pilih file bukti transfer terlebih dahulu.');
                    return;
                }
                
                if (proofFile.size > 3 * 1024 * 1024) {
                    alert('Ukuran file maksimal 3MB');
                    return;
                }

                this.uploadingProof = true;
                
                try {
                    let formData = new FormData();
                    formData.append('payment_proof', proofFile);

                    const response = await fetch('/order/' + this.paymentData.invoice + '/upload-proof', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: formData
                    });

                    const data = await response.json();
                    
                    if (data.ok) {
                        this.paymentData.proofUploaded = true;
                    } else {
                        alert(data.message || 'Gagal mengunggah bukti');
                    }
                } catch (error) {
                    alert('Terjadi kesalahan jaringan.');
                } finally {
                    this.uploadingProof = false;
                }
            }
        }
    }
</script>
@endsection
