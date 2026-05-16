<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class CategoryAdminController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->back()->with('success', 'Thêm danh mục thành công');
    }

    public function update(Request $request, Category $category)
    {
        $this->authorizeAdmin();
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);
        return redirect()->back()->with('success', 'Cập nhật danh mục thành công');
    }

    public function destroy(Category $category)
    {
        $this->authorizeAdmin();
        
        if ($category->tours()->count() > 0) {
            return redirect()->back()->with('error', 'Không thể xóa danh mục đang có tour');
        }

        $category->delete();
        return redirect()->back()->with('success', 'Xóa danh mục thành công');
    }

    private function authorizeAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()?->role === 'admin', 403);
    }
}
