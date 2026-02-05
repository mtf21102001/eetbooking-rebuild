<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaApplication extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($application) {
            $application->application_reference = 'VISA-' . strtoupper(bin2hex(random_bytes(4)));
        });
    }

    protected $fillable = [
        'application_reference',
        'user_id',
        'visa_id',
        'nationality_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'passport_number',
        'passport_expiry',
        'occupation',
        'monthly_income',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'passport_expiry' => 'date',
    ];

    public function visa()
    {
        return $this->belongsTo(Visa::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
