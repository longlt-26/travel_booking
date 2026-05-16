<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherAdminController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::latest()->paginate(10);
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:vouchers,code|max:50',
            'discount_percent' => 'required|integer|min:1|max:100',
            'min_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
        ]);

        Voucher::create($validated);

        return redirect()->route('admin.vouchers.index')->with('success', 'Đã thêm mã khuyến mãi thành công');
    }

    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, Voucher $voucher)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:vouchers,code,'.$voucher->id,
            'discount_percent' => 'required|integer|min:1|max:100',
            'min_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'boolean',
        ]);

        $voucher->update($validated);

        return redirect()->route('admin.vouchers.index')->with('success', 'Đã cập nhật mã khuyến mãi thành công');
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Đã xóa mã khuyến mãi thành công');
    }

    public function check(Request $request)
    {
        $code = $request->code;
        $total = (float) $request->total;

        $voucher = Voucher::where('code', $code)->first();

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không tồn tại.'
            ], 404);
        }

        if (!$voucher->isCurrent()) {
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá đã hết hạn hoặc chưa được kích hoạt.'
            ], 400);
        }

        if ($total < $voucher->min_amount) {
            return response()->json([
                'success' => false,
                'message' => 'Đơn hàng chưa đạt giá trị tối thiểu để sử dụng mã này (' . number_format($voucher->min_amount, 0, ',', '.') . ' đ).'
            ], 400);
        }

        $discount = ($total * $voucher->discount_percent) / 100;

        return response()->json([
            'success' => true,
            'discount_percent' => $voucher->discount_percent,
            'discount_amount' => $discount,
            'new_total' => $total - $discount,
            'message' => 'Áp dụng mã giảm giá thành công!'
        ]);
    }
}
