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
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}