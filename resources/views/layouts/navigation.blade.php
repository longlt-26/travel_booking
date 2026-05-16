<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
        <!-- Left: Logo & Links -->
        <div class="flex items-center gap-12">
            <a href="{{ route('tours.index') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200 group-hover:rotate-12 transition-all">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5a2.5 2.5 0 012.5 2.5v.5m-1.5 6.516A10 10 0 113.337 4.75"></path></svg>
                </div>
                <h1 class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-800 tracking-tighter">BookingTravel</h1>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('tours.index') }}" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition">Trang chủ</a>
                @auth
                    @if(auth()->user()->role !== 'admin')
                        <a href="{{ route('bookings.index') }}" class="text-sm font-bold {{ request()->routeIs('bookings.index') ? 'text-blue-600' : 'text-slate-500' }} hover:text-blue-600 transition">Tour của tôi</a>
                    @endif
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-slate-500' }} hover:text-blue-600 transition">Dashboard</a>
                        <a href="{{ route('admin.tours.index') }}" class="text-sm font-bold {{ request()->routeIs('admin.tours.*') ? 'text-blue-600' : 'text-slate-500' }} hover:text-blue-600 transition">Quản lý Tour</a>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Right: Auth & Profile -->
        <div class="flex items-center gap-6">
            @auth
                <div class="flex items-center gap-4 pr-6 border-r border-slate-100">
                    <div class="text-right hidden sm:block">
                        <div class="text-sm font-black text-slate-900 leading-tight">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] text-blue-600 font-black uppercase tracking-widest">{{ Auth::user()->role }}</div>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </a>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 text-slate-400 hover:text-red-600 font-black text-xs uppercase tracking-widest transition group">
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Đăng xuất
                    </button>
                </form>
            @else
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition px-4 py-2">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-bold shadow-lg shadow-blue-200 transition-all active:scale-95">Đăng ký</a>
                </div>
            @endauth

            <!-- Mobile Hamburger -->
            <button @click="open = ! open" class="md:hidden p-2 text-slate-400 hover:text-blue-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" @click.away="open = false" class="md:hidden bg-white border-t border-slate-50 p-6 space-y-4">
        @auth
            <div class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-50">
                <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-black">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-black text-slate-900">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-slate-400">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}" class="block text-sm font-bold text-slate-600 py-2">Hồ sơ cá nhân</a>
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="block text-sm font-bold text-slate-600 py-2">Dashboard</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="pt-4">
                @csrf
                <button type="submit" class="w-full bg-red-50 text-red-600 py-3 rounded-xl font-black text-sm">Đăng xuất</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block text-center py-3 font-bold text-slate-600">Đăng nhập</a>
            <a href="{{ route('register') }}" class="block text-center py-3 bg-blue-600 text-white rounded-xl font-black">Đăng ký</a>
        @endauth
    </div>
</nav>
