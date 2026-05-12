<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Thêm dòng này để cho phép nhập dữ liệu vào cột name và slug
    protected $fillable = ['name', 'slug'];

    public function tours() 
    {
        return $this->hasMany(Tour::class);
    }
}