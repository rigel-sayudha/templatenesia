@extends('layouts.app')

@section('title', 'Panduan - Templatenesia Official')

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
            <a href="/products" class="text-slate-900 hover:text-iosBlue font-semibold text-sm transition-colors">
                <i class="ri-shopping-bag-line mr-2"></i>Produk
            </a>
            <a href="/guide" class="text-iosBlue font-semibold text-sm border-b-2 border-iosBlue pb-1">
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

<div x-data="guideApp()" class="min-h-screen bg-slate-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 pt-40 pb-16 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md text-white px-4 py-2 rounded-full mb-6">
                <i class="ri-question-line"></i>
                <span class="text-sm font-semibold">Panduan Pengguna</span>
            </div>
            <h1 class="font-heading text-5xl font-extrabold text-white mb-4">Panduan Lengkap Pengguna</h1>
            <p class="text-lg text-white/80 mb-8">Temukan jawaban atas pertanyaan yang sering diajukan dan pelajari cara menggunakan platform kami dengan mudah</p>

            <div class="relative max-w-xl mx-auto">
                <i class="ri-search-2-line absolute left-4 top-4 text-slate-400 text-lg"></i>
                <input 
                    x-model="searchQuery"
                    @input="filterFaqs()"
                    type="text" 
                    placeholder="Cari pertanyaan..."
                    class="w-full pl-12 pr-4 py-3 rounded-full bg-white/90 backdrop-blur-md text-slate-900 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-iosBlue"
                >
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="max-w-4xl mx-auto px-4 py-16">
        <h2 class="font-heading text-3xl font-bold text-slate-900 mb-8">Frequently Asked Questions (FAQ)</h2>
        
        <div class="space-y-3">
            <template x-for="(faq, index) in filteredFaqs" :key="index">
                <button 
                    @click="toggleFaq(index)"
                    class="w-full text-left bg-white hover:bg-slate-50 p-4 rounded-lg transition-all border border-slate-200 hover:border-iosBlue group"
                >
                    <div class="flex justify-between items-start gap-4">
                        <span x-text="faq.question" class="font-semibold text-slate-900 group-hover:text-iosBlue transition-colors"></span>
                        <i :class="openFaqIndex === index ? 'ri-subtract-line' : 'ri-add-line'" class="text-iosBlue flex-shrink-0 mt-1"></i>
                    </div>
                </button>
                <div x-show="openFaqIndex === index" x-transition class="bg-blue-50 border border-blue-100 p-4 rounded-lg text-slate-600 text-sm leading-relaxed">
                    <p x-text="faq.answer"></p>
                </div>
            </template>
        </div>

        <!-- No Results -->
        <div x-show="filteredFaqs.length === 0" class="text-center py-12">
            <i class="ri-search-eye-line text-4xl text-slate-300 mb-4"></i>
            <p class="text-slate-500">Tidak ada pertanyaan yang cocok dengan pencarian Anda</p>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-slate-800 px-4 py-16">
        <div class="max-w-2xl mx-auto text-center text-white">
            <h2 class="font-heading text-3xl font-bold mb-3">Masih Ada Pertanyaan?</h2>
            <p class="text-white/80 mb-8">Tim customer service kami siap membantu Anda 24/7. Jangan ragu untuk menghubungi kami kapan saja</p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="https://wa.me/6287751299911" target="_blank" class="flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-lg transition-all shadow-lg hover:shadow-xl">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                    <span>Chat WhatsApp</span>
                </a>
                <a href="mailto:info@templatenesia.com" class="flex items-center justify-center gap-2 bg-slate-700 hover:bg-slate-600 text-white font-bold px-6 py-3 rounded-lg transition-all shadow-lg hover:shadow-xl">
                    <i class="ri-mail-line text-lg"></i>
                    <span>Kirim Email</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('partials.footer')
</div>

<script>
    function guideApp() {
        return {
            searchQuery: '',
            openFaqIndex: null,
            allFaqs: [
                {
                    question: 'Bagaimana cara melakukan pembelian produk digital?',
                    answer: 'Langkah pertama adalah memilih produk yang ingin dibeli di halaman produk. Klik tombol "Beli" atau "Lihat Detail", kemudian ikuti proses checkout. Isi data diri Anda, pilih metode pembayaran, dan konfirmasi pembayaran. Setelah pembayaran berhasil, link download akan dikirim ke email dan WhatsApp Anda.'
                },
                {
                    question: 'Metode pembayaran apa saja yang tersedia?',
                    answer: 'Kami menyediakan dua metode pembayaran utama: (1) Transfer Manual ke rekening bank kami (BRI, BCA, BNI), dan (2) Midtrans yang mendukung kartu kredit, e-wallet (GoPay, OVO, DANA), bank transfer, dan virtual account. Pilih metode yang paling sesuai dengan kebutuhan Anda.'
                },
                {
                    question: 'Berapa lama proses konfirmasi pembayaran?',
                    answer: 'Untuk pembayaran transfer manual, proses konfirmasi biasanya membutuhkan waktu 1-2 jam kerja setelah transfer berhasil. Untuk pembayaran Midtrans, proses akan instan dan link download langsung dapat diakses. Jika terlambat, hubungi admin kami melalui WhatsApp.'
                },
                {
                    question: 'Bagaimana cara download produk setelah pembayaran?',
                    answer: 'Setelah pembayaran dikonfirmasi, link download akan otomatis dikirim ke email dan WhatsApp Anda. Klik link tersebut untuk mulai mendownload. File akan berupa ZIP yang berisi semua dokumen yang sudah dibeli. Anda dapat mendownload berkali-kali tanpa batasan.'
                },
                {
                    question: 'Apakah ada batasan waktu untuk download produk?',
                    answer: 'Tidak ada batasan waktu. Anda dapat mendownload produk kapan saja selamanya. Link download akan tetap aktif dan dapat diakses setiap saat. Simpan link tersebut di tempat yang aman atau download sekarang juga.'
                },
                {
                    question: 'Bagaimana cara download produk?' ,
                    answer: 'File akan disimpan di cloud Anda selamanya. Link download akan dikirim ke email dan WhatsApp. Anda bisa mendownload berkali-kali kapan saja tanpa batasan waktu. File tersedia dalam format ZIP yang mudah di-extract.'
                },
                {
                    question: 'Apakah ada biaya tambahan untuk update produk?',
                    answer: 'Tidak ada biaya tambahan. Jika ada update atau versi terbaru dari template yang Anda beli, Anda dapat mendownload versi terbaru tanpa biaya ekstra. Kami berkomitmen memberikan update gratis kepada semua pelanggan.'
                },
                {
                    question: 'Apakah produk yang dibeli bisa di-refund?',
                    answer: 'Karena sifat produk digital yang dapat langsung diakses setelah pembelian, kebijakan refund kami tidak berlaku. Namun, jika produk tidak sesuai dengan deskripsi atau ada kesalahan, silakan hubungi admin kami untuk solusi terbaik.'
                },
                {
                    question: 'Apakah produk dilengkapi dengan dokumentasi?',
                    answer: 'Ya, semua produk kami dilengkapi dengan dokumentasi lengkap dan panduan penggunaan. Dokumentasi berupa file PDF atau Word yang menjelaskan cara menggunakan template dengan detail. Anda juga dapat menghubungi kami jika ada pertanyaan.'
                },
                {
                    question: 'Bagaimana cara mendapatkan support teknis?',
                    answer: 'Tim customer service kami siap membantu Anda melalui WhatsApp, Email, atau Chat. Hubungi admin kami di tombol "Hubungi Admin" yang tersedia di setiap halaman. Kami biasanya merespon dalam waktu kurang dari 2 jam.'
                },
                {
                    question: 'Apakah ada diskon untuk pembelian dalam jumlah banyak?',
                    answer: 'Kami sering menawarkan promosi khusus dan diskon bundle untuk pembelian produk multiple. Pantau halaman kami atau hubungi admin untuk mendapatkan penawaran khusus dan harga grosir untuk pembelian dalam jumlah besar.'
                },
                {
                    question: 'Bagaimana cara menggunakan voucher diskon?',
                    answer: 'Jika Anda memiliki voucher diskon, masukkan kode voucher di halaman checkout sebelum melakukan pembayaran. Sistem akan otomatis menghitung diskon dan mengurangi total harga. Pastikan voucher masih berlaku dan sesuai dengan syarat & ketentuan yang berlaku.'
                },
                {
                    question: 'Apakah produk dapat digunakan untuk keperluan komersial?',
                    answer: 'Iya, semua produk kami dapat digunakan untuk keperluan komersial maupun personal. Anda dapat menggunakan, mengedit, dan mendistribusikan ulang dengan lisensi yang sesuai. Baca lisensi produk untuk detail lebih lanjut atau hubungi tim kami.'
                }
            ],
            filteredFaqs: [],

            init() {
                this.filteredFaqs = this.allFaqs;
                console.log('Guide app initialized');
            },

            filterFaqs() {
                if (!this.searchQuery.trim()) {
                    this.filteredFaqs = this.allFaqs;
                    return;
                }

                const query = this.searchQuery.toLowerCase();
                this.filteredFaqs = this.allFaqs.filter(faq => 
                    faq.question.toLowerCase().includes(query) ||
                    faq.answer.toLowerCase().includes(query)
                );
                this.openFaqIndex = null;
            },

            toggleFaq(index) {
                this.openFaqIndex = this.openFaqIndex === index ? null : index;
            }
        }
    }
</script>
@endsection
