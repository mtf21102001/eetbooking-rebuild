<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'visa_id',
        'nationality_id',
        'requirement_details',
        'additional_documents',
        'fees',
        'processing_time',
        'notes',
        'active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'additional_documents' => 'array',
        'active' => 'boolean',
    ];

    public function visa()
    {
        return $this->belongsTo(Visa::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
}
