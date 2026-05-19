<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $tour->title }} - Chi tiết Tour</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

                <!-- Reviews Section -->
                <section class="space-y-8 pb-12">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-black flex items-center gap-3">
                            <div class="w-2 h-8 bg-blue-600 rounded-full"></div>
                            Đánh giá từ khách hàng ({{ $tour->reviews->where('status', 'approved')->count() }})
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        @forelse($tour->reviews->where('status', 'approved') as $review)
                            <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center text-blue-600 font-black">
                                            {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-black text-slate-900 text-sm">{{ $review->user->name }}</p>
                                            <p class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="flex text-yellow-400 gap-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-slate-600 leading-relaxed text-sm italic">"{{ $review->comment }}"</p>
                            </div>
                        @empty
                            <div class="text-center py-12 bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200">
                                <p class="text-slate-400 font-medium">Chưa có đánh giá nào cho tour này.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Review Form -->
                    @auth
                        <div class="bg-blue-600 p-10 rounded-[2.5rem] shadow-xl shadow-blue-200 text-white">
                            <h3 class="text-xl font-black mb-2">Chia sẻ trải nghiệm của bạn</h3>
                            <p class="text-blue-100 text-sm mb-8 opacity-90">Ý kiến của bạn giúp chúng tôi cải thiện dịch vụ tốt hơn.</p>
                            
                            <form id="reviewForm" action="{{ route('reviews.store', $tour) }}" method="POST" class="space-y-6">
                                @csrf
                                <div class="space-y-4">
                                    <label class="block text-xs font-black uppercase tracking-widest text-blue-100">Đánh giá sao</label>
                                    <div class="flex gap-4" x-data="{ rating: 5 }">
                                        <template x-for="i in 5">
                                            <button type="button" @click="rating = i" class="transition-transform active:scale-90">
                                                <svg class="w-8 h-8 cursor-pointer" :class="i <= rating ? 'text-yellow-400 fill-current' : 'text-blue-400'" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            </button>
                                        </template>
                                        <input type="hidden" name="rating" :value="rating">
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="block text-xs font-black uppercase tracking-widest text-blue-100">Bình luận của bạn</label>
                                    <textarea name="comment" rows="4" required minlength="10" placeholder="Hãy viết cảm nhận của bạn về chuyến đi này..."
                                              class="w-full bg-white/10 border border-white/20 rounded-2xl px-6 py-4 text-white placeholder:text-blue-200 focus:outline-none focus:border-white transition"></textarea>
                                </div>

                                <button type="submit" class="bg-white text-blue-600 px-10 py-4 rounded-2xl font-black shadow-xl hover:bg-blue-50 transition-all active:scale-95">
                                    Gửi đánh giá ngay
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="bg-slate-900 p-10 rounded-[2.5rem] text-center text-white">
                            <h3 class="text-xl font-black mb-4">Bạn muốn đánh giá tour này?</h3>
                            <p class="text-slate-400 mb-8">Vui lòng đăng nhập để chia sẻ cảm nhận của bạn.</p>
                            <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white px-10 py-4 rounded-2xl font-black shadow-xl hover:bg-blue-700 transition-all">Đăng nhập ngay</a>
                        </div>
                    @endauth
                </section>
                
                <!-- Recommendation Engine Section -->
                @if(isset($recommendedTours) && $recommendedTours->count() > 0)
                <section class="space-y-8 pb-12 pt-12 border-t border-slate-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-blue-600 font-black uppercase tracking-widest text-xs">Gợi ý từ AI</span>
                            <h2 class="text-2xl font-black flex items-center gap-3 mt-1">
                                <div class="w-2 h-8 bg-purple-600 rounded-full"></div>
                                Các tour tương tự bạn có thể thích
                            </h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($recommendedTours as $recTour)
                        <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-slate-100 flex flex-col group hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $recTour->image ?? 'https://placehold.co/600x400?text='.urlencode($recTour->title) }}" alt="{{ $recTour->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1.5 rounded-xl text-[10px] font-black text-slate-900 shadow-sm border border-white/20 uppercase tracking-widest">
                                    {{ $recTour->location }}
                                </div>
                            </div>
                            
                            <div class="p-6 flex flex-col flex-grow">
                                <h3 class="text-lg font-black text-slate-900 mb-2 group-hover:text-blue-600 transition leading-tight line-clamp-2">{{ $recTour->title }}</h3>
                                
                                <div class="mt-auto pt-4 border-t border-slate-50 flex justify-between items-center">
                                    <span class="text-xl font-black text-blue-600">{{ number_format($recTour->price, 0, ',', '.') }} <small class="text-xs font-bold">đ</small></span>
                                    <a href="/tour/{{ $recTour->id }}" class="bg-slate-50 hover:bg-blue-600 hover:text-white text-slate-600 p-2.5 rounded-xl transition-all shadow-sm active:scale-95">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>

            <!-- Right Side: Booking Card -->
            <div>
                <div class="booking-card bg-white p-8 rounded-[2.5rem] shadow-2xl border border-blue-50">
                    <div class="mb-8">
                        <p class="text-slate-400 text-sm font-bold uppercase tracking-widest mb-1">Giá mỗi khách</p>
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-black text-blue-600">{{ number_format($tour->dynamic_price, 0, ',', '.') }}</span>
                            <span class="text-slate-400 font-bold uppercase text-sm">đ</span>
                        </div>
                        @if($tour->dynamic_price !== $tour->price)
                            <div class="mt-2 inline-flex items-center gap-1.5 px-3 py-1 bg-purple-50 text-purple-600 text-[10px] font-black uppercase tracking-widest rounded-lg border border-purple-100">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                Giá tối ưu thông minh (AI)
                            </div>
                        @endif
                    </div>

                    <form id="bookingForm" action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
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
                                <input type="text" name="voucher_code" id="voucherCode" placeholder="Nhập mã ưu đãi..." class="w-full bg-slate-50 border-2 border-slate-50 rounded-xl px-4 py-3 text-sm focus:border-blue-600 focus:outline-none transition font-bold uppercase placeholder:normal-case">
                                <button type="button" id="applyVoucherBtn" class="absolute right-2 top-1/2 -translate-y-1/2 bg-blue-600 text-white px-3 py-1.5 rounded-lg text-[10px] font-black hover:bg-blue-700 transition uppercase">Áp dụng</button>
                            </div>
                        </div>

                        <div class="p-6 bg-blue-50 rounded-3xl border border-blue-100 space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500 font-medium">Tạm tính:</span>
                                <span class="text-lg font-bold text-slate-900" id="subtotalAmount">
                                    {{ number_format($tour->dynamic_price, 0, ',', '.') }} đ
                                </span>
                            </div>
                            <div id="discountRow" class="flex justify-between items-center hidden">
                                <span class="text-slate-500 font-medium">Giảm giá:</span>
                                <span class="text-lg font-bold text-green-600" id="discountAmount">- 0 đ</span>
                            </div>
                            <div class="flex justify-between items-center pt-2 border-t border-blue-200">
                                <span class="text-slate-900 font-black">Tổng cộng:</span>
                                <span class="text-2xl font-black text-blue-600" id="totalAmount">
                                    {{ number_format($tour->dynamic_price, 0, ',', '.') }} đ
                                </span>
                            </div>
                            <p class="text-[10px] text-blue-400 uppercase font-bold text-center tracking-widest mt-2">Đã bao gồm thuế và phí dịch vụ</p>
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
        const price = {{ (float) $tour->dynamic_price }};
        const quantityInput = document.getElementById('quantity');
        const totalEl = document.getElementById('totalAmount');
        const bookingForm = document.getElementById('bookingForm');

        function formatVnd(n) {
            return new Intl.NumberFormat('vi-VN').format(Math.round(n)) + ' đ';
        }

        function updateTotal() {
            resetVoucher();
            document.getElementById('voucherCode').value = '';
            const q = parseInt(quantityInput.value || '1', 10);
            const subtotal = price * q;
            document.getElementById('subtotalAmount').innerText = formatVnd(subtotal);
            document.getElementById('totalAmount').innerText = formatVnd(subtotal);
        }

        quantityInput.addEventListener('input', updateTotal);

        // Professional Booking Confirmation
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const q = quantityInput.value;
            const finalTotal = document.getElementById('totalAmount').innerText;

            Swal.fire({
                title: 'Xác nhận đặt tour?',
                html: `Bạn đang đặt tour cho <b>${q} người</b>.<br>Tổng tiền: <b class="text-blue-600">${finalTotal}</b>`,
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
                    // Submit directly to bypass the current listener
                    e.target.submit();
                }
            });
        });

        // Voucher Logic
        document.getElementById('applyVoucherBtn').addEventListener('click', function() {
            const code = document.getElementById('voucherCode').value;
            const quantity = document.querySelector('input[name="quantity"]').value;
            const subtotal = {{ $tour->dynamic_price }} * quantity;

            if (!code) {
                Swal.fire('Lỗi', 'Vui lòng nhập mã giảm giá', 'error');
                return;
            }

            fetch('{{ route('vouchers.check') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ code: code, total: subtotal })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('discountRow').classList.remove('hidden');
                    document.getElementById('discountAmount').innerText = '- ' + new Intl.NumberFormat('vi-VN').format(data.discount_amount) + ' đ';
                    document.getElementById('totalAmount').innerText = new Intl.NumberFormat('vi-VN').format(data.new_total) + ' đ';
                    
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                } else {
                    Swal.fire('Lỗi', data.message, 'error');
                    resetVoucher();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Lỗi', 'Có lỗi xảy ra khi kiểm tra mã giảm giá', 'error');
            });
        });

        function resetVoucher() {
            document.getElementById('discountRow').classList.add('hidden');
            const quantity = document.querySelector('input[name="quantity"]').value;
            const subtotal = {{ $tour->dynamic_price }} * quantity;
            document.getElementById('totalAmount').innerText = new Intl.NumberFormat('vi-VN').format(subtotal) + ' đ';
        }

    </script>

    @include('components.chatbot')
</body>
</html>