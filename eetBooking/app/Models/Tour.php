<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'city_id',
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'price',
        'duration_hours',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function bookingItems()
    {
        return $this->morphMany(BookingItem::class, 'bookable');
    }
}
