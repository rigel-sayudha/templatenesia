<div x-data="authApp()" 
     x-show="isOpen" 
     x-cloak
     @open-auth-modal.window="openModal($event.detail)"
     class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6" 
     aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div x-show="isOpen" 
         x-transition:enter="ease-out duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         x-transition:leave="ease-in duration-200" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0" 
         @click="closeModal"
         class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity"></div>

    <!-- Modal Panel -->
    <div x-show="isOpen" 
         x-transition:enter="ease-out duration-300" 
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
         x-transition:leave="ease-in duration-200" 
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
         class="relative transform overflow-hidden rounded-[2rem] bg-white text-left shadow-2xl transition-all w-full max-w-md">
        
        <div class="relative bg-gradient-to-br from-iosBlue/10 to-iosPurple/10 p-6 sm:p-8">
            <button @click="closeModal" class="absolute top-4 right-4 text-slate-400 hover:text-red-500 bg-white/80 backdrop-blur-md hover:bg-white w-8 h-8 rounded-full flex items-center justify-center transition-all shadow-sm z-10">
                <i class="ri-close-line text-xl"></i>
            </button>

            <!-- Loading Overlay -->
            <div x-show="isLoading" class="absolute inset-0 bg-white/60 backdrop-blur-sm flex items-center justify-center z-20 rounded-[2rem]">
                <div class="w-10 h-10 border-4 border-iosBlue border-t-transparent rounded-full animate-spin"></div>
            </div>
            <div class="flex items-center justify-center mb-8">
                <div class="bg-white/50 backdrop-blur-md p-1 rounded-full flex gap-1 border border-white/60 shadow-inner">
                    <button @click="setTab('login')" 
                            :class="tab === 'login' ? 'bg-white shadow-sm text-iosBlue' : 'text-slate-500 hover:text-slate-700'"
                            class="px-6 py-2 rounded-full text-sm font-bold transition-all duration-300">
                        Masuk
                    </button>
                    <button @click="setTab('register')" 
                            :class="tab === 'register' ? 'bg-white shadow-sm text-iosPurple' : 'text-slate-500 hover:text-slate-700'"
                            class="px-6 py-2 rounded-full text-sm font-bold transition-all duration-300">
                        Daftar Baru
                    </button>
                </div>
            </div>
            <div class="text-center mb-6">
                <div class="w-16 h-16 mx-auto bg-white rounded-2xl flex items-center justify-center shadow-md mb-4 rotate-3 hover:rotate-0 transition-transform cursor-pointer">
                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjRzyTdfjkBugSP3Ew_vmkaeMQKl0XnZVR83kFV0LtKJXC4gVF_WTGPS57iCampIjdlGU09l_Ct0hw_2Tx51GiHj5uWr6fTYqzJirf8qpAKhwW0AsM-pYcam74_l25KpFvShEYQdkJ-UnuJQsuiP7qa7Ek85k0MWaF0X0pHGmJZ2imL8IQK9ip5M9s2sW0/s16000/Templatenesia%20Logo.jpg" class="w-12 h-12 rounded-xl object-cover" alt="Logo">
                </div>
                <h3 class="font-heading text-2xl font-extrabold text-slate-900" x-text="tab === 'login' ? 'Selamat Datang Kembali!' : 'Bergabung Bersama Kami'"></h3>
            </div>
            <template x-if="message">
                <div :class="messageType === 'error' ? 'bg-red-50 text-red-600 border-red-200' : 'bg-green-50 text-green-600 border-green-200'" class="mb-4 p-3 rounded-xl border text-sm font-medium flex items-start gap-2 animate-[pageEnter_0.3s_ease-out]">
                    <i :class="messageType === 'error' ? 'ri-error-warning-fill mt-0.5' : 'ri-checkbox-circle-fill mt-0.5'"></i>
                    <p x-text="message"></p>
                </div>
            </template>

            <!-- Form LOGIN -->
            <form x-show="tab === 'login'" @submit.prevent="submitLogin" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Email <span class="text-red-500">*</span></label>
                    <div class="relative group">
                        <i class="ri-mail-line absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-iosBlue transition-colors"></i>
                        <input type="email" x-model="loginForm.email" required class="w-full bg-white border border-slate-200 text-slate-900 rounded-xl px-4 py-3 pl-11 focus:outline-none focus:ring-2 focus:ring-iosBlue focus:border-transparent transition-all" placeholder="nama@email.com">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Kata Sandi <span class="text-red-500">*</span></label>
                    <div class="relative group">
                        <i class="ri-lock-password-line absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-iosBlue transition-colors"></i>
                        <input :type="showPassword ? 'text' : 'password'" x-model="loginForm.password" required class="w-full bg-white border border-slate-200 text-slate-900 rounded-xl px-4 py-3 pl-11 pr-11 focus:outline-none focus:ring-2 focus:ring-iosBlue focus:border-transparent transition-all" placeholder="••••••••">
                        <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                            <i :class="showPassword ? 'ri-eye-off-line' : 'ri-eye-line'"></i>
                        </button>
                    </div>
                </div>
                <!-- <div class="flex items-center justify-between mt-2">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" x-model="loginForm.remember" class="w-4 h-4 rounded border-gray-300 text-iosBlue focus:ring-iosBlue">
                        <span class="ml-2 text-sm text-slate-600">Ingat Saya</span>
                    </label>
                    <a href="#" class="text-sm font-medium text-iosBlue hover:text-blue-700">Lupa Sandi?</a>
                </div> -->
                
                <button type="submit" :disabled="isLoading" class="w-full bg-slate-900 hover:bg-iosBlue text-white font-bold py-3.5 px-6 rounded-xl transition-all shadow-md active:scale-95 mt-6 disabled:opacity-70 flex items-center justify-center gap-2 group">
                    <span>Masuk Sekarang</span>
                    <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
                </button>

                <div class="relative mt-6 mb-4">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-3 bg-white text-slate-400 font-medium">Atau masuk dengan</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="/auth/google/redirect" class="w-full flex items-center justify-center gap-3 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold py-3 px-6 rounded-xl transition-all shadow-sm active:scale-95">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
                        <span>Lanjutkan dengan Google</span>
                    </a>
                    <a href="/auth/facebook/redirect" class="w-full flex items-center justify-center gap-3 bg-[#1877F2] hover:bg-[#166FE5] text-white font-semibold py-3 px-6 rounded-xl transition-all shadow-sm active:scale-95">
                        <i class="ri-facebook-circle-fill text-xl"></i>
                        <span>Lanjutkan dengan Facebook</span>
                    </a>
                </div>
            </form>

            <!-- Form REGISTER -->
            <form x-show="tab === 'register'" @submit.prevent="submitRegister" class="space-y-4" style="display: none;">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <div class="relative group">
                        <i class="ri-user-smile-line absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-iosPurple transition-colors"></i>
                        <input type="text" x-model="registerForm.name" required class="w-full bg-white border border-slate-200 text-slate-900 rounded-xl px-4 py-3 pl-11 focus:outline-none focus:ring-2 focus:ring-iosPurple focus:border-transparent transition-all" placeholder="Budi Santoso">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Email <span class="text-red-500">*</span></label>
                    <div class="relative group">
                        <i class="ri-mail-line absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-iosPurple transition-colors"></i>
                        <input type="email" x-model="registerForm.email" required class="w-full bg-white border border-slate-200 text-slate-900 rounded-xl px-4 py-3 pl-11 focus:outline-none focus:ring-2 focus:ring-iosPurple focus:border-transparent transition-all" placeholder="budi@email.com">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Kata Sandi Baru <span class="text-red-500">*</span></label>
                    <div class="relative group">
                        <i class="ri-lock-password-line absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-iosPurple transition-colors"></i>
                        <input :type="showPassword ? 'text' : 'password'" x-model="registerForm.password" required minlength="6" class="w-full bg-white border border-slate-200 text-slate-900 rounded-xl px-4 py-3 pl-11 pr-11 focus:outline-none focus:ring-2 focus:ring-iosPurple focus:border-transparent transition-all" placeholder="Min. 6 Karakter">
                        <button type="button" @click="showPassword = !showPassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                            <i :class="showPassword ? 'ri-eye-off-line' : 'ri-eye-line'"></i>
                        </button>
                    </div>
                </div>
                
                <button type="submit" :disabled="isLoading" class="w-full bg-gradient-to-r from-iosPurple to-purple-600 hover:to-purple-700 text-white font-bold py-3.5 px-6 rounded-xl transition-all shadow-md active:scale-95 mt-6 disabled:opacity-70 flex items-center justify-center gap-2 group">
                    <span>Buat Akun</span>
                    <i class="ri-user-add-line group-hover:scale-110 transition-transform"></i>
                </button>

                <div class="relative mt-6 mb-4">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-3 bg-white text-slate-400 font-medium">Atau daftar dengan</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="/auth/google/redirect" class="w-full flex items-center justify-center gap-3 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold py-3 px-6 rounded-xl transition-all shadow-sm active:scale-95">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
                        <span>Lanjutkan dengan Google</span>
                    </a>
                    <a href="/auth/facebook/redirect" class="w-full flex items-center justify-center gap-3 bg-[#1877F2] hover:bg-[#166FE5] text-white font-semibold py-3 px-6 rounded-xl transition-all shadow-sm active:scale-95">
                        <i class="ri-facebook-circle-fill text-xl"></i>
                        <span>Lanjutkan dengan Facebook</span>
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('authApp', () => ({
        isOpen: false,
        tab: 'login',
        isLoading: false,
        showPassword: false,
        message: null,
        messageType: 'error',
        
        loginForm: { email: '', password: '', remember: false },
        registerForm: { name: '', email: '', password: '' },

        openModal(detail) {
            this.isOpen = true;
            this.tab = detail?.tab || 'login';
            this.resetState();
            document.body.style.overflow = 'hidden';
        },
        
        closeModal() {
            this.isOpen = false;
            document.body.style.overflow = 'auto';
            setTimeout(() => this.resetState(), 300);
        },

        setTab(newTab) {
            this.tab = newTab;
            this.resetState();
        },

        resetState() {
            this.message = null;
            this.showPassword = false;
            this.loginForm = { email: '', password: '', remember: false };
            this.registerForm = { name: '', email: '', password: '' };
        },

        async submitLogin() {
            if(!this.loginForm.email || !this.loginForm.password) return;
            this.isLoading = true;
            this.message = null;
            
            try {
                const res = await fetch('/ajax/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(this.loginForm)
                });
                
                const data = await res.json();
                
                if (res.ok && data.ok) {
                    this.messageType = 'success';
                    this.message = data.message;
                    setTimeout(() => {
                        window.location.reload(); 
                    }, 500);
                } else {
                    this.messageType = 'error';
                    this.message = data.message || 'Login Gagal';
                }
            } catch (err) {
                this.messageType = 'error';
                this.message = 'Terjadi kesalahan koneksi jaringan.';
            } finally {
                this.isLoading = false;
            }
        },

        async submitRegister() {
            if(!this.registerForm.name || !this.registerForm.email || !this.registerForm.password) return;
            this.isLoading = true;
            this.message = null;
            
            try {
                const res = await fetch('/ajax/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(this.registerForm)
                });
                
                const data = await res.json();
                
                if (res.ok && data.ok) {
                    this.messageType = 'success';
                    this.message = data.message;
                    setTimeout(() => {
                        window.location.reload(); 
                    }, 800);
                } else {
                    this.messageType = 'error';
                    if (data.errors) {
                        const firstKey = Object.keys(data.errors)[0];
                        this.message = data.errors[firstKey][0];
                    } else {
                        this.message = data.message || 'Pendaftaran Gagal';
                    }
                }
            } catch (err) {
                this.messageType = 'error';
                this.message = 'Terjadi kesalahan koneksi jaringan.';
            } finally {
                this.isLoading = false;
            }
        }
    }));
});
</script>
