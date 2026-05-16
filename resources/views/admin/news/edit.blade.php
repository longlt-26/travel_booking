<x-admin-layout title="Chỉnh sửa Tin tức">
    <div class="mb-8">
        <a href="{{ route('admin.news.index') }}" class="text-slate-400 hover:text-blue-600 font-bold flex items-center gap-2 transition mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Quay lại danh sách
        </a>
        <h2 class="text-3xl font-black text-slate-900">Chỉnh sửa bài viết</h2>
    </div>

    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        @method('PUT')
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tiêu đề bài viết</label>
                    <input type="text" name="title" value="{{ $news->title }}" required placeholder="Nhập tiêu đề hấp dẫn..." 
                           class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl px-6 py-4 text-lg font-bold focus:border-blue-600 focus:outline-none transition">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tóm tắt ngắn</label>
                    <textarea name="summary" rows="3" placeholder="Mô tả ngắn gọn nội dung bài viết..."
                              class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl px-6 py-4 focus:border-blue-600 focus:outline-none transition font-medium">{{ $news->summary }}</textarea>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nội dung chi tiết</label>
                    <textarea name="content" rows="15" required placeholder="Viết nội dung bài viết ở đây..."
                              class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl px-6 py-4 focus:border-blue-600 focus:outline-none transition font-medium">{{ $news->content }}</textarea>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 space-y-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Hình ảnh đại diện</label>
                    <div class="relative group">
                        <input type="file" name="image" accept="image/*" class="hidden" id="imageInput">
                        <label for="imageInput" class="block w-full aspect-video bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl cursor-pointer hover:border-blue-600 transition-all overflow-hidden relative">
                            @if($news->image)
                                <img id="preview" src="{{ $news->image }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-white bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity" id="placeholder">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-xs font-black uppercase">Thay đổi ảnh</span>
                                </div>
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-400 group-hover:text-blue-600" id="placeholder">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-xs font-black uppercase">Tải ảnh lên</span>
                                </div>
                                <img id="preview" class="w-full h-full object-cover hidden">
                            @endif
                        </label>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Danh mục</label>
                    <select name="category" class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl px-6 py-4 font-bold focus:border-blue-600 focus:outline-none transition">
                        <option value="Kinh nghiệm" {{ $news->category === 'Kinh nghiệm' ? 'selected' : '' }}>Kinh nghiệm</option>
                        <option value="Cẩm nang" {{ $news->category === 'Cẩm nang' ? 'selected' : '' }}>Cẩm nang</option>
                        <option value="Ẩm thực" {{ $news->category === 'Ẩm thực' ? 'selected' : '' }}>Ẩm thực</option>
                        <option value="Sự kiện" {{ $news->category === 'Sự kiện' ? 'selected' : '' }}>Sự kiện</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-blue-200 transition-all active:scale-95">
                    Cập nhật bài viết
                </button>
            </div>
        </div>
    </form>

    <script>
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('preview').src = event.target.result;
                    document.getElementById('preview').classList.remove('hidden');
                    document.getElementById('placeholder').classList.add('opacity-100');
                    document.getElementById('placeholder').classList.add('bg-black/40');
                    document.getElementById('placeholder').innerHTML = '<svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg><span class="text-xs font-black uppercase">Thay đổi ảnh</span>';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-admin-layout>
