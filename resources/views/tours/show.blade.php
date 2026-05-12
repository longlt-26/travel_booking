<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết Tour: {{ $tour->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <nav class="bg-white shadow p-4 mb-8">
        <div class="container mx-auto">
            <a href="{{ route('tours.index') }}" class="text-blue-600 font-bold text-xl flex items-center gap-2">
                &larr; Về trang chủ
            </a>
        </div>
    </nav>

    <div class="container mx-auto px-4 max-w-5xl">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">
            
            <div class="md:w-1/2">
                <img src="{{ $tour->image ?? 'https://placehold.co/800x600?text=Anh+Tour' }}" alt="{{ $tour->title }}" class="w-full h-full object-cover">
            </div>

            <div class="md:w-1/2 p-8">
                <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full uppercase">{{ $tour->location }}</span>
                
                <h1 class="text-3xl font-bold mt-4 text-gray-800">{{ $tour->title }}</h1>
                
                <p class="text-gray-600 mt-4 leading-relaxed whitespace-pre-line">{{ $tour->description }}</p>
                
                <div class="mt-6 bg-gray-50 p-4 rounded-lg border border-gray-100">
                    <p class="text-sm text-gray-500">Giá trọn gói / khách</p>
                    <p class="text-3xl font-bold text-red-500 mt-1">{{ number_format($tour->price, 0, ',', '.') }} VNĐ</p>
                    <p class="text-sm text-gray-500 mt-2">Số lượng tối đa: {{ $tour->max_people }} người</p>
                </div>

                <form action="#" method="POST" class="mt-8">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Số lượng người tham gia</label>
                        <input type="number" name="quantity" min="1" max="{{ $tour->max_people }}" value="1" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors text-lg shadow-md mt-4">
                        Xác nhận đặt Tour
                    </button>
                </form>

            </div>
        </div>
    </div>

</body>
</html>