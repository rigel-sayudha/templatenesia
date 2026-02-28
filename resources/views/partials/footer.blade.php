<!-- Footer -->
<footer class="bg-slate-900 text-white px-4 py-12">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <img src="{{ isset($setting['store_logo']) ? \Illuminate\Support\Facades\Storage::url($setting['store_logo']) : 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjRzyTdfjkBugSP3Ew_vmkaeMQKl0XnZVR83kFV0LtKJXC4gVF_WTGPS57iCampIjdlGU09l_Ct0hw_2Tx51GiHj5uWr6fTYqzJirf8qpAKhwW0AsM-pYcam74_l25KpFvShEYQdkJ-UnuJQsuiP7qa7Ek85k0MWaF0X0pHGmJZ2imL8IQK9ip5M9s2sW0/s16000/Templatenesia%20Logo.jpg' }}" 
                         class="w-10 h-10 rounded-lg object-cover" alt="Logo">
                    <span class="font-heading font-bold text-lg">{{ $setting['store_name'] ?? 'Templatenesia' }}</span>
                </div>
                <p class="text-white/60 text-sm leading-relaxed">{{ $setting['store_description'] ?? 'Platform terpercaya untuk membeli produk digital berkualitas tinggi.' }}</p>
            </div>

            <div>
                <h3 class="font-bold mb-4">Kategori Produk</h3>
                <ul class="space-y-2 text-sm text-white/60">
                    @foreach(\App\Models\Category::where('is_active', true)->take(4)->get() as $category)
                        <li><a href="/products?category={{ $category->slug }}" class="hover:text-iosBlue transition-colors">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="font-bold mb-4">Dukungan</h3>
                <ul class="space-y-2 text-sm text-white/60">
                    <li><a href="/guide" class="hover:text-iosBlue transition-colors">Panduan Pengguna</a></li>
                    <li><a href="/guide" class="hover:text-iosBlue transition-colors">Syarat & Ketentuan</a></li>
                    <li><a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting['whatsapp_number'] ?? '6287751299911') }}" target="_blank" class="hover:text-iosBlue transition-colors">Hubungi Kami</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold mb-4">Ikuti Kami</h3>
                <div class="flex gap-4">
                    @php
                        $socialsRaw = $setting['social_media'] ?? null;
                        $socials = is_string($socialsRaw) ? json_decode($socialsRaw, true) : ($socialsRaw ?? [
                            ['platform' => 'facebook', 'url' => '#', 'icon' => 'fa-brands fa-facebook-f'],
                            ['platform' => 'instagram', 'url' => '#', 'icon' => 'fa-brands fa-instagram'],
                            ['platform' => 'twitter', 'url' => '#', 'icon' => 'fa-brands fa-twitter'],
                            ['platform' => 'youtube', 'url' => '#', 'icon' => 'fa-brands fa-youtube'],
                        ]);
                    @endphp
                    @foreach($socials as $social)
                        <a href="{{ $social['url'] ?? '#' }}" target="_blank" class="w-10 h-10 rounded-full bg-white/10 hover:bg-iosBlue flex items-center justify-center transition-colors">
                            <i class="{{ $social['icon'] ?? 'fa-solid fa-link' }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="border-t border-white/10 pt-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-white/60">
                <p>&copy; {{ date('Y') }} {{ $setting['store_name'] ?? 'Templatenesia' }}. All rights reserved</p>
            </div>
        </div>
    </div>
</footer>
