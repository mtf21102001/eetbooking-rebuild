<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'image_url',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function visaRequirements()
    {
        return $this->hasMany(VisaRequirement::class);
    }
}
