<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-white shadow p-4 mb-8">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('client.dashboard') }}" class="text-blue-600 font-bold text-xl">Client</a>
        <div class="text-gray-700">
            Xin chào, <span class="font-semibold">{{ auth()->user()->name }}</span>
        </div>
    </div>
</nav>

<div class="container mx-auto px-4 max-w-3xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-4">Dashboard người dùng</h1>

    <div class="bg-white rounded-xl shadow p-6">
        <p class="text-gray-700">Trang này dành cho user (role = <span class="font-semibold">user</span>).</p>
        <p class="text-gray-500 mt-2 text-sm">Bạn có thể mở thanh toán từ trang tour.</p>
    </div>
</div>

</body>
</html>

