<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageMedia extends Model
{
  protected $fillable = [
    'package_id',
    'url',
    'type',
    'is_main',
    'order',
  ];

  protected $casts = [
    'is_main' => 'boolean',
  ];

  public function package()
  {
    return $this->belongsTo(Package::class);
  }
}
