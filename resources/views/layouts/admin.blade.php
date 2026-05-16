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
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-4 px-6 py-4 {{ request()->routeIs('admin.categories.*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }} rounded-[1.5rem] font-bold transition-all group">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.categories.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                Quản lý Danh mục
            </a>
            <a href="{{ route('admin.bookings.index') }}" class="flex items-center gap-4 px-6 py-4 {{ request()->routeIs('admin.bookings.*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }} rounded-[1.5rem] font-bold transition-all group">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.bookings.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Quản lý Đơn hàng
            </a>
            <a href="{{ route('admin.reviews.index') }}" class="flex items-center gap-4 px-6 py-4 {{ request()->routeIs('admin.reviews.*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }} rounded-[1.5rem] font-bold transition-all group">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.reviews.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                Quản lý Bình luận
            </a>
            <a href="{{ route('admin.news.index') }}" class="flex items-center gap-4 px-6 py-4 {{ request()->routeIs('admin.news.*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }} rounded-[1.5rem] font-bold transition-all group">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.news.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                Quản lý Tin tức
            </a>
            <a href="{{ route('admin.vouchers.index') }}" class="flex items-center gap-4 px-6 py-4 {{ request()->routeIs('admin.vouchers.*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }} rounded-[1.5rem] font-bold transition-all group">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.vouchers.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Quản lý Khuyến mãi
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-4 px-6 py-4 {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-900/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }} rounded-[1.5rem] font-bold transition-all group">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-slate-500 group-hover:text-slate-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Quản lý Người dùng
            </a>
        </nav>

    </aside>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col h-screen overflow-y-auto">
        <!-- Topbar -->
        <header class="bg-white/80 backdrop-blur-md h-24 border-b border-slate-100 flex items-center justify-between px-10 sticky top-0 z-50">
            <div class="py-2">
                <h2 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] leading-none mb-2">{{ $title ?? 'Dashboard' }}</h2>
                <div class="text-slate-900 font-black text-xl tracking-tight">Trang quản trị</div>
            </div>
            
            <div class="flex items-center gap-8">
                <!-- User Profile Section (Matching Screenshot) -->
                <div class="flex items-center gap-3 bg-slate-50 px-4 py-2 rounded-full border border-slate-100">
                    <div class="w-9 h-9 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-black text-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="text-slate-700 font-bold text-sm">{{ auth()->user()->name }}</span>
                </div>

                <div class="flex items-center gap-6">
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm transition">
                            Đăng xuất
                        </button>
                    </form>
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
