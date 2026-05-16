<x-admin-layout title="Tạo Mã khuyến mãi">
    <div class="mb-8">
        <a href="{{ route('admin.vouchers.index') }}" class="text-slate-400 hover:text-blue-600 font-bold flex items-center gap-2 transition mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Quay lại danh sách
        </a>
        <h2 class="text-3xl font-black text-slate-900">Thêm chương trình khuyến mãi</h2>
    </div>

    <form action="{{ route('admin.vouchers.store') }}" method="POST" class="max-w-3xl">
        @csrf
        <div class="bg-white p-10 rounded-[3rem] shadow-xl shadow-slate-200/50 border border-slate-100 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Mã Voucher</label>
                    <input type="text" name="code" required placeholder="Ví dụ: SUMMER2026" 
                           class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl px-6 py-4 text-lg font-black text-blue-600 focus:border-blue-600 focus:outline-none transition uppercase">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Phần trăm giảm (%)</label>
                    <input type="number" name="discount_percent" min="1" max="100" required placeholder="Ví dụ: 15" 
                           class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl px-6 py-4 text-lg font-black focus:border-blue-600 focus:outline-none transition">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Giá trị đơn hàng tối thiểu (VNĐ)</label>
                <input type="number" name="min_amount" value="0" required 
                       class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl px-6 py-4 text-lg font-black focus:border-blue-600 focus:outline-none transition">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Ngày bắt đầu</label>
                    <input type="datetime-local" name="start_date" required 
                           class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl px-6 py-4 font-bold focus:border-blue-600 focus:outline-none transition">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Ngày kết thúc</label>
                    <input type="datetime-local" name="end_date" required 
                           class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl px-6 py-4 font-bold focus:border-blue-600 focus:outline-none transition">
                </div>
            </div>

            <div class="flex items-center gap-4 p-6 bg-slate-50 rounded-2xl">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" checked id="is_active" class="w-6 h-6 rounded-lg border-2 border-slate-200 text-blue-600 focus:ring-blue-600">
                <label for="is_active" class="text-sm font-black text-slate-700">Kích hoạt mã khuyến mãi ngay</label>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-blue-200 transition-all active:scale-95 text-lg">
                Lưu chương trình khuyến mãi
            </button>
        </div>
    </form>
</x-admin-layout>
