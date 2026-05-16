<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin tức du lịch - BookingTravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100">
        <div class="container mx-auto px-6 h-20 flex justify-between items-center max-w-7xl">
            <a href="{{ route('tours.index') }}" class="flex items-center gap-2">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5a2.5 2.5 0 012.5 2.5v.5m-1.5 6.516A10 10 0 113.337 4.75"></path></svg>
                </div>
                <h1 class="text-2xl font-black text-slate-900">BookingTravel</h1>
            </a>
            <div class="flex items-center gap-8">
                <a href="{{ route('tours.index') }}" class="text-slate-600 hover:text-blue-600 font-bold transition">Trang chủ</a>
                <a href="{{ route('about') }}" class="text-slate-600 hover:text-blue-600 font-bold transition">Về chúng tôi</a>
            </div>
        </div>
    </nav>

    <header class="py-24 bg-white border-b border-slate-100">
        <div class="container mx-auto px-6 max-w-7xl text-center">
            <span class="text-blue-600 font-black uppercase tracking-[0.3em] text-xs mb-4 block">Blog & Tin tức</span>
            <h1 class="text-5xl font-black text-slate-900 mb-6">Khám phá thế giới qua <br> <span class="text-blue-600">tầm mắt mới</span></h1>
            <p class="text-slate-500 max-w-2xl mx-auto text-lg">Cập nhật những xu hướng du lịch mới nhất, các mẹo hữu ích và những câu chuyện hành trình đầy cảm hứng.</p>
        </div>
    </header>

    <main class="py-24 container mx-auto px-6 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @forelse(\App\Models\News::latest()->get() as $item)
                <!-- News Item -->
                <article class="group bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <div class="h-64 overflow-hidden relative">
                        <img src="{{ $item->image ?? 'https://images.unsplash.com/photo-1506461883276-594a12b11cf3?q=80&w=2070' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $item->title }}">
                        <div class="absolute top-6 left-6 bg-white/90 backdrop-blur px-4 py-2 rounded-2xl text-[10px] font-black text-blue-600 shadow-sm">{{ $item->category ?? 'Tin tức' }}</div>
                    </div>
                    <div class="p-10">
                        <p class="text-slate-400 text-xs font-bold mb-4 uppercase tracking-widest">{{ $item->created_at->format('d \T\h\á\n\g m, Y') }}</p>
                        <h3 class="text-2xl font-black text-slate-900 mb-4 group-hover:text-blue-600 transition leading-tight line-clamp-2">{{ $item->title }}</h3>
                        <p class="text-slate-500 text-sm leading-relaxed line-clamp-3 mb-8">{{ $item->summary }}</p>
                        <a href="#" class="text-slate-900 font-black text-sm flex items-center gap-2 hover:gap-4 transition-all">
                            Đọc thêm
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </article>
            @empty
                <div class="md:col-span-3 text-center py-24 bg-white rounded-[3rem] border-2 border-dashed border-slate-100">
                    <p class="text-slate-400 font-bold text-lg">Chưa có tin tức nào được đăng tải.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-20 text-center">
            <button class="bg-white border-2 border-slate-200 text-slate-900 px-10 py-4 rounded-2xl font-black hover:border-blue-600 hover:text-blue-600 transition-all active:scale-95">Xem thêm bài viết</button>
        </div>
    </main>

    <footer class="bg-white py-12 border-t border-slate-100">
        <div class="container mx-auto px-6 text-center">
            <p class="text-slate-400 text-sm">© 2026 BookingTravel. Tất cả quyền được bảo lưu.</p>
        </div>
    </footer>
    @include('components.chatbot')
</body>
</html>
