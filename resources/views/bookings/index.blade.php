<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="container mx-auto px-6 max-w-7xl">
            
            <div class="mb-10 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 mb-2">Hành trình của tôi</h2>
                    <p class="text-slate-500">Xem và quản lý tất cả các tour bạn đã đặt.</p>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-bold text-slate-400 uppercase tracking-widest">Tổng đơn: {{ $bookings->total() }}</span>
                </div>
            </div>

            @if($bookings->isEmpty())
                <div class="bg-white rounded-[3rem] p-20 text-center shadow-sm border border-slate-100">
                    <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2">Chưa có tour nào</h3>
                    <p class="text-slate-500 mb-8">Bạn chưa đặt bất kỳ chuyến du lịch nào. Hãy khám phá ngay!</p>
                    <a href="{{ route('tours.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-2xl font-black shadow-xl transition-all inline-block">Khám phá tour</a>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6">
                    @foreach($bookings as $booking)
                        <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 flex flex-col md:flex-row items-center gap-8 group hover:border-blue-200 transition-all duration-500">
                            <!-- Tour Image -->
                            <div class="w-full md:w-48 h-32 rounded-3xl overflow-hidden flex-shrink-0">
                                <img src="{{ $booking->tour->image ?? 'https://placehold.co/400x300?text=Tour+Anh' }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $booking->tour->title }}">
                            </div>

                            <!-- Tour Info -->
                            <div class="flex-grow">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                                        {{ $booking->tour->location }}
                                    </span>
                                    <span class="text-xs text-slate-400 font-medium">Đặt ngày: {{ $booking->created_at->format('d/m/Y') }}</span>
                                </div>
                                <h3 class="text-xl font-black text-slate-900 mb-1 group-hover:text-blue-600 transition">{{ $booking->tour->title }}</h3>
                                <div class="flex items-center gap-2 text-slate-400 text-xs font-bold uppercase tracking-widest">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Ngày khởi hành: {{ $booking->departure_date ? $booking->departure_date->format('d/m/Y') : 'Chưa xác định' }}
                                </div>
                                <div class="flex items-center gap-2 text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    Số lượng: {{ $booking->quantity }} khách
                                </div>
                            </div>

                            <!-- Payment & Status -->
                            <div class="w-full md:w-auto text-center md:text-right flex flex-col gap-2">
                                <p class="text-2xl font-black text-slate-900">{{ number_format($booking->total_amount, 0, ',', '.') }} <small class="text-sm">đ</small></p>
                                
                                <div class="flex items-center justify-center md:justify-end gap-2">
                                    @if($booking->status === 'paid')
                                        <span class="flex items-center gap-1.5 px-4 py-1.5 bg-green-50 text-green-600 rounded-full text-xs font-black uppercase tracking-wider border border-green-100">
                                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                            Đã thanh toán
                                        </span>
                                    @elseif($booking->status === 'pending')
                                        <span class="flex items-center gap-1.5 px-4 py-1.5 bg-orange-50 text-orange-600 rounded-full text-xs font-black uppercase tracking-wider border border-orange-100">
                                            <span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></span>
                                            Chờ thanh toán
                                        </span>
                                    @else
                                        <span class="flex items-center gap-1.5 px-4 py-1.5 bg-red-50 text-red-600 rounded-full text-xs font-black uppercase tracking-wider border border-red-100">
                                            Thất bại
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Action -->
                            <div class="flex-shrink-0">
                                @if($booking->status === 'pending')
                                    <a href="{{ route('bookings.pay', $booking) }}" class="bg-slate-900 hover:bg-blue-600 text-white px-6 py-3 rounded-2xl font-black text-sm transition-all shadow-xl">
                                        Thanh toán ngay
                                    </a>
                                @else
                                    <a href="{{ route('bookings.show', $booking->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-black text-sm transition-all shadow-xl">
                                        Xem chi tiết
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
