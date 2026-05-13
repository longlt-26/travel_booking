# TODO - Hoàn thiện tour chi tiết & thanh toán

- [ ] Sửa migration `create_bookings_table` để lưu đầy đủ booking/payment fields
- [ ] Cập nhật `Booking` model (fillable + quan hệ)
- [ ] Cập nhật `Tour` model (quan hệ bookings)
- [ ] Implement `BookingController`: store (tạo booking), pay (hiển thị), callback VNPay/Momo (update trạng thái)
- [x] Sửa migration `create_bookings_table` để lưu đầy đủ booking/payment fields
- [x] Cập nhật `Booking` model (fillable + quan hệ)
- [x] Cập nhật `Tour` model (quan hệ bookings)
- [x] Implement `BookingController` (store/pay + callback handler)
- [x] Thêm routes booking + callback trong `routes/web.php` (auth cho luồng đặt)
- [x] Sửa `tours/show.blade.php`: form đặt tour -> tạo booking + hiển thị tổng tiền
- [x] Tạo view `resources/views/bookings/pay.blade.php` (momo mặc định, đổi sang vnpay)
- [ ] Nối bước “redirect sang cổng thanh toán” (tạo request VNPay/Momo) trong `BookingController@pay` (đang để demo)
- [ ] Bổ sung xử lý hiển thị trạng thái sau callback (paid/failed) cho user
- [ ] Chạy `php artisan migrate` và test luồng đặt tour -> thanh toán -> cập nhật booking


