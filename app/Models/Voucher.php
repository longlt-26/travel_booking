<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code',
        'discount_percent',
        'min_amount',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Kiểm tra xem voucher có đang trong thời gian hiệu lực và được bật hay không
     */
    public function isCurrent()
    {
        if (!$this->is_active) return false;
        
        $now = now();
        return ($now >= $this->start_date && $now <= $this->end_date);
    }

    /**
     * Kiểm tra xem voucher có thể áp dụng cho một số tiền cụ thể không
     */
    public function isValid($amount = 0)
    {
        if (!$this->isCurrent()) return false;
        
        return $amount >= $this->min_amount;
    }
}
