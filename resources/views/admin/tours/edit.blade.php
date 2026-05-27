<x-admin-layout title="Chỉnh sửa Tour">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="p-10">
                <form method="POST" action="{{ route('admin.tours.update', $tour) }}" class="space-y-8" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Title -->
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Tên Tour du lịch</label>
                            <input type="text" name="title" value="{{ old('title', $tour->title) }}" required
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition-all placeholder-slate-300"
                                placeholder="VD: Tour Du Lịch Đà Nẵng - Hội An 4 ngày 3 đêm">
                            @error('title')<p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>@enderror
                        </div>

                        <!-- Category -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Danh mục</label>
                            <select name="category_id" required
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition-all cursor-pointer">
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}" {{ old('category_id', $tour->category_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>@enderror
                        </div>

                        <!-- Price -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Giá vé (VNĐ)</label>
                            <input type="number" name="price" value="{{ old('price', $tour->price) }}" required
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition-all placeholder-slate-300"
                                placeholder="VD: 5000000">
                            @error('price')<p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>@enderror
                        </div>

                        <!-- Max People -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Sức chứa tối đa</label>
                            <input type="number" name="max_people" value="{{ old('max_people', $tour->max_people) }}" required
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition-all placeholder-slate-300"
                                placeholder="VD: 20">
                            @error('max_people')<p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>@enderror
                        </div>

                        <!-- Region -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Khu vực (Miền)</label>
                            <select name="region" required
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition-all cursor-pointer">
                                <option value="north" {{ old('region', $tour->region) == 'north' ? 'selected' : '' }}>Miền Bắc</option>
                                <option value="central" {{ old('region', $tour->region) == 'central' ? 'selected' : '' }}>Miền Trung</option>
                                <option value="south" {{ old('region', $tour->region) == 'south' ? 'selected' : '' }}>Miền Nam</option>
                            </select>
                            @error('region')<p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>@enderror
                        </div>

                        <!-- Location -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Địa điểm</label>
                            <input type="text" name="location" value="{{ old('location', $tour->location) }}" required
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition-all placeholder-slate-300"
                                placeholder="VD: Đà Nẵng, Việt Nam">
                            @error('location')<p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>@enderror
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Mô tả chi tiết</label>
                            <textarea name="description" rows="6" required
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition-all placeholder-slate-300"
                                placeholder="Nhập mô tả chi tiết về lịch trình, dịch vụ đi kèm...">{{ old('description', $tour->description) }}</textarea>
                            @error('description')<p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>@enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Ảnh đại diện</label>
                            <div class="relative group">
                                <input type="file" name="image" accept="image/*" class="hidden" id="imageInput">
                                <label for="imageInput" class="flex items-center gap-6 w-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl p-6 cursor-pointer hover:border-blue-600 transition-all overflow-hidden relative">
                                    <div class="w-24 h-24 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0 border border-slate-200 flex items-center justify-center">
                                        @if($tour->image)
                                            <img id="imagePreview" src="{{ $tour->image }}" class="w-full h-full object-cover">
                                        @else
                                            <svg id="placeholderIcon" class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <img id="imagePreview" class="w-full h-full object-cover hidden">
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-slate-500 group-hover:text-blue-600 transition">
                                            {{ $tour->image ? 'Nhấn để thay đổi ảnh' : 'Nhấn để tải ảnh lên' }}
                                        </p>
                                        <p class="text-xs text-slate-400 mt-1">PNG, JPG hoặc GIF (Tối đa 2MB)</p>
                                        @if($tour->image)
                                            <p class="text-xs text-slate-300 mt-1 truncate max-w-xs">{{ basename($tour->image) }}</p>
                                        @endif
                                    </div>
                                </label>
                            </div>
                            @error('image')<p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="pt-6 flex items-center gap-4 border-t border-slate-50">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-blue-200 transition-all active:scale-95">
                            Cập nhật Tour
                        </button>
                        <a href="{{ route('admin.tours.index') }}" class="px-10 py-4 rounded-2xl font-black text-slate-400 hover:bg-slate-50 transition-all">
                            Hủy bỏ
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('imagePreview');
                    preview.src = event.target.result;
                    preview.classList.remove('hidden');
                    const icon = document.getElementById('placeholderIcon');
                    if (icon) icon.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-admin-layout>
