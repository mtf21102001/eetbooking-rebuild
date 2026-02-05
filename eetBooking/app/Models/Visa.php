<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'destination_id',
        'image_url',
        'price',
        'currency',
        'processing_time',
        'required_documents',
        'validity_period',
        'entry_type',
        'active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'required_documents' => 'array',
        'active' => 'boolean',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function requirements()
    {
        return $this->hasMany(VisaRequirement::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
