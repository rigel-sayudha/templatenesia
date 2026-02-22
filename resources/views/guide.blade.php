@extends('layouts.app')

@section('title', 'Panduan - Templatenesia Official')

@section('head')
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
            <a href="/guide" class="text-iosBlue font-semibold text-sm border-b-2 border-iosBlue pb-1">
                <i class="ri-book-line mr-2"></i>Panduan
            </a>
        </nav>

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
                <div class="faq-item mb-3">
                    <button 
                        @click="toggleFaq(index)"
                        class="w-full text-left bg-white hover:bg-slate-50 p-4 rounded-lg transition-all border border-slate-200 hover:border-iosBlue group"
                    >
                        <div class="flex justify-between items-start gap-4">
                            <span x-text="faq.question" class="font-semibold text-slate-900 group-hover:text-iosBlue transition-colors"></span>
                            <i :class="openFaqIndex === index ? 'ri-subtract-line' : 'ri-add-line'" class="text-iosBlue flex-shrink-0 mt-1"></i>
                        </div>
                    </button>
                    <div x-show="openFaqIndex === index" x-transition class="bg-blue-50 border border-blue-100 p-4 rounded-lg mt-2 text-slate-600 text-sm leading-relaxed">
                        <p x-text="faq.answer"></p>
                    </div>
                </div>
            </template>
        </div>

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
            allFaqs: {!! json_encode($qnas_js) !!},
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

@include('partials.footer')
@endsection
