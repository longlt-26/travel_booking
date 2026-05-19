<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    // Cho phép nhập dữ liệu cho các cột của Tour
    protected $fillable = [
        'category_id', 
        'title', 
        'description', 
        'price', 
        'max_people', 
        'location', 
        'image',
        'region'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Tối ưu hóa & Dự đoán Giá (Dynamic Pricing)
     * AI/Thuật toán điều chỉnh giá dựa trên nhu cầu (số lượng booking) và tính mùa vụ.
     */
    public function getDynamicPriceAttribute()
    {
        $basePrice = $this->attributes['price'];
        $multiplier = 1.0;

        // 1. Tính mùa vụ (Seasonality)
        $currentMonth = date('n'); // 1-12
        if (in_array($currentMonth, [6, 7, 8])) { // Mùa hè cao điểm
            $multiplier += 0.15; // Tăng 15%
        } elseif (in_array($currentMonth, [11, 12, 1, 2])) { // Cuối năm / Lễ hội
            $multiplier += 0.10; // Tăng 10%
        } else { // Mùa thấp điểm
            $multiplier -= 0.05; // Giảm 5% kích cầu
        }

        // 2. Tính nhu cầu (Demand)
        // Nếu tour có nhiều booking đã được duyệt, tăng nhẹ giá trị vì độ hot
        $completedBookingsCount = $this->bookings()->where('status', 'paid')->count();
        if ($completedBookingsCount > 20) {
            $multiplier += 0.10; // Cực hot
        } elseif ($completedBookingsCount > 5) {
            $multiplier += 0.05; // Đang hot
        }

        // Trả về giá đã làm tròn đến hàng ngàn
        return round($basePrice * $multiplier, -3);
    }
}
