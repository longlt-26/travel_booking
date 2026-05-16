<x-admin-layout title="Thêm Tour Mới">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="p-10">
                <form method="POST" action="{{ route('admin.tours.store') }}" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Title -->
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Tên Tour du lịch</label>
                            <input type="text" name="title" value="{{ old('title') }}" required
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
                                    <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>@enderror
                        </div>

                        <!-- Price -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Giá vé (VNĐ)</label>
                            <input type="number" name="price" value="{{ old('price') }}" required
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition-all placeholder-slate-300"
                                placeholder="VD: 5000000">
                            @error('price')<p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>@enderror
                        </div>

                        <!-- Max People -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Sức chứa tối đa</label>
                            <input type="number" name="max_people" value="{{ old('max_people') }}" required
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition-all placeholder-slate-300"
                                placeholder="VD: 20">
                            @error('max_people')<p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>@enderror
                        </div>

                        <!-- Region -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Khu vực (Miền)</label>
                            <select name="region" required
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition-all cursor-pointer">
                                <option value="north" {{ old('region') == 'north' ? 'selected' : '' }}>Miền Bắc</option>
                                <option value="central" {{ old('region') == 'central' ? 'selected' : '' }}>Miền Trung</option>
                                <option value="south" {{ old('region') == 'south' ? 'selected' : '' }}>Miền Nam</option>
                            </select>
                            @error('region')<p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>@enderror
                        </div>

                        <!-- Location -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Địa điểm</label>
                            <input type="text" name="location" value="{{ old('location') }}" required
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition-all placeholder-slate-300"
                                placeholder="VD: Đà Nẵng, Việt Nam">
                            @error('location')<p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>@enderror
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Mô tả chi tiết</label>
                            <textarea name="description" rows="6" required
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition-all placeholder-slate-300"
                                placeholder="Nhập mô tả chi tiết về lịch trình, dịch vụ đi kèm...">{{ old('description') }}</textarea>
                            @error('description')<p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>@enderror
                        </div>

                        <!-- Image URL -->
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Ảnh đại diện (URL)</label>
                            <input type="text" name="image" value="{{ old('image') }}"
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition-all placeholder-slate-300"
                                placeholder="https://images.unsplash.com/...">
                            @error('image')<p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="pt-6 flex items-center gap-4 border-t border-slate-50">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-blue-200 transition-all active:scale-95">
                            Lưu dữ liệu
                        </button>
                        <a href="{{ route('admin.tours.index') }}" class="px-10 py-4 rounded-2xl font-black text-slate-400 hover:bg-slate-50 transition-all">
                            Hủy bỏ
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
