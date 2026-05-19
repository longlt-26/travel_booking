<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Booking Travel - Khám phá thế giới</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Swiper.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .search-bar-float {
            transform: translateY(-50%);
            z-index: 40;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }
        .tour-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .tour-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="bg-slate-50">

    <!-- Navigation -->
    <nav class="glass-nav sticky top-0 z-50 border-b border-white/20">
        <div class="container mx-auto px-6 h-20 flex justify-between items-center max-w-7xl">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5a2.5 2.5 0 012.5 2.5v.5m-1.5 6.516A10 10 0 113.337 4.75"></path></svg>
                </div>
                <h1 class="text-2xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-800">BookingTravel</h1>
            </div>
            
                   <!-- Links điều hướng -->
            <div class="hidden md:flex items-center gap-8">
   </div>

            <div class="flex items-center gap-6">
                @if (Route::has('login'))
                    @auth
                        <div class="flex items-center gap-4">
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ url('/dashboard') }}" class="text-slate-700 font-semibold hover:text-blue-600 transition text-sm">Trang quản trị</a>
                            @else
                                <div class="flex items-center gap-3 bg-slate-100 px-4 py-2 rounded-full">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-xs uppercase">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                    <span class="text-slate-700 font-medium text-sm">{{ auth()->user()->name }}</span>
                                </div>
                                <a href="{{ route('bookings.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-bold transition">Tour của tôi</a>
                                <a href="{{ route('profile.edit') }}" class="text-slate-500 hover:text-blue-600 text-sm font-medium transition">Hồ sơ</a>
                            @endif
                            
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-600 hover:text-white px-4 py-2 rounded-xl text-sm font-semibold transition-all">
                                    Đăng xuất
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <a href="{{ route('login') }}" class="text-slate-700 hover:text-blue-600 font-semibold transition px-4 py-2">Đăng nhập</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-bold shadow-lg shadow-blue-200 transition-all active:scale-95">Đăng ký</a>
                        </div>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section with Animated Banner -->
    <section class="relative h-[600px] overflow-hidden">
        <!-- Slides -->
        <div id="hero-slider" class="absolute inset-0 z-0">
            <!-- Slide 1: Hạ Long -->
            <div class="slide absolute inset-0 transition-opacity duration-1000 opacity-100">
                <div class="absolute inset-0 bg-slate-900/40 z-10"></div>
                <img src="https://images.unsplash.com/photo-1528127269322-539801943592?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover" alt="Hạ Long">
                <div class="absolute inset-0 z-20 flex items-center">
                    <div class="container mx-auto px-6 max-w-7xl">
                        <div class="max-w-2xl text-white">
                            <span class="inline-block px-4 py-1 bg-blue-600 rounded-full text-xs font-bold uppercase tracking-wider mb-4">Vịnh Hạ Long</span>
                            <h2 class="text-5xl md:text-6xl font-black mb-6 leading-tight">Kỳ quan thiên nhiên thế giới</h2>
                            <p class="text-lg mb-8 opacity-90">Khám phá vẻ đẹp hùng vĩ của hàng ngàn hòn đảo đá vôi kỳ thú.</p>
                            <a href="#tours" class="bg-white text-blue-600 px-8 py-3.5 rounded-xl font-bold shadow-xl hover:bg-blue-50 transition-all inline-flex items-center gap-2">Xem Tour ngay</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Phú Quốc -->
            <div class="slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                <div class="absolute inset-0 bg-slate-900/40 z-10"></div>
                <img src="https://images.unsplash.com/photo-1589785834230-899bb97f9bb7?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover" alt="Phú Quốc">
                <div class="absolute inset-0 z-20 flex items-center">
                    <div class="container mx-auto px-6 max-w-7xl">
                        <div class="max-w-2xl text-white">
                            <span class="inline-block px-4 py-1 bg-orange-500 rounded-full text-xs font-bold uppercase tracking-wider mb-4">Phú Quốc</span>
                            <h2 class="text-5xl md:text-6xl font-black mb-6 leading-tight">Thiên đường đảo ngọc</h2>
                            <p class="text-lg mb-8 opacity-90">Tận hưởng làn nước xanh trong và bãi cát trắng mịn màng.</p>
                            <a href="#tours" class="bg-white text-orange-600 px-8 py-3.5 rounded-xl font-bold shadow-xl hover:bg-orange-50 transition-all inline-flex items-center gap-2">Khám phá ngay</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Đà Lạt -->
            <div class="slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                <div class="absolute inset-0 bg-slate-900/40 z-10"></div>
                <img src="https://images.unsplash.com/photo-1581433020663-f542472719a9?q=80&w=2014&auto=format&fit=crop" class="w-full h-full object-cover" alt="Đà Lạt">
                <div class="absolute inset-0 z-20 flex items-center">
                    <div class="container mx-auto px-6 max-w-7xl">
                        <div class="max-w-2xl text-white">
                            <span class="inline-block px-4 py-1 bg-purple-500 rounded-full text-xs font-bold uppercase tracking-wider mb-4">Đà Lạt</span>
                            <h2 class="text-5xl md:text-6xl font-black mb-6 leading-tight">Thành phố ngàn hoa</h2>
                            <p class="text-lg mb-8 opacity-90">Đắm chìm trong không khí se lạnh và vẻ đẹp mộng mơ của cao nguyên.</p>
                            <a href="#tours" class="bg-white text-purple-600 px-8 py-3.5 rounded-xl font-bold shadow-xl hover:bg-purple-50 transition-all inline-flex items-center gap-2">Tìm hiểu thêm</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 4: Sa Pa -->
            <div class="slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                <div class="absolute inset-0 bg-slate-900/40 z-10"></div>
                <img src="https://images.unsplash.com/photo-1504457047772-27fad1c000e6?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover" alt="Sa Pa">
                <div class="absolute inset-0 z-20 flex items-center">
                    <div class="container mx-auto px-6 max-w-7xl">
                        <div class="max-w-2xl text-white">
                            <span class="inline-block px-4 py-1 bg-green-600 rounded-full text-xs font-bold uppercase tracking-wider mb-4">Sa Pa</span>
                            <h2 class="text-5xl md:text-6xl font-black mb-6 leading-tight">Nơi gặp gỡ đất trời</h2>
                            <p class="text-lg mb-8 opacity-90">Chinh phục đỉnh Fansipan và khám phá ruộng bậc thang kỳ vĩ.</p>
                            <a href="#tours" class="bg-white text-green-600 px-8 py-3.5 rounded-xl font-bold shadow-xl hover:bg-green-50 transition-all inline-flex items-center gap-2">Trải nghiệm ngay</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 5: Hội An -->
            <div class="slide absolute inset-0 transition-opacity duration-1000 opacity-0">
                <div class="absolute inset-0 bg-slate-900/40 z-10"></div>
                <img src="https://images.unsplash.com/photo-1599708138401-447551065715?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover" alt="Hội An">
                <div class="absolute inset-0 z-20 flex items-center">
                    <div class="container mx-auto px-6 max-w-7xl">
                        <div class="max-w-2xl text-white">
                            <span class="inline-block px-4 py-1 bg-yellow-500 rounded-full text-xs font-bold uppercase tracking-wider mb-4">Hội An</span>
                            <h2 class="text-5xl md:text-6xl font-black mb-6 leading-tight">Nét đẹp cổ kính</h2>
                            <p class="text-lg mb-8 opacity-90">Dạo bước dưới ánh đèn lồng rực rỡ và không gian hoài cổ.</p>
                            <a href="#tours" class="bg-white text-yellow-600 px-8 py-3.5 rounded-xl font-bold shadow-xl hover:bg-yellow-50 transition-all inline-flex items-center gap-2">Khám phá phố cổ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-30 flex gap-3">
            <button onclick="setSlide(0)" class="dot w-12 h-1.5 bg-white rounded-full opacity-100 transition-all"></button>
            <button onclick="setSlide(1)" class="dot w-3 h-1.5 bg-white/50 rounded-full opacity-100 transition-all"></button>
            <button onclick="setSlide(2)" class="dot w-3 h-1.5 bg-white/50 rounded-full opacity-100 transition-all"></button>
            <button onclick="setSlide(3)" class="dot w-3 h-1.5 bg-white/50 rounded-full opacity-100 transition-all"></button>
            <button onclick="setSlide(4)" class="dot w-3 h-1.5 bg-white/50 rounded-full opacity-100 transition-all"></button>
        </div>
    </section>

    <!-- Floating Search Bar (Đã kích hoạt) -->
    <div class="container mx-auto px-6 max-w-5xl relative search-bar-float hidden md:block" data-aos="fade-up" data-aos-delay="200">
        <form action="{{ route('tours.index') }}" method="GET" class="bg-white p-6 rounded-[2.5rem] shadow-2xl shadow-blue-900/10 border border-blue-50 flex items-center gap-4">
            <div class="flex-grow flex items-center gap-3 px-4 py-3 bg-slate-50 rounded-2xl border border-slate-100 focus-within:border-blue-400 transition">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Bạn muốn đi đâu?" class="bg-transparent border-none focus:outline-none w-full text-sm font-bold text-slate-900 placeholder:text-slate-400">
            </div>
            <div class="w-px h-10 bg-slate-200"></div>
            <div class="flex-grow flex items-center gap-3 px-4 py-3 bg-slate-50 rounded-2xl border border-slate-100 focus-within:border-blue-400 transition">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <select name="category" class="bg-transparent border-none focus:outline-none w-full text-sm font-bold text-slate-900 appearance-none cursor-pointer">
                    <option value="all">Tất cả khu vực</option>
                    <option value="north" {{ request('category') == 'north' ? 'selected' : '' }}>Miền Bắc</option>
                    <option value="central" {{ request('category') == 'central' ? 'selected' : '' }}>Miền Trung</option>
                    <option value="south" {{ request('category') == 'south' ? 'selected' : '' }}>Miền Nam</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-black shadow-lg shadow-blue-200 transition-all active:scale-95 whitespace-nowrap">
                Tìm kiếm ngay
            </button>
        </form>
    </div>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        function setSlide(index) {
            slides[currentSlide].classList.replace('opacity-100', 'opacity-0');
            dots[currentSlide].classList.replace('w-12', 'w-3');
            dots[currentSlide].classList.replace('bg-white', 'bg-white/50');
            
            currentSlide = index;
            
            slides[currentSlide].classList.replace('opacity-0', 'opacity-100');
            dots[currentSlide].classList.replace('w-3', 'w-12');
            dots[currentSlide].classList.replace('bg-white/50', 'bg-white');
        }

        function nextSlide() {
            let next = (currentSlide + 1) % slides.length;
            setSlide(next);
        }

        setInterval(nextSlide, 5000);
    </script>

    <!-- Why Choose Us -->
    <section class="py-24 bg-white" data-aos="fade-up">
        <div class="container mx-auto px-6 max-w-7xl text-center mb-16">
            <span class="text-blue-600 font-black uppercase tracking-widest text-sm">Ưu thế của chúng tôi</span>
            <h2 class="text-4xl font-black text-slate-900 mt-2">Tại sao nên đặt tour tại BookingTravel?</h2>
        </div>
        <div class="container mx-auto px-6 max-w-7xl grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="text-center group">
                <div class="w-20 h-20 bg-blue-50 rounded-[2rem] flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-600 transition-colors duration-500">
                    <svg class="w-10 h-10 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 mb-4">Giá tốt nhất</h3>
                <p class="text-slate-500 leading-relaxed">Chúng tôi cam kết mang đến mức giá cạnh tranh nhất cùng nhiều chương trình ưu đãi độc quyền.</p>
            </div>
            <div class="text-center group">
                <div class="w-20 h-20 bg-orange-50 rounded-[2rem] flex items-center justify-center mx-auto mb-6 group-hover:bg-orange-500 transition-colors duration-500">
                    <svg class="w-10 h-10 text-orange-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 mb-4">An tâm tuyệt đối</h3>
                <p class="text-slate-500 leading-relaxed">Mọi chuyến đi đều được bảo hiểm đầy đủ và hỗ trợ bởi đội ngũ chuyên nghiệp suốt hành trình.</p>
            </div>
            <div class="text-center group">
                <div class="w-20 h-20 bg-purple-50 rounded-[2rem] flex items-center justify-center mx-auto mb-6 group-hover:bg-purple-600 transition-colors duration-500">
                    <svg class="w-10 h-10 text-purple-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 mb-4">Hỗ trợ 24/7</h3>
                <p class="text-slate-500 leading-relaxed">Đội ngũ chăm sóc khách hàng luôn sẵn sàng giải đáp mọi thắc mắc của bạn bất kể lúc nào.</p>
            </div>
        </div>
    </section>

    <!-- Top Destinations -->
    <section id="destinations" class="py-24 bg-slate-50" data-aos="fade-up">
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                <div>
                    <span class="text-blue-600 font-black uppercase tracking-widest text-sm">Gợi ý cho bạn</span>
                    <h2 class="text-4xl font-black text-slate-900 mt-2">Điểm đến tiêu biểu</h2>
                </div>
                <p class="text-slate-500 max-w-md mt-4 md:mt-0">Khám phá những vùng đất mới lạ và đầy màu sắc trên khắp dải đất hình chữ S.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 h-[500px]">
                <div class="md:col-span-2 relative group overflow-hidden rounded-[2.5rem]">
                    <img src="https://images.unsplash.com/photo-1528127269322-539801943592?q=80&w=1000" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Miền Bắc">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-8 left-8">
                        <h3 class="text-2xl font-black text-white">Miền Bắc</h3>
                        <p class="text-white/70 text-sm">Cảnh quan hùng vĩ & văn hóa lâu đời</p>
                    </div>
                </div>
                <div class="relative group overflow-hidden rounded-[2.5rem]">
                    <img src="https://images.unsplash.com/photo-1559592442-741eaf739791?q=80&w=1000" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Miền Trung">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-8 left-8">
                        <h3 class="text-xl font-black text-white">Miền Trung</h3>
                        <p class="text-white/70 text-sm">Di sản & biển xanh</p>
                    </div>
                </div>
                <div class="relative group overflow-hidden rounded-[2.5rem]">
                    <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?q=80&w=1000" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Miền Nam">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-8 left-8">
                        <h3 class="text-xl font-black text-white">Miền Nam</h3>
                        <p class="text-white/70 text-sm">Năng động & mến khách</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tour Listing (Existing) -->
    <main id="tours" class="container mx-auto px-6 py-24 max-w-7xl" data-aos="fade-up">
        <div class="flex flex-col md:flex-row justify-between items-center mb-16 gap-6">
            <div>
                <span class="text-blue-600 font-black uppercase tracking-widest text-sm">Lựa chọn của bạn</span>
                <h2 class="text-4xl font-black text-slate-900 mt-2">Tour Nổi Bật</h2>
            </div>
            
            <!-- Category Filter Tabs -->
            <div class="flex bg-slate-100 p-1.5 rounded-2xl overflow-x-auto no-scrollbar">
                <a href="{{ route('tours.index', ['category' => 'all']) }}" class="px-6 py-2.5 rounded-xl text-sm font-bold transition {{ !request('category') || request('category') == 'all' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">Tất cả</a>
                <a href="{{ route('tours.index', ['category' => 'north']) }}" class="px-6 py-2.5 rounded-xl text-sm font-bold transition {{ request('category') == 'north' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">Miền Bắc</a>
                <a href="{{ route('tours.index', ['category' => 'central']) }}" class="px-6 py-2.5 rounded-xl text-sm font-bold transition {{ request('category') == 'central' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">Miền Trung</a>
                <a href="{{ route('tours.index', ['category' => 'south']) }}" class="px-6 py-2.5 rounded-xl text-sm font-bold transition {{ request('category') == 'south' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">Miền Nam</a>
            </div>
        </div>

        @if($tours->isEmpty())
            <div class="text-center py-20 bg-white rounded-[3rem] border-2 border-dashed border-slate-100">
                <div class="text-5xl mb-4">🔍</div>
                <h3 class="text-xl font-black text-slate-900">Không tìm thấy tour phù hợp</h3>
                <p class="text-slate-400 mt-2">Bạn hãy thử tìm kiếm với từ khóa khác nhé!</p>
                <a href="{{ route('tours.index') }}" class="inline-block mt-6 text-blue-600 font-bold hover:underline">Xem lại tất cả tour</a>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @foreach($tours as $tour)
            <div class="tour-card bg-white rounded-[2.5rem] shadow-sm overflow-hidden border border-slate-100 flex flex-col">
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ $tour->image ?? 'https://placehold.co/600x400?text='.urlencode($tour->title) }}" alt="{{ $tour->title }}" class="w-full h-full object-cover">
                    <div class="absolute top-6 left-6 bg-white/90 backdrop-blur px-4 py-2 rounded-2xl text-xs font-black text-slate-900 shadow-sm border border-white/20 uppercase tracking-widest">
                        {{ $tour->location }}
                    </div>
                </div>
                
                <div class="p-10 flex flex-col flex-grow">
                    <h3 class="text-2xl font-black text-slate-900 mb-4 group-hover:text-blue-600 transition leading-tight">{{ $tour->title }}</h3>
                    <p class="text-slate-500 text-sm mb-8 line-clamp-2 leading-relaxed">{{ $tour->description }}</p>
                    
                    <div class="mt-auto pt-8 border-t border-slate-50 flex justify-between items-center">
                        <div class="flex flex-col">
                            <span class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Giá từ</span>
                            <span class="text-3xl font-black text-blue-600">{{ number_format($tour->price, 0, ',', '.') }} <small class="text-sm font-bold">đ</small></span>
                        </div>
                        <a href="/tour/{{ $tour->id }}" class="bg-slate-900 hover:bg-blue-600 text-white p-4 rounded-2xl transition-all shadow-xl active:scale-95">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-20">
            {{ $tours->links() }}
        </div>
    </main>

    <!-- Statistics -->
    <section class="py-24 bg-blue-600 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="container mx-auto px-6 max-w-7xl relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 text-center text-white">
                <div>
                    <p class="text-5xl font-black mb-2">12k+</p>
                    <p class="text-blue-100 font-bold uppercase tracking-widest text-xs">Khách hàng</p>
                </div>
                <div>
                    <p class="text-5xl font-black mb-2">500+</p>
                    <p class="text-blue-100 font-bold uppercase tracking-widest text-xs">Tour hàng năm</p>
                </div>
                <div>
                    <p class="text-5xl font-black mb-2">150+</p>
                    <p class="text-blue-100 font-bold uppercase tracking-widest text-xs">Điểm đến</p>
                </div>
                <div>
                    <p class="text-5xl font-black mb-2">4.9/5</p>
                    <p class="text-blue-100 font-bold uppercase tracking-widest text-xs">Đánh giá</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-24 bg-white" data-aos="fade-up">
        <div class="container mx-auto px-6 max-w-7xl text-center mb-16">
            <span class="text-blue-600 font-black uppercase tracking-widest text-sm">Cảm nhận khách hàng</span>
            <h2 class="text-4xl font-black text-slate-900 mt-2">Khách hàng nói gì về chúng tôi</h2>
        </div>
        <!-- Swiper Testimonials -->
        <div class="container mx-auto px-6 max-w-7xl overflow-hidden py-10">
            <div class="swiper testimonialSwiper pb-12">
                <div class="swiper-wrapper">
                    @forelse($testimonials as $index => $testimonial)
                        <div class="swiper-slide">
                            <div class="bg-white border border-slate-100 p-10 rounded-[2.5rem] shadow-sm hover:shadow-xl hover:border-blue-100 transition-all duration-500 h-full flex flex-col">
                                <div class="flex text-yellow-400 mb-6 gap-0.5">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $testimonial->rating ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    @endfor
                                </div>
                                <p class="text-slate-600 italic mb-8 leading-relaxed line-clamp-4 flex-grow">"{{ $testimonial->comment }}"</p>
                                <div class="flex items-center gap-4 mt-auto">
                                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-bold">
                                        {{ strtoupper(substr($testimonial->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-black text-slate-900 text-sm">{{ $testimonial->user->name }}</p>
                                        <p class="text-slate-400 text-xs">{{ $testimonial->tour->title }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-slate-50 rounded-[2.5rem] border-2 border-dashed border-slate-200 w-full">
                            <p class="text-slate-400 font-medium">Chưa có đánh giá nổi bật nào.</p>
                        </div>
                    @endforelse
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination !-bottom-2"></div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-slate-50" data-aos="fade-up">
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="text-blue-600 font-black uppercase tracking-widest text-sm">Liên hệ</span>
                    <h2 class="text-4xl font-black text-slate-900 mt-2 mb-6">Bạn có thắc mắc?<br>Đừng ngần ngại liên hệ!</h2>
                    <p class="text-slate-500 mb-10 leading-relaxed">Đội ngũ của chúng tôi luôn sẵn sàng hỗ trợ bạn 24/7 để đảm bảo bạn có một chuyến đi tuyệt vời nhất.</p>
                    
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Hotline 24/7</p>
                                <p class="text-slate-900 font-black">1900 8888</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Email hỗ trợ</p>
                                <p class="text-slate-900 font-black">contact@bookingtravel.vn</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-10 rounded-[3rem] shadow-2xl shadow-blue-900/5 border border-slate-100">
                    <form id="contact-form" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Họ và tên</label>
                                <input type="text" placeholder="Nguyễn Văn A" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-blue-600/20 transition">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Email</label>
                                <input type="email" placeholder="example@gmail.com" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-blue-600/20 transition">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Lời nhắn</label>
                            <textarea rows="4" placeholder="Bạn cần hỗ trợ gì?" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-blue-600/20 transition"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl transition-all shadow-xl shadow-blue-200 active:scale-95">Gửi tin nhắn</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="container mx-auto px-6 mb-24 max-w-7xl" data-aos="fade-up">
        <div class="bg-slate-900 rounded-[3rem] p-12 md:p-20 text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600/20 blur-[100px] rounded-full"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-600/20 blur-[100px] rounded-full"></div>
            
            <div class="relative z-10 max-w-2xl mx-auto">
                <h2 class="text-4xl font-black text-white mb-6 leading-tight">Đăng ký nhận tin để không bỏ lỡ ưu đãi!</h2>
                <p class="text-slate-400 mb-10">Để lại email của bạn, chúng tôi sẽ gửi những mã giảm giá và tour mới nhất định kỳ.</p>
                <form id="newsletter-form" class="flex flex-col md:flex-row gap-4">
                    <input type="email" required placeholder="Nhập email của bạn..." class="flex-grow bg-white/10 border border-white/20 rounded-2xl px-6 py-4 text-white focus:outline-none focus:border-blue-600 transition">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-black px-10 py-4 rounded-2xl transition-all shadow-lg shadow-blue-900 active:scale-95">Đăng ký ngay</button>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-slate-900 py-16 border-t border-white/5">
        <!-- Back to Top Button -->
        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="fixed bottom-8 right-8 w-14 h-14 bg-blue-600 text-white rounded-2xl shadow-2xl flex items-center justify-center hover:bg-blue-700 transition-all z-[60] active:scale-90">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
        </button>
        <div class="container mx-auto px-6 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5a2.5 2.5 0 012.5 2.5v.5m-1.5 6.516A10 10 0 113.337 4.75"></path></svg>
                        </div>
                        <h1 class="text-2xl font-black text-white">BookingTravel</h1>
                    </div>
                    <p class="text-slate-400 max-w-sm">Hệ thống đặt tour du lịch hàng đầu Việt Nam, mang đến những trải nghiệm du lịch đẳng cấp và đầy cảm xúc.</p>
                </div>
                <div>
                    <h4 class="text-white font-black mb-6">Liên kết</h4>
                    <ul class="space-y-4 text-slate-400 text-sm">
                        <li><a href="{{ route('about') }}" class="hover:text-blue-600 transition">Về chúng tôi</a></li>
                        <li><a href="#tours" class="hover:text-blue-600 transition">Danh sách tour</a></li>
                        <li><a href="#destinations" class="hover:text-blue-600 transition">Điểm đến</a></li>
                        <li><a href="{{ route('news') }}" class="hover:text-blue-600 transition">Tin tức</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-black mb-6">Liên hệ</h4>
                    <ul class="space-y-4 text-slate-400 text-sm">
                        <li>📍 123 Đường Du Lịch, Quận 1, TP. HCM</li>
                        <li>📞 1900 8888</li>
                        <li>✉️ contact@bookingtravel.vn</li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-white/5 text-center">
                <p class="text-slate-500 text-sm">© 2026 BookingTravel. Tất cả quyền được bảo lưu. Thiết kế bởi Antigravity.</p>
            </div>
        </div>
    </footer>

    <!-- AOS & Custom Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        // Newsletter Simulation
        document.getElementById('newsletter-form').addEventListener('submit', function(e) {
            e.preventDefault();
            Toast.fire({
                icon: 'success',
                title: 'Đăng ký nhận tin thành công!'
            });
            this.reset();
        });

        // Contact Form Simulation
        document.getElementById('contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            Toast.fire({
                icon: 'success',
                title: 'Cảm ơn bạn! Chúng tôi sẽ liên hệ lại sớm.'
            });
            this.reset();
        });

        // Swiper Initialization
        const swiper = new Swiper('.testimonialSwiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            centeredSlides: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });
    </script>
    @include('components.chatbot')
</body>
</html>