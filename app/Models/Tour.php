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
}
