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
            <a href="/guide" class="text-slate-900 hover:text-iosBlue font-semibold text-sm transition-colors">
                <i class="ri-book-line mr-2"></i>Panduan
            </a>
        </nav>

        <!-- Button di kanan -->
        <a :href="whatsappLink" target="_blank" class="flex items-center gap-2 bg-slate-900 hover:bg-iosBlue text-white px-5 py-2.5 rounded-full text-sm font-semibold transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:scale-95 absolute right-4 sm:right-6">
            <i class="ri-whatsapp-line text-lg"></i>
            <span class="hidden sm:inline">Hubungi Admin</span>
        </a>
    </div>
</header>

<main class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 pt-32 space-y-24">
    <!-- The rest of the original Homepage.html body content (Vue app and markup) inlined below -->
    <div id="app" class="pb-10">

            <section class="text-center space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full text-iosPurple text-xs font-bold uppercase tracking-wider shadow-sm border border-slate-100">
                    <i class="ri-verified-badge-fill text-lg"></i> Official Store
                </div>
                
                <h2 class="font-heading text-4xl md:text-6xl font-extrabold text-slate-900 leading-tight">
                    Profesionalisme Bisnis <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-iosBlue to-iosPurple">Dimulai Dari Sini.</span>
                </h2>
                
                <p class="text-slate-500 text-lg max-w-2xl mx-auto leading-relaxed">
                    Pusat download dokumen SOP Perusahaan, KPI, dan Form Bisnis siap pakai (Editable). Hemat waktu, tingkatkan efisiensi operasional.
                </p>

                <div class="relative max-w-2xl mx-auto mt-8 group">
                    <div class="absolute inset-0 bg-purple-400 rounded-full blur-2xl opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative bg-white rounded-full p-2 pl-6 flex items-center shadow-soft border border-white/50 transition-all focus-within:ring-4 focus-within:ring-purple-100">
                        <i class="ri-search-2-line text-2xl text-slate-400 mr-2"></i>
                        
                        <input v-model="searchQuery" type="text" class="w-full py-3 bg-transparent outline-none text-lg text-slate-800 placeholder-slate-400 font-medium" placeholder="Cari SOP (Ketik untuk filter)...">
                        
                        <button class="bg-slate-900 hover:bg-iosPurple text-white px-8 py-3 rounded-full font-bold transition-all shadow-lg active:scale-95">
                            Cari
                        </button>
                    </div>
                    <div v-if="searchQuery" class="mt-2 text-sm text-slate-400">
                        Menampilkan hasil untuk: <span class="font-bold text-slate-900">"@{{ searchQuery }}"</span>
                    </div>
                </div>
            </section>

            <section v-if="filteredPopular.length > 0">
                <div class="flex items-center gap-2 mb-8 justify-center md:justify-start">
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-500 text-xl">
                        <i class="fa-solid fa-fire"></i>
                    </div>
                    <h3 class="font-heading text-2xl font-bold text-slate-900">Paling Laris</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <a v-for="(prod, i) in filteredPopular" :key="prod.name" :href="'/product?id=' + prod.id" class="group bg-white rounded-2xl shadow-soft hover:shadow-xl border border-transparent hover:border-iosBlue transition-all duration-300 hover:-translate-y-2 cursor-pointer block no-underline overflow-hidden">
                        <div class="relative aspect-square rounded-t-2xl overflow-hidden bg-gradient-to-br from-iosBlue/10 to-iosPurple/10">
                            <img :src="prod.image" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" alt="Cover">
                            
                            <!-- Category Badge -->
                            <div class="absolute top-3 left-3 bg-iosBlue/90 backdrop-blur-md text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-md">
                                @{{ prod.category || 'Produk' }}
                            </div>
                            
                            <!-- Discount Badge -->
                            <div v-if="prod.oldPrice" class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-lg shadow-md flex items-center gap-1">
                                @{{ Math.round((1 - prod.price/prod.oldPrice) * 100) }}% OFF
                            </div>
                            
                            <!-- Popular Badge -->
                            <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-md text-iosBlue text-xs font-bold px-2.5 py-1 rounded-lg flex items-center gap-1 shadow-md">
                                <i class="fa-solid fa-star text-yellow-400 text-xs"></i> Popular
                            </div>
                            
                            <!-- Rating -->
                            <div class="absolute bottom-3 right-3 bg-yellow-400 text-white text-xs font-bold px-3 py-1.5 rounded-lg flex items-center gap-1 shadow-md">
                                <i class="fa-solid fa-star"></i> @{{ prod.rating }}
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <h4 class="font-heading font-extrabold text-slate-900 text-lg leading-snug mb-2 line-clamp-2 group-hover:text-iosBlue transition-colors">@{{ prod.name }}</h4>
                            <p class="text-xs text-slate-500 mb-3 line-clamp-2 h-9">@{{ prod.description }}</p>
                            
                            <div class="flex items-end justify-between">
                                <div class="flex flex-col gap-1">
                                    <div v-if="prod.oldPrice" class="text-xs text-gray-400 line-through">Rp @{{ formatPrice(prod.oldPrice) }}</div>
                                    <div class="text-lg font-bold text-iosBlue">Rp @{{ formatPrice(prod.price) }}</div>
                                </div>
                                <div class="w-10 h-10 rounded-full bg-iosBlue text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-arrow-right text-sm"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </section>

            <section v-show="!searchQuery" class="bg-slate-900 rounded-[2.5rem] p-8 md:p-14 text-white relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 w-96 h-96 bg-purple-600 opacity-20 rounded-full blur-[100px] pointer-events-none"></div>
                <div class="relative z-10">
                    <h3 class="font-heading text-2xl font-bold mb-12 text-center">Cara Kerja Sederhana</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                        <div class="hidden md:block absolute top-6 left-1/6 right-1/6 h-0.5 bg-gray-700 -z-10"></div>
                        <div class="text-center relative">
                            <div class="w-16 h-16 mx-auto bg-gray-800 rounded-2xl border border-slate-600 flex items-center justify-center text-iosBlue text-2xl font-bold mb-4 shadow-lg z-10"><i class="fa-solid fa-cart-shopping"></i></div>
                            <h5 class="font-bold text-lg mb-2">1. Pilih & Beli</h5>
                            <p class="text-sm text-gray-400">Pilih template sesuai kebutuhan.</p>
                        </div>
                        <div class="text-center relative">
                            <div class="w-16 h-16 mx-auto bg-gray-800 rounded-2xl border border-slate-600 flex items-center justify-center text-iosBlue text-2xl font-bold mb-4 shadow-lg z-10"><i class="fa-solid fa-bolt"></i></div>
                            <h5 class="font-bold text-lg mb-2">2. Download Instan</h5>
                            <p class="text-sm text-gray-400">Link file otomatis terkirim.</p>
                        </div>
                        <div class="text-center relative">
                            <div class="w-16 h-16 mx-auto bg-gray-800 rounded-2xl border border-slate-600 flex items-center justify-center text-iosBlue text-2xl font-bold mb-4 shadow-lg z-10"><i class="fa-solid fa-pen-to-square"></i></div>
                            <h5 class="font-bold text-lg mb-2">3. Edit & Pakai</h5>
                            <p class="text-sm text-gray-400">File Word/Excel 100% Editable.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section v-if="filteredNew.length > 0">
                <div class="flex items-center gap-2 mb-6">
                    <i class="fa-solid fa-sparkles text-yellow-500 text-xl"></i>
                    <h3 class="font-heading text-2xl font-bold text-slate-900">Produk Terbaru</h3>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                    <a v-for="(prod, i) in filteredNew" :key="prod.name" :href="'/product?id=' + prod.id" class="group bg-white rounded-2xl shadow-soft hover:shadow-lg border border-transparent hover:border-iosBlue transition-all cursor-pointer block no-underline overflow-hidden hover:-translate-y-1">
                        <div class="relative aspect-square rounded-t-2xl overflow-hidden bg-gradient-to-br from-iosBlue/10 to-iosPurple/10">
                            <div class="absolute top-2 left-2 bg-iosBlue text-white text-xs font-bold px-2.5 py-1 rounded-lg z-10 shadow-md">NEW</div>
                            
                            <div v-if="prod.oldPrice" class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-lg shadow-md">
                                @{{ Math.round((1 - prod.price/prod.oldPrice) * 100) }}% OFF
                            </div>
                            
                            <img :src="prod.image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            
                            <div class="absolute bottom-2 right-2 w-8 h-8 rounded-full bg-iosBlue text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-heart text-xs"></i>
                            </div>
                        </div>
                        <div class="p-3">
                            <h4 class="font-heading font-extrabold text-slate-900 text-base md:text-lg leading-snug mb-1 line-clamp-2 h-10">@{{ prod.name }}</h4>
                            <p class="text-xs text-slate-500 mb-3 line-clamp-2 h-9">@{{ prod.description }}</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    <div v-if="prod.oldPrice" class="text-xs text-gray-400 line-through">Rp @{{ formatPrice(prod.oldPrice) }}</div>
                                    <span class="font-bold text-iosBlue text-sm">Rp @{{ formatPrice(prod.price) }}</span>
                                </div>
                                <button @click.prevent="$event.currentTarget.closest('a').click()" class="w-8 h-8 rounded-full bg-iosBlue text-white hover:bg-iosPurple flex items-center justify-center transition-colors">
                                    <i class="fa-solid fa-plus text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
            </section>

            <section v-if="filteredPopular.length === 0 && filteredNew.length === 0" class="text-center py-20">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400 text-3xl">
                    <i class="ri-emotion-unhappy-line"></i>
                </div>
                <h3 class="font-bold text-xl text-slate-900">Produk tidak ditemukan</h3>
                <p class="text-slate-500">Coba gunakan kata kunci lain seperti "SOP", "KPI", atau "Keuangan".</p>
                <button @click="resetSearch" class="mt-4 text-iosBlue font-bold hover:underline">Lihat Semua Produk</button>
            </section>

            <section v-if="testimonials.length > 0" class="space-y-8">
                <div class="text-center">
                    <h3 class="font-heading text-2xl font-bold text-slate-900 mb-2">Testimoni Pelanggan</h3>
                    <p class="text-slate-500">Kepuasan pelanggan adalah prioritas utama kami</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div v-for="(testi, idx) in testimonials" :key="idx" class="bg-white rounded-[1.5rem] p-6 shadow-soft border border-slate-100 hover:shadow-lg hover:border-blue-100 transition-all">
                        <div class="flex items-center gap-3 mb-4">
                            <img :src="testi.image" class="w-12 h-12 rounded-full object-cover" :alt="testi.name">
                            <div>
                                <h4 class="font-bold text-slate-900">@{{ testi.name }}</h4>
                                <div class="flex items-center gap-1 text-yellow-400 text-xs">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed italic">@{{ testi.text }}</p>
                    </div>
                </div>
            </section>

            <section v-if="faqs.length > 0" class="bg-blue-50 rounded-[2.5rem] p-8 md:p-12">
                <div class="max-w-3xl mx-auto">
                    <h3 class="font-heading text-2xl font-bold text-slate-900 mb-2 text-center">Pertanyaan Umum</h3>
                    <p class="text-slate-500 text-center mb-8">Temukan jawaban atas pertanyaan yang sering diajukan</p>
                    <div class="space-y-3">
                        <div v-for="(faq, idx) in faqs" :key="idx" class="bg-white rounded-lg border border-slate-200 overflow-hidden transition-all hover:border-iosBlue">
                            <button @click="toggleFaq(idx)" class="w-full px-6 py-4 flex items-center justify-between hover:bg-blue-50 transition-colors">
                                <span class="font-bold text-left text-slate-900">@{{ faq.q }}</span>
                                <i :class="activeFaq === idx ? 'ri-subtract-line' : 'ri-add-line'" class="text-iosBlue text-lg flex-shrink-0"></i>
                            </button>
                            <div v-if="activeFaq === idx" class="px-6 pb-4 border-t border-slate-100">
                                <p class="text-slate-600 text-sm leading-relaxed whitespace-pre-line">@{{ faq.a }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-white rounded-[2.5rem] p-8 md:p-12 border border-slate-100 shadow-soft">
                <h3 class="font-heading text-2xl font-bold text-center mb-10 text-slate-900">Standard Layanan Kami</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div v-for="(ben, idx) in benefits" :key="idx" class="text-center group">
                        <div class="w-16 h-16 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center text-iosBlue text-3xl mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i :class="ben.icon"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 mb-1">@{{ ben.title }}</h4>
                        <p class="text-xs text-slate-500">@{{ ben.desc }}</p>
                    </div>
                </div>
            </section>

            <section class="bg-slate-900 rounded-[2.5rem] p-8 md:p-12 text-center relative overflow-hidden shadow-2xl transition-all hover:scale-[1.005] duration-500">
                <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
                <div class="relative z-10 flex flex-col items-center max-w-2xl mx-auto">
                    <div class="w-24 h-24 rounded-full border-4 border-slate-700 overflow-hidden mb-6 shadow-glow bg-slate-800">
                        <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjRzyTdfjkBugSP3Ew_vmkaeMQKl0XnZVR83kFV0LtKJXC4gVF_WTGPS57iCampIjdlGU09l_Ct0hw_2Tx51GiHj5uWr6fTYqzJirf8qpAKhwW0AsM-pYcam74_l25KpFvShEYQdkJ-UnuJQsuiP7qa7Ek85k0MWaF0X0pHGmJZ2imL8IQK9ip5M9s2sW0/s16000/Templatenesia%20Logo.jpg" class="w-full h-full object-cover" alt="Profile">
                    </div>
                    <h2 class="font-heading text-2xl md:text-3xl font-bold text-white mb-3 tracking-tight">PT. Templatenesia Digital Solutions</h2>
                    <p class="text-slate-400 mb-10 text-sm leading-relaxed">Mitra terpercaya transformasi sistem manajemen perusahaan Anda. Konsultasi mudah, respon cepat, dan solusi tepat guna.</p>
                    <div class="grid grid-cols-4 md:grid-cols-8 gap-4 w-full justify-items-center">
                        <a v-for="(soc, idx) in socials" :key="idx" :href="soc.link" class="flex flex-col items-center gap-2 group cursor-pointer w-full">
                            <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white text-lg group-hover:bg-iosBlue group-hover:border-iosBlue group-hover:-translate-y-1 transition-all duration-300 backdrop-blur-sm shadow-lg"><i :class="soc.icon"></i></div>
                            <span class="text-[10px] text-slate-500 group-hover:text-white uppercase font-bold tracking-wider transition-colors">@{{ soc.name }}</span>
                        </a>
                    </div>
                </div>
            </section>

        </main>
    </div>

    <script>
        const { createApp, ref, computed } = Vue;

        createApp({
            setup() {
                const searchQuery = ref('');
                const whatsappLink = "https://wa.me/{{ $whatsapp_number ?? '628123456789' }}"; 
                const activeFaq = ref(0); 

                // 1. DATA PRODUK
                const popularProducts = ref(@json($products_js ?? []));

                const newProducts = ref(@json($products_js ?? []));

                // 2. REALTIME SEARCH LOGIC
                const filteredPopular = computed(() => {
                    if (!searchQuery.value) return popularProducts.value;
                    return popularProducts.value.filter(item => 
                        item.name.toLowerCase().includes(searchQuery.value.toLowerCase())
                    );
                });

                const filteredNew = computed(() => {
                    if (!searchQuery.value) return newProducts.value;
                    return newProducts.value.filter(item => 
                        item.name.toLowerCase().includes(searchQuery.value.toLowerCase())
                    );
                });

                // 3. OTHER DATA
                const benefits = [
                    { title: "100% Editable", desc: "File format Ms Word & Excel.", icon: "ri-file-edit-line" },
                    { title: "Instant Download", desc: "Link file otomatis masuk via WA.", icon: "ri-download-cloud-2-line" },
                    { title: "Standar ISO", desc: "Sesuai ISO 9001:2015.", icon: "ri-shield-check-line" },
                    { title: "Support Admin", desc: "Bantuan jika ada kendala.", icon: "ri-customer-service-2-line" },
                ];

                const mediaLogos = [
                    "https://marspedia.id/storage/assets/image/cd2991c61c748e807078cb49130fcd05.png",
                    "https://marspedia.id/storage/assets/image/c29a87c135f4a2cfe7b826b37b3c5baa.png",
                    "https://marspedia.id/storage/assets/image/07d64e34d5ed60dbf6216e04ed28b08c.png",
                    "https://marspedia.id/storage/assets/image/7435c3e65555b20f2b79874433f591d0.png",
                    "https://marspedia.id/storage/assets/image/9422273a72bd32a9c0d403cbb835de6f.png",
                    "https://marspedia.id/storage/assets/image/22236f271016eaa77d643d463fc733f8.png"
                ];

                const defaultTestimonials = [
                    { name: 'Agus Santoso', text: 'Proses pembelian sangat cepat, file langsung terkirim ke WA. Dokumennya rapi banget!' },
                    { name: 'Rizky Febrian', text: 'Sangat membantu untuk perusahaan startup saya yang baru merintis. Template lengkap.' },
                    { name: 'Dinda Ayu', text: 'Admin ramah banget diajarin cara editnya. Recommended seller pokoknya.' },
                ];

                const defaultFaqs = [
                    { q: 'Bagaimana cara melakukan pembelian?', a: "1. Pilih produk yang diinginkan.\n2. Klik tombol beli.\n3. Lakukan pembayaran.\n4. Link download otomatis dikirim ke WhatsApp/Email Anda." },
                    { q: 'Apakah file bisa diedit?', a: 'Ya, 100% bisa diedit. File yang dikirim berformat Microsoft Word (.docx) dan Excel (.xlsx), bukan PDF terkunci.' },
                ];

                const testimonials = ref(@json($testimonials_js) || defaultTestimonials);
                const faqs = ref(@json($faqs_js) || defaultFaqs);

                const socials = [
                    { name: "WA", icon: "ri-whatsapp-fill", link: "#" },
                    { name: "FB", icon: "ri-facebook-fill", link: "#" },
                    { name: "IG", icon: "ri-instagram-fill", link: "#" },
                    { name: "Threads", icon: "ri-threads-fill", link: "#" },
                    { name: "TikTok", icon: "ri-tiktok-fill", link: "#" },
                    { name: "YT", icon: "ri-youtube-fill", link: "#" },
                    { name: "Tele", icon: "ri-telegram-fill", link: "#" },
                    { name: "Email", icon: "ri-mail-fill", link: "#" },
                ];

                const formatPrice = (value) => value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                const getInitials = (name) => name.match(/(\b\S)?/g).join("").match(/(^\S|\S$)?/g).join("").toUpperCase();
                const toggleFaq = (index) => activeFaq.value = (activeFaq.value === index) ? null : index;
                const resetSearch = () => searchQuery.value = '';

                return {
                    searchQuery, whatsappLink, activeFaq,
                    benefits, popularProducts, newProducts, socials,
                    mediaLogos, testimonials, faqs,
                    filteredPopular, filteredNew, // Exported for v-for
                    formatPrice, getInitials, toggleFaq, resetSearch
                }
            }
        }).mount('#app');
    </script>
</main>

<!-- Footer -->
@include('partials.footer')
