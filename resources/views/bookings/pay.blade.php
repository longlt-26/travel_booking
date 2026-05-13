<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán booking #{{ $booking->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<nav class="bg-white shadow p-4 mb-8">
    <div class="container mx-auto">
        <a href="{{ route('tours.show', $booking->tour_id) }}" class="text-blue-600 font-bold text-xl flex items-center gap-2">
            &larr; Về tour
        </a>
    </div>
</nav>

<div class="container mx-auto px-4 max-w-2xl">
    <div class="bg-white rounded-2xl shadow-xl p-6">
        <h1 class="text-2xl font-bold text-gray-800">Thanh toán</h1>
        <p class="text-gray-600 mt-2">Booking ID: <span class="font-semibold">#{{ $booking->id }}</span></p>

        <div class="mt-6 bg-gray-50 border rounded-lg p-4">
            <div class="flex justify-between">
                <div class="text-gray-700">Tour</div>
                <div class="font-semibold text-gray-900">{{ $booking->tour->title }}</div>
            </div>
            <div class="flex justify-between mt-2">
                <div class="text-gray-700">Số lượng</div>
                <div class="font-semibold text-gray-900">{{ $booking->quantity }}</div>
            </div>
            <div class="flex justify-between mt-2">
                <div class="text-gray-700">Tổng tiền</div>
                <div class="font-semibold text-gray-900">{{ number_format($booking->total_amount, 0, ',', '.') }} VNĐ</div>
            </div>
        </div>

        <div class="mt-6">
            <label class="block text-gray-700 font-bold mb-2">Chọn cổng thanh toán</label>
            <div class="flex gap-3 mb-4">
                @php($current = $provider)
                <a href="{{ route('bookings.pay', ['booking' => $booking->id, 'provider' => 'momo']) }}"
                   class="flex items-center gap-2 bg-white border rounded-lg px-4 py-2 cursor-pointer {{ $current === 'momo' ? 'ring-2 ring-blue-500' : '' }}">
                    <span class="font-semibold">Momo</span>
                </a>
                <a href="{{ route('bookings.pay', ['booking' => $booking->id, 'provider' => 'vnpay']) }}"
                   class="flex items-center gap-2 bg-white border rounded-lg px-4 py-2 cursor-pointer {{ $current === 'vnpay' ? 'ring-2 ring-blue-500' : '' }}">
                    <span class="font-semibold">VNPay</span>
                </a>
            </div>

            <div class="bg-gray-50 border rounded-lg p-4 text-xs text-gray-500">
                Demo hiện đang có sẵn callback handler. Khi bạn cấu hình đầy đủ env + bước tạo request (redirect tới cổng), hệ thống sẽ cập nhật booking tương ứng.
            </div>
        </div>

        <div class="mt-6">
            @if($provider === 'momo')
                <form action="{{ route('payment.momo.callback') }}" method="POST">

                    @csrf
                    <input type="hidden" name="orderInfo" value="{{ $booking->id }}">
                    <input type="hidden" name="resultCode" value="0">
                    <input type="hidden" name="transId" value="momo-{{ $booking->id }}">


                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="border rounded-lg p-4 bg-white">
                            <div class="font-semibold text-gray-800 mb-2">1) Quét mã QR (demo)</div>
                            <div class="flex items-center justify-center bg-gray-100 rounded-lg p-3 mb-3">
                                <div class="text-xs text-gray-500 text-center">
                                    QR mô phỏng<br>
                                    (khi click “Xác nhận đã quét” sẽ callback để cập nhật booking)
                                </div>
                            </div>
                            <button type="submit" name="momo_action" value="qr" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors text-lg shadow-md">
                                Xác nhận đã quét QR
                            </button>
                        </div>

                        <div class="border rounded-lg p-4 bg-white">
                            <div class="font-semibold text-gray-800 mb-2">2) Nhập thẻ cá nhân (demo)</div>
                            <div class="text-sm text-gray-600 mb-2">Nhập thông tin mô phỏng, hệ thống sẽ callback để thanh toán thành công.</div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">Số thẻ</label>
                            <input type="text" name="card_number" placeholder="1234 5678 9012 3456" class="w-full border rounded-lg px-3 py-2 text-sm mb-3" />
                            <label class="block text-xs font-bold text-gray-700 mb-1">Mã CVV</label>
                            <input type="text" name="card_cvv" placeholder="123" class="w-full border rounded-lg px-3 py-2 text-sm mb-3" />
                            <button type="submit" name="momo_action" value="card" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors text-lg shadow-md">
                                Xác nhận thanh toán
                            </button>
                        </div>
                    </div>

                    <p class="text-sm text-gray-500 mt-3">
                        Demo: click 1 trong 2 nút sẽ gọi callback và cập nhật trạng thái booking trên DB.
                    </p>

                </form>
            @else
                <form action="{{ route('payment.vnpay.callback') }}" method="POST">
                    @csrf
                    <input type="hidden" name="vnp_TxnRef" value="{{ $booking->id }}">
                    <input type="hidden" name="vnp_ResponseCode" value="00">
                    <input type="hidden" name="vnp_TransactionNo" value="demo-vnpay-{{ $booking->id }}">
                    <input type="hidden" name="vnp_SecureHash" value="demo">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors text-lg shadow-md">
                        Thanh toán qua VNPay (demo)
                    </button>

                    <p class="text-sm text-gray-500 mt-2">
                        Hiện tại luồng callback đã có sẵn. Bạn cần cấu hình key/URL cho VNPay và mình sẽ nối bước tạo request & redirect.
                    </p>
                </form>
            @endif
        </div>
    </div>
</div>

</body>
</html>

