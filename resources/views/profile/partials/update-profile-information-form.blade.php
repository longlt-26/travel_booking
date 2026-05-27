<section class="space-y-6">
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-8" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="space-y-6">
            <!-- Avatar -->
            <div class="space-y-2">
                <label for="avatar" class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Ảnh đại diện</label>
                <div class="flex items-center gap-6">
                    <div class="relative shrink-0">
                        @if ($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="w-20 h-20 rounded-2xl object-cover shadow-sm border-2 border-slate-100">
                        @else
                            <div class="w-20 h-20 rounded-2xl bg-slate-100 flex items-center justify-center border-2 border-slate-200 border-dashed text-slate-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <input id="avatar" name="avatar" type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-black file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 transition-all cursor-pointer" accept="image/*" />
                        <p class="text-xs text-slate-400 mt-2 font-medium">PNG, JPG hoặc GIF (Tối đa 2MB)</p>
                    </div>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>

            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Họ và tên</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-300 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <input id="name" name="name" type="text" class="w-full bg-slate-50 border-none rounded-2xl pl-14 pr-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-blue-600/20 transition-all placeholder-slate-300" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Địa chỉ Email</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-300 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <input id="email" name="email" type="email" class="w-full bg-slate-50 border-none rounded-2xl pl-14 pr-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-blue-600/20 transition-all placeholder-slate-300" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-4 p-4 bg-amber-50 rounded-2xl border border-amber-100">
                        <p class="text-xs font-bold text-amber-700">
                            {{ __('Địa chỉ email của bạn chưa được xác minh.') }}
                            <button form="send-verification" class="ml-2 underline text-amber-900 hover:text-amber-700 transition">
                                {{ __('Nhấn vào đây để gửi lại email xác minh.') }}
                            </button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-xs font-bold text-green-600">
                                {{ __('Một liên kết xác minh mới đã được gửi đến địa chỉ email của bạn.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-slate-50">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-black shadow-xl shadow-blue-200 transition-all active:scale-95">
                Lưu thay đổi
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm font-bold text-green-600">
                    {{ __('Đã cập nhật.') }}
                </p>
            @endif
        </div>
    </form>
</section>
