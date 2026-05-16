<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Chào mừng trở lại!</h2>
        <p class="text-slate-500 font-medium mt-1">Vui lòng đăng nhập để tiếp tục hành trình của bạn.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <label for="email" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Địa chỉ Email</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                    class="block w-full pl-12 pr-5 py-4 bg-white/50 border-none rounded-2xl text-sm font-bold placeholder-slate-400 focus:ring-2 focus:ring-blue-600/20 transition-all shadow-sm"
                    placeholder="name@example.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <div class="flex items-center justify-between ml-1">
                <label for="password" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Mật khẩu</label>
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-black text-blue-600 uppercase tracking-[0.1em] hover:text-blue-700 transition" href="{{ route('password.request') }}">
                        Quên mật khẩu?
                    </a>
                @endif
            </div>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <input id="password" type="password" name="password" required 
                    class="block w-full pl-12 pr-5 py-4 bg-white/50 border-none rounded-2xl text-sm font-bold placeholder-slate-400 focus:ring-2 focus:ring-blue-600/20 transition-all shadow-sm"
                    placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" class="w-5 h-5 rounded-lg border-none bg-white/50 text-blue-600 focus:ring-2 focus:ring-blue-600/20 transition-all shadow-sm">
                <span class="ms-3 text-sm text-slate-600 font-bold group-hover:text-slate-900 transition-colors">Duy trì đăng nhập</span>
            </label>
        </div>

        <div class="flex flex-col gap-4 pt-2">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl transition-all shadow-xl shadow-blue-200 active:scale-[0.98] flex items-center justify-center gap-3 order-1">
                <span>Đăng nhập ngay</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </button>

            @if (Route::has('password.request'))
                <div class="text-center order-2">
                    <a class="text-[10px] font-black text-slate-400 uppercase tracking-[0.1em] hover:text-blue-600 transition" href="{{ route('password.request') }}">
                        Quên mật khẩu?
                    </a>
                </div>
            @endif
        </div>

        <div class="text-center pt-4">
            <p class="text-sm text-slate-500 font-bold">
                Chưa có tài khoản? 
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 hover:underline underline-offset-4 transition-all">Đăng ký thành viên</a>
            </p>
        </div>
    </form>
</x-guest-layout>
