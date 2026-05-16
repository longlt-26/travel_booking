<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="container mx-auto px-6 max-w-4xl">
            
            <div class="mb-10 flex items-center justify-between">
                <a href="{{ route('bookings.index') }}" class="flex items-center gap-2 text-slate-500 hover:text-blue-600 font-bold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Quay lại danh sách
                </a>
                <div class="flex gap-3">
                    <button onclick="window.print()" class="bg-white border border-slate-200 text-slate-600 px-6 py-2.5 rounded-2xl font-bold hover:bg-slate-50 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        In Voucher
                    </button>
                </div>
            </div>

            <!-- Ticket / Voucher UI -->
            <div class="bg-white rounded-[3rem] overflow-hidden shadow-2xl shadow-blue-900/5 border border-slate-100 relative">
                <!-- Top Badge -->
                <div class="absolute top-0 left-1/2 -translate-x-1/2 px-8 py-2 bg-blue-600 text-white rounded-b-3xl text-[10px] font-black uppercase tracking-[0.3em] shadow-lg">
                    Official Travel Voucher
                </div>

                <div class="p-12 md:p-20">
                    <div class="flex flex-col md:flex-row justify-between items-start gap-12 border-b border-dashed border-slate-200 pb-12 mb-12">
                        <div class="space-y-6">
                            <div>
                                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Trạng thái đặt tour</span>
                                <div class="mt-2">
                                    @if($booking->status === 'paid')
                                        <span class="inline-flex items-center gap-2 px-6 py-2 bg-green-50 text-green-600 rounded-full text-sm font-black uppercase tracking-widest border border-green-100">
                                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                            Đã xác nhận
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 px-6 py-2 bg-orange-50 text-orange-600 rounded-full text-sm font-black uppercase tracking-widest border border-orange-100">
                                            Chờ thanh toán
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Mã Tour</span>
                                <p class="text-3xl font-black text-slate-900 mt-1 tracking-tighter">BT-{{ strtoupper(substr(md5($booking->id), 0, 8)) }}</p>
                            </div>
                        </div>

                        <div class="text-right space-y-6">
                            <div>
                                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Ngày đặt</span>
                                <p class="text-lg font-black text-slate-900 mt-1">{{ $booking->created_at->format('d/m/Y') }}</p>
                            </div>
                            <div>
                                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Khách hàng</span>
                                <p class="text-lg font-black text-slate-900 mt-1">{{ auth()->user()->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-center">
                        <div class="md:col-span-2 space-y-8">
                            <div class="flex gap-6 items-start">
                                <div class="w-24 h-24 rounded-3xl overflow-hidden flex-shrink-0 shadow-sm border border-slate-100">
                                    <img src="{{ $booking->tour->image ?? 'https://images.unsplash.com/photo-1528127269322-539801943592?q=80&w=1000' }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h3 class="text-2xl font-black text-slate-900 leading-tight mb-2">{{ $booking->tour->title }}</h3>
                                    <div class="flex items-center gap-2 text-slate-400 font-bold text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12m0 0l4.243-4.243m-4.243 4.243L9.172 7.757m4.243 4.243l-4.243 4.243m4.243-4.243H3"></path></svg>
                                        {{ $booking->tour->location }}
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-8 bg-slate-50 p-8 rounded-3xl">
                                <div>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Ngày khởi hành</span>
                                    <p class="text-xl font-black text-slate-900">{{ $booking->departure_date ? $booking->departure_date->format('d/m/Y') : 'Chưa xác định' }}</p>
                                </div>
                                <div>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Số khách</span>
                                    <p class="text-xl font-black text-slate-900">{{ $booking->quantity }} người</p>
                                </div>
                                <div class="md:text-right">
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Tổng thanh toán</span>
                                    <p class="text-xl font-black text-blue-600">{{ number_format($booking->total_amount, 0, ',', '.') }} đ</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col items-center justify-center p-8 border-l border-slate-100 border-dashed">
                            <div class="w-32 h-32 bg-slate-100 rounded-2xl flex flex-col items-center justify-center border-2 border-dashed border-slate-200">
                                <svg class="w-16 h-16 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M3 11h8V3H3v8zm2-6h4v4H5V5zM3 21h8v-8H3v8zm2-6h4v4H5v-4zM13 3v8h8V3h-8zm6 6h-4V5h4v4zM13 13h2v2h-2zM15 15h2v2h-2zM13 17h2v2h-2zM17 13h2v2h-2zM19 15h2v2h-2zM17 17h2v2h-2zM15 19h2v2h-2zM19 19h2v2h-2zM13 15h2v2h-2zM15 13h2v2h-2zM17 15h2v2h-2zM13 19h2v2h-2z"></path></svg>
                                <span class="text-[8px] text-slate-400 font-black uppercase tracking-widest mt-2">Voucher Scan</span>
                            </div>
                            <p class="text-xs text-slate-400 mt-4 text-center leading-relaxed">Xuất trình mã này khi tham gia tour để xác nhận.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-900 p-8 text-center">
                    <p class="text-white/40 text-[10px] font-black uppercase tracking-[0.3em]">Cảm ơn bạn đã tin tưởng BookingTravel</p>
                </div>
            </div>
            
            <div class="mt-12 text-center text-slate-400 text-sm italic">
                Lưu ý: Voucher này có giá trị thay thế vé tham quan. Vui lòng không chia sẻ mã Voucher cho người lạ.
            </div>
        </div>
    </div>
</x-app-layout>
