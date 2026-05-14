<?php


namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => ['required', 'integer', 'exists:tours,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $tour = Tour::findOrFail($validated['tour_id']);

        if ((int) $validated['quantity'] > (int) $tour->max_people) {
            return back()->withErrors([
                'quantity' => 'Số lượng vượt quá giới hạn tối đa của tour.',
            ])->withInput();
        }

        $quantity = (int) $validated['quantity'];
        $total = (float) $tour->price * $quantity;

        // Nếu trước đó đã có pending booking cho đúng user/tour thì dùng lại
        // để tránh lỗi do booking bị bắn lại/đổi trạng thái giữa chừng.
        $booking = Booking::firstOrCreate(
            [
                'user_id' => $request->user()->id,
                'tour_id' => $tour->id,
                'status' => 'pending',
            ],
            [
                'quantity' => $quantity,
                'total_amount' => $total,
            ]
        );

        // Luôn sync lại quantity/total để đúng theo input hiện tại
        $booking->update([
            'quantity' => $quantity,
            'total_amount' => $total,
        ]);

        return redirect()->route('bookings.pay', $booking);
    }

    public function pay(Request $request, Booking $booking)
    {
        $this->authorizeBooking($request, $booking);

        if ($booking->status !== 'pending') {
            return back()->with('status_message', 'Booking không ở trạng thái pending.')->withInput();
        }

        $provider = $request->query('provider', 'momo');
        if (!in_array($provider, ['momo', 'vnpay'], true)) {
            $provider = 'momo';
        }

        // Render view hiển thị thông tin + redirect sang cổng
        return view('bookings.pay', [
            'booking' => $booking->load('tour'),
            'provider' => $provider,
        ]);
    }

    public function vnpayCallback(Request $request)
    {
        // VNPay gửi dữ liệu qua POST
        // Ở đây implement theo hướng "không phụ thuộc package".
        // Bạn cần cấu hình đúng trong .env để verify signature.

        $input = $request->all();

        $bookingId = $input['vnp_TxnRef'] ?? null; // mình dùng Booking ID làm TxnRef
        if (!$bookingId) {
            return response()->noContent(200);
        }

        $booking = Booking::where('id', $bookingId)->first();
        if (!$booking) {
            return response()->noContent(200);
        }

        try {
            $vnp_ResponseCode = $input['vnp_ResponseCode'] ?? '';
            $secureHash = $input['vnp_SecureHash'] ?? '';

            $tmnCode = env('VNPAY_TMN_CODE');
            $hashSecret = env('VNPAY_HASH_SECRET');

            // Nếu thiếu config thì chỉ cập nhật theo ResponseCode (vẫn để flow chạy)
            if ($tmnCode && $hashSecret && $secureHash) {
                $dataFields = [
                    'vnp_Amount',
                    'vnp_BankCode',
                    'vnp_BankTranNo',
                    'vnp_CardType',
                    'vnp_OrderInfo',
                    'vnp_PayDate',
                    'vnp_ResponseCode',
                    'vnp_TmnCode',
                    'vnp_TransactionNo',
                    'vnp_TransactionStatus',
                    'vnp_TxnRef',
                    'vnp_Version',
                ];

                $hashData = '';
                foreach ($dataFields as $field) {
                    if (isset($input[$field])) {
                        $hashData .= $input[$field];
                    }
                }

                $calcHash = hash_hmac('sha512', $hashData, $hashSecret);
                if (!hash_equals(strtolower($secureHash), strtolower($calcHash))) {
                    $booking->update([
                        'status' => 'failed',
                        'payment_provider' => 'vnpay',
                        'payment_reference' => $input['vnp_TransactionNo'] ?? null,
                    ]);

                    return response()->noContent(200);
                }
            }

            $success = (string) $vnp_ResponseCode === '00';

            // Idempotency: callback có thể bị bắn nhiều lần.
            // Nếu booking đã paid/failed rồi thì chỉ update các trường payment_reference.
            if (in_array($booking->status, ['paid', 'failed'], true)) {
                $booking->update([
                    'payment_provider' => 'vnpay',
                    'payment_reference' => $input['vnp_TransactionNo'] ?? $booking->payment_reference,
                ]);
            } else {
                if ($success) {
                    $booking->update([
                        'status' => 'paid',
                        'payment_provider' => 'vnpay',
                        'payment_reference' => $input['vnp_TransactionNo'] ?? null,
                        'paid_at' => Carbon::now(),
                    ]);
                } else {
                    $booking->update([
                        'status' => 'failed',
                        'payment_provider' => 'vnpay',
                        'payment_reference' => $input['vnp_TransactionNo'] ?? null,
                    ]);
                }
            }
        } catch (\Throwable $e) {
            Log::error('VNPay callback error: '.$e->getMessage());
            $booking->update([
                'status' => 'failed',
                'payment_provider' => 'vnpay',
            ]);
        }

        // Demo: callback có thể bị gọi lại.
        // Tránh redirect loop: nếu booking đã paid/failed thì đưa về trang tour.
        if ($booking->status !== 'pending') {
            return redirect()->route('tours.show', $booking->tour_id);
        }

        return redirect()->route('bookings.pay', $booking->id);
    }

    public function momoCallback(Request $request)
    {

        $input = $request->all();

        $bookingId = $input['orderInfo'] ?? null;
        if (!$bookingId) {
            // Momo gửi orderId/extra tuỳ cấu hình; tuỳ bạn map lại
            $bookingId = $input['partnerCode'] ?? null;
        }

        if (!$bookingId) {
            return response()->noContent(200);
        }

        $booking = Booking::where('id', (int) $bookingId)->first();
        if (!$booking) {
            return response()->noContent(200);
        }

        try {
            // Momo signature verify (tuỳ bạn cấu hình chính xác).
            // Nếu không có đủ env, flow vẫn có thể update theo resultCode.
            $resultCode = (string) ($input['resultCode'] ?? '');
            $success = $resultCode === '0' || $resultCode === '00';

            // Idempotency: callback có thể bị bắn nhiều lần.
            if (in_array($booking->status, ['paid', 'failed'], true)) {
                $booking->update([
                    'payment_provider' => 'momo',
                    'payment_reference' => $input['transId'] ?? $booking->payment_reference,
                ]);
            } else {
                if ($success) {
                    $booking->update([
                        'status' => 'paid',
                        'payment_provider' => 'momo',
                        'payment_reference' => $input['transId'] ?? null,
                        'paid_at' => Carbon::now(),
                    ]);
                } else {
                    $booking->update([
                        'status' => 'failed',
                        'payment_provider' => 'momo',
                        'payment_reference' => $input['transId'] ?? null,
                    ]);
                }
            }
        } catch (\Throwable $e) {
            Log::error('Momo callback error: '.$e->getMessage());
            $booking->update([
                'status' => 'failed',
                'payment_provider' => 'momo',
            ]);
        }

        // Demo: sau callback, redirect quay lại trang thanh toán
        return redirect()->route('bookings.pay', $booking->id);
    }

    private function authorizeBooking(Request $request, Booking $booking): void

    {
        abort_unless($booking->user_id === $request->user()->id, 403);
    }
}

