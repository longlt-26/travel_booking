<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - BookingTravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar { background-color: #0f172a; }
        .card-stat { transition: transform 0.2s; }
        .card-stat:hover { transform: scale(1.02); }
    </style>
</head>
<body class="bg-slate-50 flex min-h-screen">

    <!-- Sidebar (Desktop) -->
    <aside class="sidebar w-64 text-slate-300 hidden lg:flex flex-col border-r border-slate-800">
        <div class="p-6 flex items-center gap-3">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            </div>
            <h1 class="text-xl font-bold text-white tracking-tight">AdminPanel</h1>
        </div>

        <nav class="flex-grow px-4 space-y-2 mt-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-600/10 text-blue-500 rounded-xl font-semibold border-r-4 border-blue-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Tổng quan
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-800 rounded-xl transition text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 7m0 10V7m0 0L9 4"></path></svg>
                Quản lý Tour
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-800 rounded-xl transition text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Người dùng
            </a>
        </nav>

        <div class="p-6 border-t border-slate-800">
             <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 text-red-400 hover:text-red-300 transition w-full">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Đăng xuất
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col">
        <!-- Topbar -->
        <header class="bg-white h-20 border-b border-slate-200 flex items-center justify-between px-8">
            <div class="text-slate-500 font-medium">Dashboard / <span class="text-slate-900 font-bold">Tổng quan</span></div>
            <div class="flex items-center gap-6">
                <a href="{{ route('tours.index') }}" class="text-blue-600 hover:underline font-semibold text-sm">Xem Website</a>
                <div class="flex items-center gap-3 border-l pl-6">
                    <div class="text-right">
                        <p class="text-sm font-bold text-slate-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                    <div class="w-10 h-10 bg-slate-200 rounded-full"></div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="p-8 space-y-8">
            <h2 class="text-2xl font-black text-slate-900">Thống kê hệ thống</h2>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card-stat bg-white p-6 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden">
                    <div class="absolute right-[-10px] top-[-10px] w-20 h-20 bg-blue-50 rounded-full opacity-50"></div>
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-2">Tổng số Tour</p>
                    <p class="text-4xl font-black text-slate-900">{{ $toursCount }}</p>
                    <div class="mt-4 flex items-center text-green-500 text-xs font-bold">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        +12% so với tháng trước
                    </div>
                </div>
                <div class="card-stat bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-2">Lượt Booking</p>
                    <p class="text-4xl font-black text-slate-900">{{ $bookingsCount }}</p>
                    <div class="mt-4 flex items-center text-blue-500 text-xs font-bold">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Đang chờ xử lý
                    </div>
                </div>
                <div class="card-stat bg-blue-600 p-6 rounded-3xl shadow-lg shadow-blue-200 text-white">
                    <p class="text-blue-100 text-sm font-bold uppercase tracking-wider mb-2">Đã thanh toán</p>
                    <p class="text-4xl font-black">{{ $paidBookingsCount }}</p>
                    <div class="mt-4 flex items-center text-blue-100 text-xs font-bold bg-white/10 w-fit px-2 py-1 rounded-lg">
                        Thanh toán thành công
                    </div>
                </div>
            </div>

            <!-- Recent Bookings Table -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="text-lg font-black text-slate-900">Danh sách đặt Tour mới nhất</h3>
                    <button class="text-blue-600 font-bold text-sm hover:underline">Xem tất cả</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-widest">
                            <tr>
                                <th class="px-6 py-4">Mã đơn</th>
                                <th class="px-6 py-4">Khách hàng</th>
                                <th class="px-6 py-4">Tour</th>
                                <th class="px-6 py-4 text-center">Số lượng</th>
                                <th class="px-6 py-4">Tổng tiền</th>
                                <th class="px-6 py-4">Trạng thái</th>
                                <th class="px-6 py-4">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($latestBookings as $b)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 font-bold text-slate-900 text-sm">#{{ $b->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center text-blue-600 font-bold text-[10px]">US</div>
                                        <span class="text-sm font-medium text-slate-700">User #{{ $b->user_id }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600 font-medium">{{ $b->tour->title ?? 'Tour không tồn tại' }}</td>
                                <td class="px-6 py-4 text-center text-sm font-bold text-slate-900">{{ $b->quantity }}</td>
                                <td class="px-6 py-4 font-black text-blue-600 text-sm">{{ number_format($b->total_amount, 0, ',', '.') }} đ</td>
                                <td class="px-6 py-4">
                                    @if($b->status === 'paid' || $b->paid_at)
                                        <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-bold">Thành công</span>
                                    @else
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded-full text-xs font-bold">Chờ xử lý</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <button class="p-2 hover:bg-slate-200 rounded-lg transition">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
