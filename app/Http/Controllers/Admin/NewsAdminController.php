<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsAdminController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/news'), $imageName);
            $validated['image'] = '/images/news/'.$imageName;
        }

        $validated['slug'] = Str::slug($validated['title']);
        
        News::create($validated);

        return redirect()->route('admin.news.index')->with('success', 'Đã thêm tin tức thành công');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($news->image && file_exists(public_path($news->image))) {
                @unlink(public_path($news->image));
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/news'), $imageName);
            $validated['image'] = '/images/news/'.$imageName;
        }

        $validated['slug'] = Str::slug($validated['title']);
        
        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Đã cập nhật tin tức thành công');
    }

    public function destroy(News $news)
    {
        if ($news->image && file_exists(public_path($news->image))) {
            @unlink(public_path($news->image));
        }
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Đã xóa tin tức thành công');
    }
}
