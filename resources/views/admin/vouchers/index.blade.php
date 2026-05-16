<x-admin-layout title="Quản lý Khuyến mãi">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-black text-slate-900">Danh sách Mã khuyến mãi</h2>
            <p class="text-slate-500 text-sm">Cài đặt các chương trình giảm giá và voucher</p>
        </div>
        <a href="{{ route('admin.vouchers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-black shadow-lg shadow-blue-200 transition-all active:scale-95 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tạo mã mới
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <div class="p-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-50">
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Mã</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Giảm (%)</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Đơn tối thiểu</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Thời hạn</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Trạng thái</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($vouchers as $voucher)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="py-6">
                                    <span class="font-black text-blue-600 bg-blue-50 px-4 py-2 rounded-xl border border-blue-100 uppercase tracking-widest text-sm">{{ $voucher->code }}</span>
                                </td>
                                <td class="py-6">
                                    <div class="font-black text-slate-900 text-lg">{{ $voucher->discount_percent }}%</div>
                                </td>
                                <td class="py-6">
                                    <div class="text-xs font-bold text-slate-600">{{ number_format($voucher->min_amount, 0, ',', '.') }} đ</div>
                                </td>
                                <td class="py-6">
                                    <div class="text-[10px] text-slate-400 uppercase font-bold mb-1">Từ: {{ $voucher->start_date->format('d/m/Y H:i') }}</div>
                                    <div class="text-[10px] text-red-400 uppercase font-bold">Đến: {{ $voucher->end_date->format('d/m/Y H:i') }}</div>
                                </td>
                                <td class="py-6">
                                    @php
                                        $isCurrent = $voucher->isCurrent();
                                    @endphp
                                    <span class="text-[10px] font-black uppercase px-3 py-1 rounded-full {{ $isCurrent ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                                        {{ $isCurrent ? 'Đang chạy' : 'Hết hạn/Tắt' }}
                                    </span>
                                </td>
                                <td class="py-6">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.vouchers.edit', $voucher) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" class="delete-form">
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
                {{ $vouchers->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Xóa mã khuyến mãi?',
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
