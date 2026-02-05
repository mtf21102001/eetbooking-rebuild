<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($booking) {
            $booking->booking_reference = 'FLT-' . strtoupper(bin2hex(random_bytes(4)));
        });
    }

    protected $fillable = [
        'booking_reference',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'departure_city',
        'arrival_city',
        'departure_date',
        'return_date',
        'adults',
        'children',
        'infants',
        'class_preference',
        'status',
        'notes',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'return_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
