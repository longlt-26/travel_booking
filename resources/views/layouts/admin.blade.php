<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin Panel' }} - BookingTravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar { background-color: #0f172a; }
        .card-stat { transition: transform 0.2s; }
        .card-stat:hover { transform: scale(1.02); }
    </style>
    @stack('styles')
</head>
<body class="bg-slate-50 flex min-h-screen">

    <!-- Sidebar (Desktop) -->
    <aside class="sidebar w-72 text-slate-300 hidden lg:flex flex-col border-r border-slate-800 sticky top-0 h-screen">
        <div class="p-8 flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-900/50">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            </div>
            <h1 class="text-2xl font-black text-white tracking-tighter">Admin<span class="text-blue-500">Panel</span></h1>
        </div>

        <nav class="flex-grow px-6 space-y-3 mt-6">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-6 py-4 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }} rounded-[1.5rem] font-bold transition-all group">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Tổng quan
            </a>
            <a href="{{ route('admin.tours.index') }}" class="flex items-center gap-4 px-6 py-4 {{ request()->routeIs('admin.tours.*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }} rounded-[1.5rem] font-bold transition-all group">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.tours.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 7m0 10V7m0 0L9 4"></path></svg>
                Quản lý Tour
            </a>
            <a href="{{ route('admin.bookings.index') }}" class="flex items-center gap-4 px-6 py-4 {{ request()->routeIs('admin.bookings.*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }} rounded-[1.5rem] font-bold transition-all group">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.bookings.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Quản lý Đơn hàng
            </a>
        </nav>

        <div class="p-8 border-t border-slate-800">
             <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-4 text-slate-500 hover:text-red-400 font-bold transition-all w-full group">
                    <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Đăng xuất
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col h-screen overflow-y-auto">
        <!-- Topbar -->
        <header class="bg-white/80 backdrop-blur-md h-24 border-b border-slate-200 flex items-center justify-between px-10 sticky top-0 z-50">
            <div>
                <h2 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em]">{{ $title ?? 'Dashboard' }}</h2>
                <div class="text-slate-900 font-black text-xl mt-0.5">Chào mừng trở lại, {{ auth()->user()->name }}!</div>
            </div>
            
            <div class="flex items-center gap-6">
                <a href="{{ route('tours.index') }}" target="_blank" class="bg-slate-900 text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-blue-600 transition shadow-lg shadow-slate-200">Xem Website</a>
                
                <div class="flex items-center gap-4 border-l border-slate-100 pl-6">
                    <div class="text-right">
                        <p class="text-sm font-black text-slate-900">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-blue-600 font-black uppercase tracking-[0.2em]">Administrator</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-sm shadow-lg shadow-blue-200">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="p-10">
            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công',
                        text: '{{ session('success') }}',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                </script>
            @endif

            {{ $slot }}
        </div>
    </main>

    @stack('scripts')
</body>
</html>
