<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'tour_id',
        'departure_date',
        'quantity',
        'total_amount',
        'status',
        'payment_provider',
        'payment_reference',
        'paid_at',
        'voucher_code',
        'discount_amount',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'departure_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
