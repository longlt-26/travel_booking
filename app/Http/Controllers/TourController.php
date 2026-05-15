<?php

namespace App\Http\Controllers;

use App\Models\Tour;
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

        // Lọc theo danh mục (Giả lập bằng location hoặc type nếu có)
        if ($request->has('category') && $request->get('category') !== 'all') {
            $query->where('location', 'like', "%" . $request->get('category') . "%");
        }

        $tours = $query->latest()->paginate(9);

        return view('welcome', compact('tours'));
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
        // Tìm tour có ID tương ứng, nếu không thấy sẽ báo lỗi 40   4
        $tour = Tour::findOrFail($id); 
        
        // Truyền dữ liệu sang file giao diện tours/show.blade.php
        return view('tours.show', compact('tour'));
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
