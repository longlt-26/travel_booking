<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Sửa Tour #{{ $tour->id }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.tours.update', $tour) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Category</label>
                                <select name="category_id" class="mt-1 w-full border-gray-300 rounded" required>
                                    @foreach($categories as $c)
                                        <option value="{{ $c->id }}" {{ $tour->category_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Giá</label>
                                <input type="number" step="0.01" name="price" value="{{ $tour->price }}" class="mt-1 w-full border-gray-300 rounded" required>
                                @error('price')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" name="title" value="{{ $tour->title }}" class="mt-1 w-full border-gray-300 rounded" required>
                                @error('title')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Max people</label>
                                <input type="number" name="max_people" value="{{ $tour->max_people }}" class="mt-1 w-full border-gray-300 rounded" required>
                                @error('max_people')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Location</label>
                                <input type="text" name="location" value="{{ $tour->location }}" class="mt-1 w-full border-gray-300 rounded" required>
                                @error('location')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" class="mt-1 w-full border-gray-300 rounded" rows="5" required>{{ $tour->description }}</textarea>
                                @error('description')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Image (URL)</label>
                                <input type="text" name="image" value="{{ $tour->image }}" class="mt-1 w-full border-gray-300 rounded" placeholder="https://...">
                                @error('image')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mt-6 flex gap-3">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Cập nhật</button>
                            <a href="{{ route('admin.tours.index') }}" class="px-4 py-2 border rounded">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

