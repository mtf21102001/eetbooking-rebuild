<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageTranslation extends Model
{
  protected $fillable = [
    'package_id',
    'locale',
    'title',
    'description',
    'short_description',
    'itinerary',
    'inclusions',
    'exclusions',
    'terms_and_conditions',
  ];

  protected $casts = [
    'itinerary' => 'array',
    'inclusions' => 'array',
    'exclusions' => 'array',
  ];

  public function package()
  {
    return $this->belongsTo(Package::class);
  }
}
