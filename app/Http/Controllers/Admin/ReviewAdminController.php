<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewAdminController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
        $reviews = Review::with(['user', 'tour'])->latest()->paginate(20);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function destroy(Review $review)
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
        $review->delete();
        return redirect()->back()->with('success', 'Đã xóa bình luận thành công');
    }

    public function updateStatus(Request $request, Review $review)
    {
        abort_unless(auth()->user()?->role === 'admin', 403);
        $validated = $request->validate([
            'status' => 'required|in:approved,pending,hidden',
        ]);

        $review->update(['status' => $validated['status']]);
        return redirect()->back()->with('success', 'Cập nhật trạng thái bình luận thành công');
    }
}
