<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'travel_date',
        'number_of_travelers',
        'notes',
        'total_price',
        'status',
        'payment_status',
        'payment_method'
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(BookingItem::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
