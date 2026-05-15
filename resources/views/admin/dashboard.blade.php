<x-admin-layout title="Tổng quan">
    <div class="space-y-10">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="card-stat bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-4 bg-blue-50 text-blue-600 rounded-2xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 7m0 10V7m0 0L9 4"></path></svg>
                    </div>
                </div>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-1">Tổng số Tour</p>
                <p class="text-4xl font-black text-slate-900">{{ $toursCount }}</p>
            </div>
            <div class="card-stat bg-white p-8 rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-4 bg-amber-50 text-amber-600 rounded-2xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-1">Lượt Booking</p>
                <p class="text-4xl font-black text-slate-900">{{ $bookingsCount }}</p>
            </div>
            <div class="card-stat bg-blue-600 p-8 rounded-[2.5rem] shadow-2xl shadow-blue-200 border border-blue-500 text-white">
                <div class="flex justify-between items-start mb-6">
                    <div class="p-4 bg-white/20 rounded-2xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <p class="text-blue-100 text-[10px] font-black uppercase tracking-widest mb-1">Thanh toán thành công</p>
                <p class="text-4xl font-black text-white">{{ $paidBookingsCount }}</p>
            </div>
        </div>

        <!-- Recent Bookings Table -->
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                <h3 class="text-xl font-black text-slate-900">Danh sách đặt Tour mới nhất</h3>
                <a href="{{ route('admin.bookings.index') }}" class="text-blue-600 font-black text-sm hover:underline flex items-center gap-2">
                    Xem tất cả
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                            <th class="px-8 py-6">Mã đơn</th>
                            <th class="px-8 py-6">Khách hàng</th>
                            <th class="px-8 py-6">Tour</th>
                            <th class="px-8 py-6 text-right">Tổng tiền</th>
                            <th class="px-8 py-6">Trạng thái</th>
                            <th class="px-8 py-6 text-right">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($latestBookings as $b)
                        <tr class="group hover:bg-slate-50 transition">
                            <td class="px-8 py-6 font-black text-slate-900 text-sm">#{{ $b->id }}</td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center font-black text-xs">
                                        {{ strtoupper(substr($b->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <span class="text-sm font-black text-slate-800">{{ $b->user->name }}</span>
                                        <p class="text-[10px] text-slate-400 font-bold">{{ $b->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-bold text-slate-600">{{ $b->tour->title ?? 'N/A' }}</span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="font-black text-slate-900 text-sm">{{ number_format($b->total_amount, 0, ',', '.') }} đ</div>
                                <div class="text-[10px] text-slate-400 font-bold uppercase">{{ $b->quantity }} người</div>
                            </td>
                            <td class="px-8 py-6">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                        'processing' => 'bg-blue-50 text-blue-600 border-blue-100',
                                        'paid' => 'bg-green-50 text-green-600 border-green-100',
                                        'failed' => 'bg-red-50 text-red-600 border-red-100',
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border {{ $statusClasses[$b->status] ?? 'bg-slate-50 text-slate-400' }}">
                                    {{ $b->status === 'paid' ? 'Thành công' : ($b->status === 'pending' ? 'Chờ thanh toán' : $b->status) }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <button onclick="openEditModal({{ $b->id }}, '{{ $b->status }}', '{{ $b->payment_provider }}', '{{ $b->payment_reference }}')" 
                                        class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Modal (Synced from index) -->
    <div id="editModal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md p-6">
            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-100">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-black text-slate-900">Sửa trạng thái đơn</h3>
                        <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <form id="editForm" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Trạng thái thanh toán</label>
                                <select name="status" id="modalStatus" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition">
                                    <option value="pending">Chờ thanh toán</option>
                                    <option value="processing">Đang xử lý</option>
                                    <option value="paid">Đã thanh toán thành công</option>
                                    <option value="failed">Thất bại / Đã hủy</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Phương thức thanh toán</label>
                                <input type="text" name="payment_provider" id="modalProvider" placeholder="VD: Ngân hàng MB" 
                                       class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Mã giao dịch (Reference)</label>
                                <input type="text" name="payment_reference" id="modalReference" placeholder="VD: MB12345678" 
                                       class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold focus:ring-2 focus:ring-blue-600/20 transition">
                            </div>

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl transition-all shadow-xl shadow-blue-200 active:scale-95 mt-4">
                                Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function openEditModal(id, status, provider, reference) {
            const form = document.getElementById('editForm');
            form.action = `/admin/bookings/${id}/status`;
            
            document.getElementById('modalStatus').value = status;
            document.getElementById('modalProvider').value = provider || '';
            document.getElementById('modalReference').value = reference || '';
            
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
    @endpush
</x-admin-layout>
