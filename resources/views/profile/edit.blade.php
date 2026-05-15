<x-app-layout>
    <style>
        .profile-teal { color: #0d9488; }
        .profile-teal-bg { background-color: #0d9488; }
        .profile-orange { color: #f97316; }
        .profile-orange-bg { background-color: #f97316; }
        html { scroll-behavior: smooth; }
    </style>

    <div class="py-12 bg-teal-50/30 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-10 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-black text-teal-900 mb-2 uppercase tracking-tighter">Hồ sơ <span class="profile-orange">Cá nhân</span></h2>
                    <p class="text-teal-600/70 font-medium">Tùy chỉnh trải nghiệm và bảo mật của bạn tại TRAVELPRO.</p>
                </div>
                <!-- Profile Specific Logo -->
                <div class="w-16 h-16 profile-teal-bg rounded-3xl flex items-center justify-center shadow-xl shadow-teal-200">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <!-- Navigation Sidebar -->
                <div class="space-y-4">
                    <div class="bg-white p-6 rounded-[2.5rem] shadow-xl shadow-teal-900/5 border border-teal-100 sticky top-24">
                        <h4 class="text-xs font-black text-teal-900 uppercase tracking-widest mb-6 border-b border-teal-50 pb-4">Menu cài đặt</h4>
                        <nav class="space-y-2">
                            <a href="#info" class="flex items-center gap-3 px-5 py-4 hover:bg-teal-50 rounded-2xl font-black text-teal-700 transition group">
                                <div class="w-8 h-8 rounded-xl bg-teal-100 flex items-center justify-center group-hover:bg-teal-600 group-hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                Thông tin tài khoản
                            </a>
                            <a href="#password" class="flex items-center gap-3 px-5 py-4 hover:bg-teal-50 rounded-2xl font-black text-teal-700 transition group">
                                <div class="w-8 h-8 rounded-xl bg-teal-100 flex items-center justify-center group-hover:bg-teal-600 group-hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                                Bảo mật & Mật khẩu
                            </a>
                            <a href="#delete" class="flex items-center gap-3 px-5 py-4 hover:bg-red-50 rounded-2xl font-black text-red-500 transition group">
                                <div class="w-8 h-8 rounded-xl bg-red-100 flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </div>
                                Xóa tài khoản
                            </a>
                        </nav>
                    </div>

                    <div class="profile-orange-bg p-8 rounded-[2.5rem] text-white shadow-xl shadow-orange-200 relative overflow-hidden">
                        <div class="absolute top-[-20%] right-[-10%] w-32 h-32 bg-white/20 blur-3xl rounded-full"></div>
                        <h3 class="text-xl font-black mb-4 leading-tight">Ưu đãi dành riêng cho bạn!</h3>
                        <p class="text-orange-50 text-sm mb-6 leading-relaxed opacity-90">Hoàn thiện hồ sơ để nhận ngay mã giảm giá 10% cho tour tiếp theo.</p>
                        <div class="h-1 bg-white/30 rounded-full overflow-hidden">
                            <div class="w-2/3 h-full bg-white"></div>
                        </div>
                        <p class="text-[10px] mt-2 font-bold uppercase tracking-widest opacity-70">Hồ sơ hoàn thiện 65%</p>
                    </div>
                </div>

                <!-- Forms Area -->
                <div class="lg:col-span-2 space-y-10">
                    
                    <div id="info" class="p-8 sm:p-12 bg-white shadow-xl shadow-teal-900/5 border border-teal-100 rounded-[3rem] transition-all hover:shadow-teal-900/10 scroll-mt-24">
                        <div class="max-w-xl">
                            <div class="flex items-center gap-3 mb-8">
                                <div class="w-2 h-6 profile-teal-bg rounded-full"></div>
                                <h3 class="text-xl font-black text-teal-900 uppercase">Thông tin cơ bản</h3>
                            </div>
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div id="password" class="p-8 sm:p-12 bg-white shadow-xl shadow-teal-900/5 border border-teal-100 rounded-[3rem] transition-all hover:shadow-teal-900/10 scroll-mt-24">
                        <div class="max-w-xl">
                            <div class="flex items-center gap-3 mb-8">
                                <div class="w-2 h-6 profile-teal-bg rounded-full"></div>
                                <h3 class="text-xl font-black text-teal-900 uppercase">Đổi mật khẩu</h3>
                            </div>
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div id="delete" class="p-8 sm:p-12 bg-white shadow-xl shadow-red-900/5 border border-red-50 rounded-[3rem] transition-all hover:shadow-red-900/10 scroll-mt-24">
                        <div class="max-w-xl">
                            <div class="flex items-center gap-3 mb-8">
                                <div class="w-2 h-6 bg-red-500 rounded-full"></div>
                                <h3 class="text-xl font-black text-red-900 uppercase">Khu vực nguy hiểm</h3>
                            </div>
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
