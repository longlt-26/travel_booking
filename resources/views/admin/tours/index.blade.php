<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Quản lý Tour</h2>
            <a href="{{ route('admin.tours.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                Thêm tour
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left bg-gray-50">
                                    <th class="p-3">ID</th>
                                    <th class="p-3">Title</th>
                                    <th class="p-3">Category</th>
                                    <th class="p-3">Price</th>
                                    <th class="p-3">Max</th>
                                    <th class="p-3">Location</th>
                                    <th class="p-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tours as $tour)
                                    <tr class="border-t">
                                        <td class="p-3">{{ $tour->id }}</td>
                                        <td class="p-3 font-medium">{{ $tour->title }}</td>
                                        <td class="p-3">{{ $tour->category->name ?? $tour->category_id }}</td>
                                        <td class="p-3">{{ number_format($tour->price, 0, ',', '.') }}</td>
                                        <td class="p-3">{{ $tour->max_people }}</td>
                                        <td class="p-3">{{ $tour->location }}</td>
                                        <td class="p-3 whitespace-nowrap">
                                            <a href="{{ route('admin.tours.edit', $tour) }}" class="text-blue-700 hover:underline mr-3">Sửa</a>
                                            <form action="{{ route('admin.tours.destroy', $tour) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-700 hover:underline" onclick="return confirm('Xóa tour này?')">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $tours->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

