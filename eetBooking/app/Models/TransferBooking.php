<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferBooking extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($booking) {
            $booking->booking_reference = 'TRF-' . strtoupper(bin2hex(random_bytes(4)));
        });
    }

    protected $fillable = [
        'booking_reference',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'pickup_location',
        'dropoff_location',
        'pickup_date',
        'pickup_time',
        'passengers',
        'vehicle_type',
        'status',
        'notes',
    ];

    protected $casts = [
        'pickup_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
