<x-admin-layout title="Quản lý Tour">
    <div class="mb-8 flex justify-end">
        <a href="{{ route('admin.tours.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-black shadow-xl shadow-blue-200 transition-all active:scale-95 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Thêm Tour Mới
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <div class="p-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-50">
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Thông tin Tour</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Địa điểm</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Giá vé</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Sức chứa</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($tours as $tour)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-sm border border-slate-100 flex-shrink-0">
                                            <img src="{{ $tour->image ?? 'https://placehold.co/100x100?text=Tour' }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <div class="font-black text-slate-900 group-hover:text-blue-600 transition">{{ $tour->title }}</div>
                                            <div class="text-xs text-slate-400 mt-1">ID: #{{ $tour->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-6">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-bold">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12m0 0l4.243-4.243m-4.243 4.243L9.172 7.757m4.243 4.243l-4.243 4.243m4.243-4.243H3"></path></svg>
                                        {{ $tour->location }}
                                    </span>
                                </td>
                                <td class="py-6">
                                    <div class="font-black text-slate-900">{{ number_format($tour->price, 0, ',', '.') }} đ</div>
                                </td>
                                <td class="py-6">
                                    <div class="flex items-center gap-1.5 text-slate-500 font-bold text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        {{ $tour->max_people }} người
                                    </div>
                                </td>
                                <td class="py-6">
                                    <div class="flex items-center gap-2 justify-end">
                                        <a href="{{ route('admin.tours.edit', $tour) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.tours.destroy', $tour) }}" method="POST" class="delete-form">
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

            <div class="mt-10">
                {{ $tours->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Xác nhận xóa?',
                    text: "Tour này sẽ bị gỡ bỏ vĩnh viễn!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Đồng ý xóa',
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
