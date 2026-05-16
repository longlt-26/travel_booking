<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán an toàn - Booking #{{ $booking->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100">
        <div class="container mx-auto px-6 h-16 flex items-center justify-between">
            <a href="{{ route('tours.show', $booking->tour_id) }}" class="flex items-center gap-2 text-slate-600 hover:text-blue-600 font-bold transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Quay lại
            </a>
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 4.908-3.333 9.277-8 10.125a12.51 12.51 0 01-8-10.125c0-.681.057-1.35.166-2.001zM10 14.752c2.31-.818 4.309-2.251 5.702-4.13.364-.506.662-1.05.892-1.622.23-.572.395-1.178.495-1.801.11-.65.166-1.32.166-2.001 0-3.356-1.554-6.416-4-8.252-2.446 1.836-4 4.896-4 8.252z" clip-rule="evenodd"></path></svg>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Thanh toán bảo mật SSL</span>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-6 py-12 max-w-5xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            
            <!-- Left: Order Summary -->
            <div class="space-y-8">
                <div>
                    <h1 class="text-3xl font-black text-slate-900 mb-2 tracking-tight">Thanh toán đơn hàng</h1>
                    <p class="text-slate-500">Mã đơn hàng: <span class="font-bold text-slate-900">#{{ $booking->id }}</span></p>
                </div>

                <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-xl shadow-slate-200/50 border border-slate-100">
                    <div class="p-8 space-y-6">
                        <div class="flex gap-6 items-center">
                            <div class="w-24 h-24 rounded-3xl overflow-hidden flex-shrink-0 shadow-sm">
                                <img src="{{ $booking->tour->image ?? 'https://images.unsplash.com/photo-1528127269322-539801943592?q=80&w=1000' }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h2 class="text-xl font-black text-slate-900 mb-1 leading-tight">{{ $booking->tour->title }}</h2>
                                <p class="text-sm text-slate-400 font-bold uppercase tracking-widest">{{ $booking->tour->location }}</p>
                            </div>
                        </div>

                        <div class="space-y-4 pt-6 border-t border-slate-50">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500 font-medium">Ngày khởi hành</span>
                                <span class="text-slate-900 font-black">{{ $booking->departure_date ? $booking->departure_date->format('d/m/Y') : 'Chưa xác định' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500 font-medium">Số lượng người</span>
                                <span class="text-slate-900 font-black">{{ $booking->quantity }} người</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500 font-medium">Đơn giá</span>
                                <span class="text-slate-900 font-bold">{{ number_format($booking->tour->price, 0, ',', '.') }} đ</span>
                            </div>

                            <div class="flex justify-between text-sm pt-4 border-t border-slate-50">
                                <span class="text-slate-500 font-medium">Tạm tính</span>
                                <span class="text-slate-900 font-black">{{ number_format($booking->tour->price * $booking->quantity, 0, ',', '.') }} đ</span>
                            </div>

                            @if($booking->voucher_code)
                                @php
                                    $subtotal = $booking->tour->price * $booking->quantity;
                                    $percent = round(($booking->discount_amount / $subtotal) * 100);
                                @endphp
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500 font-medium">Khuyến mãi ({{ $booking->voucher_code }})</span>
                                    <span class="text-blue-600 font-bold">{{ $percent }}%</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500 font-medium">Giảm giá</span>
                                    <span class="text-green-600 font-black">- {{ number_format($booking->discount_amount, 0, ',', '.') }} đ</span>
                                </div>
                            @endif
                        </div>

                        <div class="bg-slate-900 rounded-3xl p-6 flex justify-between items-center mt-6">
                            <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">Tổng số tiền</span>
                            <span class="text-2xl font-black text-white">{{ number_format($booking->total_amount, 0, ',', '.') }} đ</span>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 p-6 rounded-3xl border border-blue-100 flex items-start gap-4">
                    <div class="text-xl">🛡️</div>
                    <p class="text-xs text-blue-800 leading-relaxed font-medium">
                        Dữ liệu của bạn được mã hóa an toàn. Chúng tôi không lưu trữ bất kỳ thông tin thẻ ngân hàng nào của khách hàng.
                    </p>
                </div>
            </div>

            <!-- Right: Unified QR Box -->
            <div class="bg-white rounded-[2.5rem] p-10 shadow-2xl shadow-blue-900/5 border border-slate-100 text-center">
                <div id="payment-content" class="space-y-8">
                    <h3 class="text-xl font-black flex items-center justify-center gap-3 text-slate-900">
                        <div class="w-2 h-6 bg-blue-600 rounded-full"></div>
                        Quét mã QR để thanh toán
                    </h3>

                    <!-- Countdown Timer -->
                    <div class="flex justify-center items-center gap-4 bg-orange-50 p-4 rounded-2xl border border-orange-100">
                        <div class="text-2xl animate-bounce">⏳</div>
                        <div class="text-left">
                            <p class="text-[10px] font-black text-orange-400 uppercase tracking-widest">Thời gian thanh toán còn lại</p>
                            <p class="text-xl font-black text-orange-600" id="countdown">05:00</p>
                        </div>
                    </div>

                    <form action="{{ route('payment.momo.callback') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="orderInfo" value="{{ $booking->id }}">
                        <input type="hidden" name="resultCode" value="0">
                        <input type="hidden" name="transId" value="momo-{{ $booking->id }}">

                        <div class="bg-slate-50 p-8 rounded-[2.5rem] border border-slate-100">
                            <!-- Dynamic QR Code (VietQR) -->
                            <div class="bg-white p-4 rounded-3xl inline-block shadow-sm border border-slate-100 mb-8 group">
                                @php
                                    $bankId = env('BANK_ID', 'MB');
                                    $bankAccount = env('BANK_ACCOUNT', '123456789');
                                    $bankName = rawurlencode(env('BANK_ACCOUNT_NAME', 'BOOKING TRAVEL'));
                                    $amount = $booking->total_amount;
                                    $info = rawurlencode("THANHTOAN TOUR " . $booking->id);
                                    
                                    $qrUrl = "https://img.vietqr.io/image/{$bankId}-{$bankAccount}-compact2.png?amount={$amount}&addInfo={$info}&accountName={$bankName}";
                                @endphp
                                <img src="{{ $qrUrl }}" 
                                     class="w-56 h-56 rounded-2xl transition-transform group-hover:scale-105 duration-500" alt="Mã QR Thanh toán">
                            </div>

                            <!-- Payment Details -->
                            <div class="space-y-4 mb-8 text-left bg-white p-6 rounded-2xl border border-slate-100">
                                <div class="flex justify-between items-center">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Số tiền cần trả:</span>
                                    <span class="text-blue-600 font-black text-lg">{{ number_format($booking->total_amount, 0, ',', '.') }} đ</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nội dung chuyển khoản:</span>
                                    <span class="text-slate-900 font-black text-sm uppercase">THANHTOAN TOUR {{ $booking->id }}</span>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-slate-900 hover:bg-blue-600 text-white font-black py-4 rounded-2xl transition-all shadow-xl shadow-blue-100 active:scale-95 flex items-center justify-center gap-2">
                                <span>Xác nhận đã chuyển khoản</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Expired Message -->
                <div id="expired-message" class="hidden py-12 text-center">
                    <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">⚠️</div>
                    <h3 class="text-2xl font-black text-slate-900 mb-4">Phiên thanh toán hết hạn</h3>
                    <p class="text-slate-500 mb-8 max-w-xs mx-auto text-sm leading-relaxed">Đơn hàng của bạn vẫn được lưu. Bạn có muốn tạo mã thanh toán mới không?</p>
                    <div class="flex flex-col gap-3 max-w-xs mx-auto">
                        <button onclick="window.location.reload()" class="bg-blue-600 text-white font-black px-10 py-4 rounded-2xl shadow-xl shadow-blue-200 hover:bg-blue-700 transition">
                            Thanh toán lại (Lấy mã mới)
                        </button>
                        <a href="{{ route('bookings.index') }}" class="text-slate-400 hover:text-slate-600 font-bold text-sm transition py-2">
                            Quay lại đơn hàng
                        </a>
                    </div>
                </div>

                <div class="space-y-6 pt-10">
                    <p class="text-xs text-slate-400 font-medium">Hỗ trợ thanh toán qua tất cả ứng dụng Ngân hàng và Ví điện tử</p>
                    <div class="flex justify-center items-center gap-6 opacity-30 grayscale saturate-0">
                        <img src="https://upload.wikimedia.org/wikipedia/vi/f/fe/MoMo_Logo.png" class="h-6">
                        <img src="https://vnpay.vn/wp-content/uploads/2020/07/Logo-VNPAYQR-1.png" class="h-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-6">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-4">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-12 text-center">
        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.2em]">© 2026 BookingTravel Platform. All rights reserved.</p>
    </footer>

    <script>
        // Thời gian hết hạn: 5 phút kể từ lúc mở trang này
        const startTime = new Date().getTime();
        const expiryTime = startTime + (5 * 60 * 1000); // + 5 phút

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = expiryTime - now;

            if (distance < 0) {
                clearInterval(timer);
                document.getElementById('payment-content').classList.add('hidden');
                document.getElementById('expired-message').classList.remove('hidden');
                return;
            }

            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('countdown').innerHTML = 
                (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
        }

        const timer = setInterval(updateCountdown, 1000);
        updateCountdown(); // Run immediately
    </script>
</body>
</html>
