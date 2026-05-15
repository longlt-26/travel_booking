<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'tour'])->latest()->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,failed,processing',
            'payment_provider' => 'nullable|string',
            'payment_reference' => 'nullable|string',
        ]);

        $updateData = [
            'status' => $validated['status']
        ];

        if ($request->has('payment_provider')) {
            $updateData['payment_provider'] = $validated['payment_provider'];
        }
        if ($request->has('payment_reference')) {
            $updateData['payment_reference'] = $validated['payment_reference'];
        }
        
        if ($validated['status'] === 'paid' && !$booking->paid_at) {
            $updateData['paid_at'] = now();
        }

        $booking->update($updateData);

        return back()->with('success', 'Cập nhật đơn hàng thành công!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return back()->with('success', 'Đã xóa đơn hàng thành công!');
    }
}
