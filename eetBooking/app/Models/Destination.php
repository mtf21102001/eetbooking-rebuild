<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'city_id',
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'images',
        'is_featured',
        'is_recommended',
        'rating',
    ];

    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function visas()
    {
        return $this->hasMany(Visa::class);
    }
}
