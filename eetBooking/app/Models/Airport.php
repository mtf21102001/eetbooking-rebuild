<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    protected $fillable = ['city_id', 'name_en', 'name_ar', 'iata_code', 'icao_code'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
