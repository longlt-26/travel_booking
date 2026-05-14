<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<nav class="bg-white shadow p-4 mb-8">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 font-bold text-xl">Admin</a>
        <div class="text-gray-700">
            Xin chào, <span class="font-semibold">{{ auth()->user()->name }}</span>
        </div>
    </div>
</nav>

<div class="container mx-auto px-4 max-w-6xl">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Trang quản trị</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow p-6">
            <div class="text-sm text-gray-500">Tổng tour</div>
            <div class="text-2xl font-bold text-gray-900">{{ $toursCount }}</div>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <div class="text-sm text-gray-500">Tổng booking</div>
            <div class="text-2xl font-bold text-gray-900">{{ $bookingsCount }}</div>
        </div>
        <div class="bg-white rounded-xl shadow p-6">
            <div class="text-sm text-gray-500">Đã thanh toán</div>
            <div class="text-2xl font-bold text-green-600">{{ $paidBookingsCount }}</div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow mt-6 p-6">
        <h2 class="text-xl font-semibold mb-4">Danh sách booking (mới nhất)</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                <tr class="text-left bg-gray-50">
                    <th class="p-3">ID</th>
                    <th class="p-3">User</th>
                    <th class="p-3">Tour</th>
                    <th class="p-3">SL</th>
                    <th class="p-3">Tổng tiền</th>
                    <th class="p-3">Trạng thái</th>
                    <th class="p-3">Paid at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($latestBookings as $b)
                    <tr class="border-t">
                        <td class="p-3">#{{ $b->id }}</td>
                        <td class="p-3">{{ $b->user_id }}</td>
                        <td class="p-3">{{ $b->tour->title ?? $b->tour_id }}</td>
                        <td class="p-3">{{ $b->quantity }}</td>
                        <td class="p-3">{{ number_format($b->total_amount, 0, ',', '.') }}</td>
                        <td class="p-3">{{ $b->status }}</td>
                        <td class="p-3">{{ $b->paid_at ? $b->paid_at->format('Y-m-d H:i') : '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

