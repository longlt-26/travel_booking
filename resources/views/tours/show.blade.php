<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tour->title }} - Chi tiết Tour</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
        }
        .booking-card {
            position: sticky;
            top: 100px;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <!-- Navigation -->
    <nav class="glass-header sticky top-0 z-50 border-b border-slate-200">
        <div class="container mx-auto px-6 h-20 flex justify-between items-center max-w-7xl">
            <a href="{{ route('tours.index') }}" class="flex items-center gap-2 text-slate-600 hover:text-blue-600 font-bold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Quay lại
            </a>
            <div class="hidden md:block">
                <h2 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Đang xem tour</h2>
                <p class="text-slate-900 font-black truncate max-w-[300px]">{{ $tour->title }}</p>
            </div>
            <div class="w-20"></div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-12 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Left Side: Tour Info -->
            <div class="lg:col-span-2 space-y-12">
                <!-- Image Hero -->
                <div class="relative h-[500px] rounded-[3rem] overflow-hidden shadow-2xl">
                    <img src="{{ $tour->image ?? 'https://images.unsplash.com/photo-1528127269322-539801943592?q=80&w=2070' }}" alt="{{ $tour->title }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                    <div class="absolute bottom-10 left-10 text-white">
                        <span class="inline-block px-4 py-1.5 bg-blue-600 rounded-full text-xs font-bold uppercase tracking-wider mb-4 border border-white/20">
                            {{ $tour->location }}
                        </span>
                        <h1 class="text-4xl md:text-5xl font-black leading-tight">{{ $tour->title }}</h1>
                    </div>
                </div>

                <!-- Description Section -->
                <section class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100">
                    <h2 class="text-2xl font-black mb-6 flex items-center gap-3">
                        <div class="w-2 h-8 bg-blue-600 rounded-full"></div>
                        Giới thiệu hành trình
                    </h2>
                    <p class="text-slate-600 leading-relaxed text-lg whitespace-pre-line">{{ $tour->description }}</p>
                </section>

                <!-- Itinerary Section (Simulated) -->
                <section class="space-y-6">
                    <h2 class="text-2xl font-black flex items-center gap-3">
                        <div class="w-2 h-8 bg-blue-600 rounded-full"></div>
                        Lịch trình chi tiết
                    </h2>
                    <div class="space-y-4">
                        @php
                            $days = ['Ngày 1: Khởi hành & Khám phá', 'Ngày 2: Hoạt động trải nghiệm', 'Ngày 3: Mua sắm & Trở về'];
                        @endphp
                        @foreach($days as $index => $day)
                        <div class="bg-white p-6 rounded-3xl border border-slate-100 flex gap-6 hover:border-blue-200 transition group">
                            <div class="w-12 h-12 bg-slate-100 rounded-2xl flex-shrink-0 flex items-center justify-center font-bold text-slate-500 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                0{{ $index + 1 }}
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $day }}</h3>
                                <p class="text-slate-500 text-sm leading-relaxed">Chào đón quý khách tại điểm hẹn, bắt đầu hành trình khám phá những địa điểm nổi tiếng nhất trong chương trình tour.</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                <!-- Services Included -->
                <section class="bg-slate-900 text-white p-10 rounded-[2.5rem] grid grid-cols-2 md:grid-cols-4 gap-8 shadow-xl">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4">🏠</div>
                        <p class="text-xs font-bold text-slate-400 uppercase">Khách sạn</p>
                        <p class="font-bold">4-5 Sao</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4">🍽️</div>
                        <p class="text-xs font-bold text-slate-400 uppercase">Ăn uống</p>
                        <p class="font-bold">Full option</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4">🚌</div>
                        <p class="text-xs font-bold text-slate-400 uppercase">Di chuyển</p>
                        <p class="font-bold">Xe đời mới</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4">🛡️</div>
                        <p class="text-xs font-bold text-slate-400 uppercase">Bảo hiểm</p>
                        <p class="font-bold">50 triệu/vụ</p>
                    </div>
                </section>
            </div>

            <!-- Right Side: Booking Card -->
            <div>
                <div class="booking-card bg-white p-8 rounded-[2.5rem] shadow-2xl border border-blue-50">
                    <div class="mb-8">
                        <p class="text-slate-400 text-sm font-bold uppercase tracking-widest mb-1">Giá mỗi khách</p>
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-black text-blue-600">{{ number_format($tour->price, 0, ',', '.') }}</span>
                            <span class="text-slate-400 font-bold uppercase text-sm">đ</span>
                        </div>
                    </div>

                    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="tour_id" value="{{ $tour->id }}">

                        <div class="space-y-6">
                            <div class="space-y-3">
                                <label for="departure_date" class="block text-slate-700 font-black text-sm uppercase">Ngày khởi hành</label>
                                <div class="relative">
                                    <input type="date" name="departure_date" id="departure_date" required min="{{ date('Y-m-d') }}"
                                           class="w-full bg-slate-50 px-6 py-4 rounded-2xl border-2 border-slate-100 focus:border-blue-600 focus:outline-none font-bold text-lg transition">
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="block text-slate-700 font-black text-sm uppercase">Số lượng người tham gia</label>
                                <div class="relative">
                                    <input type="number" id="quantity" name="quantity" min="1" max="{{ $tour->max_people }}" value="1"
                                           class="w-full bg-slate-50 px-6 py-4 rounded-2xl border-2 border-slate-100 focus:border-blue-600 focus:outline-none font-bold text-lg transition">
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-sm">/ {{ $tour->max_people }} tối đa</div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="voucher" class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Mã giảm giá (Voucher)</label>
                            <div class="relative">
                                <input type="text" name="voucher_code" id="voucher" placeholder="Nhập mã ưu đãi..." class="w-full bg-slate-50 border-2 border-slate-50 rounded-xl px-4 py-3 text-sm focus:border-blue-600 focus:outline-none transition font-bold uppercase placeholder:normal-case">
                                <button type="button" class="absolute right-2 top-1/2 -translate-y-1/2 bg-blue-600 text-white px-3 py-1.5 rounded-lg text-[10px] font-black hover:bg-blue-700 transition uppercase">Áp dụng</button>
                            </div>
                        </div>

                        <div class="p-6 bg-blue-50 rounded-3xl border border-blue-100 space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500 font-medium">Tổng số tiền:</span>
                                <span class="text-2xl font-black text-blue-600" id="totalAmount">
                                    {{ number_format($tour->price, 0, ',', '.') }} đ
                                </span>
                            </div>
                            <p class="text-[10px] text-blue-400 uppercase font-bold text-center tracking-widest">Đã bao gồm thuế và phí dịch vụ</p>
                        </div>

                        <button type="submit" class="w-full bg-slate-900 hover:bg-blue-600 text-white font-black py-5 px-6 rounded-2xl transition-all shadow-xl shadow-blue-100 active:scale-95 flex items-center justify-center gap-3">
                            Xác nhận đặt ngay
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>

                    <div class="mt-8 space-y-4">
                        <div class="flex gap-4 items-center text-sm text-slate-500 bg-slate-50 p-3 rounded-2xl">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">📞</div>
                            <div>
                                <p class="font-bold text-slate-900">Hỗ trợ 24/7</p>
                                <p class="text-xs">Hotline: 1900 8888</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="bg-slate-900 py-12 mt-20">
        <div class="container mx-auto px-6 text-center">
            <p class="text-slate-400 text-sm">© 2026 BookingTravel. Kiến tạo những hành trình tuyệt vời.</p>
        </div>
    </footer>

    <script>
        const price = {{ (float) $tour->price }};
        const quantityInput = document.getElementById('quantity');
        const totalEl = document.getElementById('totalAmount');
        const bookingForm = document.querySelector('form');

        function formatVnd(n) {
            return new Intl.NumberFormat('vi-VN').format(Math.round(n)) + ' đ';
        }

        function updateTotal() {
            const q = parseInt(quantityInput.value || '1', 10);
            totalEl.textContent = formatVnd(price * q);
        }

        quantityInput.addEventListener('input', updateTotal);

        // Professional Booking Confirmation
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const q = quantityInput.value;
            const total = formatVnd(price * q);

            Swal.fire({
                title: 'Xác nhận đặt tour?',
                html: `Bạn đang đặt tour cho <b>${q} người</b>.<br>Tổng tiền: <b class="text-blue-600">${total}</b>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Đồng ý đặt ngay',
                cancelButtonText: 'Hủy bỏ',
                background: '#ffffff',
                borderRadius: '1.5rem',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Đang xử lý...',
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        bookingForm.submit();
                    });
                }
            });
        });
    </script>

</body>
</html>