<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Review;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Tour::query();

        // Tìm kiếm theo từ khóa
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Lọc theo khu vực (Miền)
        if ($request->has('category') && $request->get('category') !== 'all') {
            $query->where('region', $request->get('category'));
        }

        $tours = $query->latest()->paginate(9);

        // Lấy 10 đánh giá tiêu biểu (từ 4 sao trở lên) để làm slider
        $testimonials = Review::with(['user', 'tour'])
            ->where('status', 'approved')
            ->where('rating', '>=', 4)
            ->latest()
            ->take(10)
            ->get();

        return view('welcome', compact('tours', 'testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Tìm tour có ID tương ứng, nếu không thấy sẽ báo lỗi 404
        $tour = Tour::findOrFail($id); 
        
        // --- 2. Hệ thống Gợi ý (Recommendation Engine) ---
        // Lấy các tour có cùng khu vực (region) hoặc mức giá tương đương, trừ tour hiện tại.
        // Đây là thuật toán Content-Based Filtering cơ bản.
        $recommendedTours = Tour::where('id', '!=', $tour->id)
            ->where(function ($query) use ($tour) {
                $query->where('region', $tour->region)
                      ->orWhereBetween('price', [$tour->price * 0.8, $tour->price * 1.2]);
            })
            ->inRandomOrder()
            ->take(3)
            ->get();

        // Truyền dữ liệu sang file giao diện tours/show.blade.php
        return view('tours.show', compact('tour', 'recommendedTours'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tour $tour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        //
    }
}
