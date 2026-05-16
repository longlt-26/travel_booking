<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourAdminController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $tours = Tour::with('category')->latest()->paginate(10);
        return view('admin.tours.index', compact('tours'));
    }

    public function create()
    {
        $this->authorizeAdmin();

        $categories = Category::all();
        return view('admin.tours.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'max_people' => ['required', 'integer', 'min:1'],
            'location' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'string'],
            'region' => ['required', 'string', 'in:north,central,south'],
        ]);

        $tour = Tour::create($validated);

        return redirect()->route('admin.tours.index')->with('success', 'Tạo tour thành công');
    }

    public function edit(Tour $tour)
    {
        $this->authorizeAdmin();

        $categories = Category::all();
        return view('admin.tours.edit', compact('tour', 'categories'));
    }

    public function update(Request $request, Tour $tour)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'max_people' => ['required', 'integer', 'min:1'],
            'location' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'string'],
            'region' => ['required', 'string', 'in:north,central,south'],
        ]);

        $tour->update($validated);

        return redirect()->route('admin.tours.index')->with('success', 'Cập nhật tour thành công');
    }

    public function destroy(Tour $tour)
    {
        $this->authorizeAdmin();

        $tour->delete();

        return redirect()->route('admin.tours.index')->with('success', 'Xóa tour thành công');
    }

private function authorizeAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()?->role === 'admin', 403);
    }

}

