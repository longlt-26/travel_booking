<!-- Chatbot Trigger Button -->
<div x-data="{ open: false, messages: [{ role: 'bot', text: 'Xin chào! Tôi là trợ lý ảo của BookingTravel. Tôi có thể giúp gì cho bạn?' }] }" class="fixed bottom-8 right-8 z-[999]">
    
    <!-- Chat Window -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90 translate-y-10"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-90 translate-y-10"
         class="absolute bottom-20 right-0 w-96 bg-white rounded-[2.5rem] shadow-2xl border border-slate-100 overflow-hidden flex flex-col h-[500px]">
        
        <!-- Header -->
        <div class="bg-blue-600 p-6 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                </div>
                <div>
                    <p class="font-black text-sm">Hỗ trợ trực tuyến</p>
                    <p class="text-[10px] text-blue-200 font-bold uppercase tracking-widest">Đang trực tuyến</p>
                </div>
            </div>
            <button @click="open = false" class="text-white/60 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Chat Content -->
        <div class="flex-grow p-6 overflow-y-auto space-y-4 bg-slate-50/50" id="chat-content">
            <template x-for="msg in messages">
                <div :class="msg.role === 'bot' ? 'flex justify-start' : 'flex justify-end'">
                    <div :class="msg.role === 'bot' ? 'bg-white text-slate-700 border border-slate-100 rounded-2xl rounded-tl-none' : 'bg-blue-600 text-white rounded-2xl rounded-tr-none'"
                         class="max-w-[80%] p-4 text-sm font-medium shadow-sm leading-relaxed"
                         x-text="msg.text">
                    </div>
                </div>
            </template>
        </div>

        <!-- Quick Suggestions -->
        <div class="px-6 py-4 bg-white border-t border-slate-100 flex flex-wrap gap-2">
            <template x-for="q in [
                {q: 'Giá tour thế nào?', r: 'Chào bạn! Giá các tour bên mình dao động từ 1.200.000đ đến 5.500.000đ tùy theo điểm đến và dịch vụ. Bạn đang quan tâm tour ở miền nào ạ?'},
                {q: 'Làm sao để đặt tour?', r: 'Bạn chỉ cần chọn tour mình thích, bấm nút Đặt ngay ở trang chi tiết, điền thông tin và thanh toán là xong nhé! Rất đơn giản ạ.'},
                {q: 'Có tour miền Bắc không?', r: 'Dạ có ạ! Bên mình có các tour Hà Giang, Sa Pa, Hạ Long, Tà Xùa đang rất hot. Bạn muốn xem danh sách không ạ?'},
                {q: 'Tư vấn trực tiếp', r: 'Vâng ạ! Bạn vui lòng để lại Số điện thoại hoặc gọi hotline 1900 8888 để nhân viên bên mình gọi lại tư vấn kỹ hơn nhé!'}
            ]">
                <button @click="
                    messages.push({ role: 'user', text: q.q });
                    $nextTick(() => { document.getElementById('chat-content').scrollTop = document.getElementById('chat-content').scrollHeight });
                    setTimeout(() => {
                        messages.push({ role: 'bot', text: q.r });
                        $nextTick(() => { document.getElementById('chat-content').scrollTop = document.getElementById('chat-content').scrollHeight });
                    }, 800);
                " class="text-[10px] font-black uppercase tracking-wider bg-slate-50 hover:bg-blue-50 hover:text-blue-600 border border-slate-100 rounded-lg px-3 py-2 transition-all">
                    <span x-text="q.q"></span>
                </button>
            </template>
        </div>

        <!-- Footer / Input -->
        <div class="p-4 bg-white border-t border-slate-100">
            <div class="relative">
                <input type="text" 
                       x-ref="userInput"
                       @keydown.enter="
                            const text = $refs.userInput.value.trim();
                            if(text) {
                                messages.push({ role: 'user', text: text });
                                $refs.userInput.value = '';
                                $nextTick(() => { document.getElementById('chat-content').scrollTop = document.getElementById('chat-content').scrollHeight });
                                
                                // Simple Bot Logic
                                setTimeout(() => {
                                    let reply = 'Cảm ơn bạn đã quan tâm! Bạn có thể để lại số điện thoại để nhân viên hỗ trợ trực tiếp được không?';
                                    if(text.toLowerCase().includes('giá')) reply = 'Giá tour bên mình dao động từ 1.000.000đ đến 5.000.000đ tùy dịch vụ. Bạn quan tâm tour nào ạ?';
                                    if(text.toLowerCase().includes('đặt')) reply = 'Bạn có thể đặt tour trực tiếp bằng nút Đặt ngay trong chi tiết mỗi tour nhé!';
                                    if(text.toLowerCase().includes('xin chào') || text.toLowerCase().includes('hi')) reply = 'Chào bạn! BookingTravel có thể giúp gì cho bạn hôm nay?';
                                    
                                    messages.push({ role: 'bot', text: reply });
                                    $nextTick(() => { document.getElementById('chat-content').scrollTop = document.getElementById('chat-content').scrollHeight });
                                }, 1000);
                            }
                       "
                       placeholder="Nhập tin nhắn..." 
                       class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm focus:ring-2 focus:ring-blue-600 focus:outline-none transition font-medium">
                <button class="absolute right-2 top-1/2 -translate-y-1/2 bg-blue-600 text-white p-2.5 rounded-xl hover:bg-blue-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Toggle Button -->
    <button @click="open = !open" 
            class="bg-blue-600 text-white w-16 h-16 rounded-full shadow-2xl flex items-center justify-center hover:bg-blue-700 transition-all hover:scale-110 active:scale-95 group relative">
        <div class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 border-2 border-white rounded-full"></div>
        <svg x-show="!open" class="w-8 h-8 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        <svg x-show="open" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
</div>
