<x-admin-layout title="Quản lý Người dùng">
    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <div class="p-8">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-50">
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Người dùng</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Email</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Vai trò</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Ngày tham gia</th>
                            <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($users as $user)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-black text-xs shadow-lg shadow-blue-200">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div class="font-black text-slate-900">{{ $user->name }}</div>
                                    </div>
                                </td>
                                <td class="py-6">
                                    <div class="text-sm font-bold text-slate-600">{{ $user->email }}</div>
                                </td>
                                <td class="py-6">
                                    <form action="{{ route('admin.users.updateRole', $user) }}" method="POST" class="role-form">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" onchange="this.form.submit()" 
                                                class="bg-slate-100 border-none rounded-xl px-4 py-2 text-[10px] font-black uppercase tracking-widest cursor-pointer focus:ring-2 focus:ring-blue-600/20 transition-all {{ $user->role === 'admin' ? 'text-blue-600' : 'text-slate-500' }}">
                                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="py-6">
                                    <div class="text-xs text-slate-400 font-bold">{{ $user->created_at->format('d/m/Y') }}</div>
                                </td>
                                <td class="py-6">
                                    <div class="flex items-center gap-2 justify-end">
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete-btn p-2 text-slate-300 hover:text-red-600 hover:bg-red-50 rounded-xl transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest mr-2">Đang đăng nhập</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-10">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Xóa người dùng?',
                    text: "Mọi dữ liệu liên quan sẽ bị xóa và không thể khôi phục!",
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
