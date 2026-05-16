<x-app-layout>
    <div class="py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            
            <div class="mb-12" data-aos="fade-down">
                <h2 class="text-4xl font-black text-slate-900 mb-2 tracking-tight">Hồ sơ <span class="text-blue-600">Cá nhân</span></h2>
                <p class="text-slate-500 font-medium">Quản lý thông tin tài khoản và bảo mật của bạn.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <!-- Navigation Sidebar -->
                <div class="lg:sticky lg:top-24 h-fit space-y-6" data-aos="fade-right">
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8 border-b border-slate-50 pb-4">Menu cài đặt</h4>
                        <nav class="space-y-3">
                            <a href="#info" class="flex items-center gap-4 px-6 py-4 bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-2xl font-black text-sm transition-all group">
                                <div class="w-8 h-8 rounded-xl bg-white shadow-sm flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                Thông tin tài khoản
                            </a>
                            <a href="#password" class="flex items-center gap-4 px-6 py-4 bg-slate-50 hover:bg-blue-50 text-slate-600 hover:text-blue-600 rounded-2xl font-black text-sm transition-all group">
                                <div class="w-8 h-8 rounded-xl bg-white shadow-sm flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                                Bảo mật & Mật khẩu
                            </a>
                            <a href="#delete" class="flex items-center gap-4 px-6 py-4 bg-red-50/50 hover:bg-red-50 text-red-500 rounded-2xl font-black text-sm transition-all group">
                                <div class="w-8 h-8 rounded-xl bg-white shadow-sm flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </div>
                                Xóa tài khoản
                            </a>
                        </nav>
                    </div>

                    <!-- Promo Card -->
                    <div class="bg-blue-600 p-10 rounded-[2.5rem] text-white shadow-2xl shadow-blue-200 relative overflow-hidden">
                        <div class="absolute top-[-20%] right-[-10%] w-32 h-32 bg-white/20 blur-3xl rounded-full"></div>
                        <h3 class="text-xl font-black mb-4 leading-tight">Chào mừng quay trở lại!</h3>
                        <p class="text-blue-100 text-sm mb-6 leading-relaxed opacity-90">Hoàn thiện hồ sơ giúp chúng tôi đề xuất những tour du lịch phù hợp nhất với bạn.</p>
                        <div class="h-1 bg-white/30 rounded-full overflow-hidden">
                            <div class="w-2/3 h-full bg-white"></div>
                        </div>
                    </div>
                </div>

                <!-- Forms Area -->
                <div class="lg:col-span-2 space-y-12" data-aos="fade-left">
                    
                    <div id="info" class="p-10 bg-white shadow-xl shadow-slate-200/50 border border-slate-100 rounded-[3rem] transition-all scroll-mt-24">
                        <div class="flex items-center gap-4 mb-10">
                            <div class="w-1.5 h-8 bg-blue-600 rounded-full"></div>
                            <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight">Thông tin cơ bản</h3>
                        </div>
                        <div class="max-w-2xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div id="password" class="p-10 bg-white shadow-xl shadow-slate-200/50 border border-slate-100 rounded-[3rem] transition-all scroll-mt-24">
                        <div class="flex items-center gap-4 mb-10">
                            <div class="w-1.5 h-8 bg-blue-600 rounded-full"></div>
                            <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight">Đổi mật khẩu</h3>
                        </div>
                        <div class="max-w-2xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div id="delete" class="p-10 bg-white shadow-xl shadow-red-200/20 border border-red-50 rounded-[3rem] transition-all scroll-mt-24">
                        <div class="flex items-center gap-4 mb-10">
                            <div class="w-1.5 h-8 bg-red-500 rounded-full"></div>
                            <h3 class="text-xl font-black text-red-900 uppercase tracking-tight">Khu vực nguy hiểm</h3>
                        </div>
                        <div class="max-w-2xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });
    </script>
    @endpush
</x-app-layout>
