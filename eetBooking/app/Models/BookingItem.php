<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingItem extends Model
{
    protected $fillable = [
        'booking_id',
        'bookable_id',
        'bookable_type',
        'price',
        'quantity'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function bookable()
    {
        return $this->morphTo();
    }
}
