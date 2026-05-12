<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Travel - Trang Chủ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow-md p-4 mb-8">
        <div class="container mx-auto flex justify-between items-center max-w-6xl">
            <h1 class="text-2xl font-bold text-blue-600">BookingTravel</h1>
            <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-700 font-medium">Trang quản trị</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 mr-4">Đăng nhập</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Đăng ký</a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 max-w-6xl">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-10">Tour Nổi Bật Hôm Nay</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($tours as $tour)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <img src="https://placehold.co/600x400?text=Anh+Tour" alt="Ảnh mô phỏng" class="w-full h-52 object-cover">
                
                <div class="p-5">
                    <span class="text-xs font-bold text-blue-600 uppercase">{{ $tour->location }}</span>
                    <h3 class="text-xl font-bold text-gray-900 mt-1 mb-2">{{ $tour->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4 h-12 overflow-hidden">{{ $tour->description }}</p>
                    
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-red-500 font-bold text-xl">{{ number_format($tour->price, 0, ',', '.') }} đ</span>
                    </div>

                    <a href="/tour/{{ $tour->id }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Xem chi tiết
                    </a>
                </div>
            </div>
            @endforeach
            </div>
    </div>

</body>
</html>