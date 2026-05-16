<x-admin-layout title="Quản lý Tin tức">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-black text-slate-900">Danh sách Tin tức</h2>
            <p class="text-slate-500 text-sm">Quản lý các bài viết blog và tin tức du lịch</p>
        </div>
        <a href="{{ route('admin.news.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-black shadow-lg shadow-blue-200 transition-all active:scale-95 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Thêm tin tức mới
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <div class="p-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-50">
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Hình ảnh</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Tiêu đề</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Danh mục</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Ngày đăng</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($news as $item)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="py-6">
                                    <img src="{{ $item->image ?? 'https://via.placeholder.com/150' }}" class="w-16 h-12 object-cover rounded-xl shadow-sm">
                                </td>
                                <td class="py-6">
                                    <div class="font-black text-slate-900 text-sm line-clamp-1">{{ $item->title }}</div>
                                    <div class="text-[10px] text-slate-400 italic">/news/{{ $item->slug }}</div>
                                </td>
                                <td class="py-6">
                                    <span class="bg-blue-50 text-blue-600 text-[10px] font-black px-3 py-1 rounded-full uppercase">{{ $item->category ?? 'N/A' }}</span>
                                </td>
                                <td class="py-6">
                                    <div class="text-xs text-slate-600 font-bold">{{ $item->created_at->format('d/m/Y') }}</div>
                                </td>
                                <td class="py-6">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.news.edit', $item) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="delete-btn p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-8">
                {{ $news->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Xóa tin tức?',
                    text: "Bạn không thể hoàn tác hành động này!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Xóa ngay',
                    cancelButtonText: 'Hủy',
                    background: '#ffffff',
                    borderRadius: '1.5rem',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    </script>
    @endpush
</x-admin-layout>
