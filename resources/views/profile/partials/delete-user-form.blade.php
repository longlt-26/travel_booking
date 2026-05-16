<section class="space-y-6">
    <header>
        <p class="text-sm font-bold text-slate-500 leading-relaxed">
            {{ __('Một khi tài khoản của bạn bị xóa, tất cả tài nguyên và dữ liệu của nó sẽ bị xóa vĩnh viễn. Trước khi xóa tài khoản, vui lòng tải xuống bất kỳ dữ liệu hoặc thông tin nào mà bạn muốn giữ lại.') }}
        </p>
    </header>

    <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-50 text-red-600 hover:bg-red-600 hover:text-white px-8 py-3 rounded-xl font-black text-xs transition-all shadow-sm">
        {{ __('Xóa tài khoản vĩnh viễn') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-xl font-black text-slate-900 mb-4">
                {{ __('Bạn có chắc chắn muốn xóa tài khoản?') }}
            </h2>

            <p class="text-sm font-bold text-slate-500 mb-8 leading-relaxed">
                {{ __('Xác nhận xóa tài khoản của bạn bằng cách nhập mật khẩu. Hành động này không thể hoàn tác.') }}
            </p>

            <div class="space-y-2">
                <label for="password" class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">{{ __('Mật khẩu') }}</label>
                <input id="password" name="password" type="password" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-blue-600/20 transition-all placeholder-slate-300" placeholder="{{ __('••••••••') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-8 py-3 rounded-xl font-black text-slate-400 hover:bg-slate-50 transition-all text-xs">
                    {{ __('Hủy bỏ') }}
                </button>

                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-xl font-black text-xs transition-all shadow-xl shadow-red-200">
                    {{ __('Xác nhận xóa') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
