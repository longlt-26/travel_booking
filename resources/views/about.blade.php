<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về chúng tôi - BookingTravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-gradient { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); }
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
                <a href="{{ route('news') }}" class="text-slate-600 hover:text-blue-600 font-bold transition">Tin tức</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-gradient py-32 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=2074')] opacity-20 bg-cover bg-center"></div>
        <div class="container mx-auto px-6 max-w-4xl text-center relative z-10">
            <span class="text-blue-400 font-black uppercase tracking-[0.3em] text-xs mb-4 block">Hành trình của chúng tôi</span>
            <h1 class="text-5xl md:text-7xl font-black mb-8 leading-tight">Kiến tạo những kỷ niệm <span class="text-blue-500">vô giá</span></h1>
            <p class="text-xl text-slate-400 leading-relaxed">Chúng tôi không chỉ bán tour du lịch, chúng tôi mang đến những trải nghiệm thay đổi cuộc sống và kết nối con người với những vẻ đẹp kỳ vĩ của thiên nhiên.</p>
        </div>
    </header>

    <!-- Content -->
    <main class="py-24 container mx-auto px-6 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center mb-32">
            <div>
                <h2 class="text-4xl font-black mb-8 text-slate-900">Sứ mệnh của <span class="text-blue-600">BookingTravel</span></h2>
                <div class="space-y-6 text-slate-600 text-lg leading-relaxed">
                    <p>Được thành lập với niềm đam mê khám phá bất tận, BookingTravel đã trải qua hơn 10 năm hành trình kết nối du khách với những điểm đến tuyệt vời nhất tại Việt Nam và Thế giới.</p>
                    <p>Chúng tôi tin rằng mỗi chuyến đi là một chương mới trong cuốn sách cuộc đời của bạn. Vì vậy, đội ngũ của chúng tôi luôn tỉ mỉ trong từng khâu chuẩn bị, từ việc chọn lọc khách sạn đẳng cấp đến việc thiết kế những lịch trình độc bản.</p>
                </div>
                <div class="grid grid-cols-2 gap-8 mt-12">
                    <div>
                        <p class="text-4xl font-black text-blue-600">10k+</p>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Khách hàng tin tưởng</p>
                    </div>
                    <div>
                        <p class="text-4xl font-black text-blue-600">150+</p>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Điểm đến độc đáo</p>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-4 bg-blue-600/10 rounded-[3rem] blur-2xl"></div>
                <img src="https://images.unsplash.com/photo-1539635278303-d4002c07eae3?q=80&w=2070" class="relative rounded-[3rem] shadow-2xl" alt="About Us">
            </div>
        </div>

        <div class="bg-slate-900 rounded-[4rem] p-16 md:p-24 text-white text-center">
            <h2 class="text-3xl md:text-5xl font-black mb-8 leading-tight">Sẵn sàng để bắt đầu hành trình của bạn?</h2>
            <p class="text-slate-400 mb-12 text-lg max-w-2xl mx-auto">Hãy để chúng tôi đồng hành cùng bạn trong chuyến phiêu lưu sắp tới. Mọi chi tiết đều đã được chuẩn bị sẵn sàng.</p>
            <a href="{{ route('tours.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-12 py-5 rounded-2xl font-black text-lg shadow-xl shadow-blue-900/50 transition-all inline-block active:scale-95">Khám phá Tour ngay</a>
        </div>
    </main>

    <footer class="bg-white py-12 border-t border-slate-100">
        <div class="container mx-auto px-6 text-center">
            <p class="text-slate-400 text-sm">© 2026 BookingTravel. Tất cả quyền được bảo lưu.</p>
        </div>
    </footer>
</body>
</html>
