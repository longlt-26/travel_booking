<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Quản lý tài khoản</h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left bg-gray-50">
                                    <th class="p-3">ID</th>
                                    <th class="p-3">Name</th>
                                    <th class="p-3">Email</th>
                                    <th class="p-3">Role</th>
                                    <th class="p-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $u)
                                    <tr class="border-t">
                                        <td class="p-3">{{ $u->id }}</td>
                                        <td class="p-3 font-medium">{{ $u->name }}</td>
                                        <td class="p-3">{{ $u->email }}</td>
                                        <td class="p-3">{{ $u->role }}</td>
                                        <td class="p-3">
                                            @if($u->role !== 'admin')
                                                <form method="POST" action="{{ route('admin.users.makeAdmin', $u) }}" class="inline">
                                                    @csrf
                                                    <button class="text-blue-700 hover:underline" onclick="return confirm('Gán role admin cho người dùng này?')">Make admin</button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('admin.users.removeAdmin', $u) }}" class="inline">
                                                    @csrf
                                                    <button class="text-red-700 hover:underline" onclick="return confirm('Gỡ quyền admin cho người dùng này?')">Remove admin</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">{{ $users->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

