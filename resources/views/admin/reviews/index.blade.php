<x-admin-layout title="Quản lý Bình luận & Đánh giá">
    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <div class="p-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-50">
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Người dùng</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Tour</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Đánh giá</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Nội dung</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Trạng thái</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($reviews as $review)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="py-6">
                                    <div class="font-black text-slate-900 text-sm">{{ $review->user->name }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $review->user->email }}</div>
                                </td>
                                <td class="py-6">
                                    <div class="font-bold text-slate-700 text-xs">{{ $review->tour->title }}</div>
                                </td>
                                <td class="py-6">
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-3 h-3 {{ $i <= $review->rating ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                    </div>
                                </td>
                                <td class="py-6 max-w-xs">
                                    <p class="text-xs text-slate-600 line-clamp-2 italic">"{{ $review->comment }}"</p>
                                </td>
                                <td class="py-6">
                                    <form action="{{ route('admin.reviews.updateStatus', $review) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" 
                                                class="text-[10px] font-black uppercase border-none rounded-full px-3 py-1 cursor-pointer
                                                {{ $review->status === 'approved' ? 'bg-green-50 text-green-600' : ($review->status === 'pending' ? 'bg-amber-50 text-amber-600' : 'bg-red-50 text-red-600') }}">
                                            <option value="approved" {{ $review->status === 'approved' ? 'selected' : '' }}>Hiển thị</option>
                                            <option value="pending" {{ $review->status === 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                                            <option value="hidden" {{ $review->status === 'hidden' ? 'selected' : '' }}>Ẩn</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="py-6">
                                    <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="delete-btn p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-10">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Xóa bình luận?',
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
