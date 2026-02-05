<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['country_id', 'name_en', 'name_ar', 'is_active'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function airports()
    {
        return $this->hasMany(Airport::class);
    }

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
