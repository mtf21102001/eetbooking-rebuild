<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'city_id',
        'name_en',
        'name_ar',
        'stars',
        'address_en',
        'address_ar',
        'facilities',
        'is_active'
    ];

    protected $casts = [
        'facilities' => 'array',
        'is_active' => 'boolean',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
