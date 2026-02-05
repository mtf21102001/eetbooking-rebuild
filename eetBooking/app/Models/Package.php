<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages_refactored';

    protected $fillable = [
        'slug',
        'category_id',
        'destination_id',
        'price',
        'type',
        'currency',
        'duration_days',
        'is_offer',
        'offer_tag',
        'is_popular',
        'rating',
        'featured',
        'is_active',
        'distance_from_center',
        'min_people',
        'max_people',
        'difficulty_level',
        'best_season',
        'discount_percentage',
        'original_price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function translations()
    {
        return $this->hasMany(PackageTranslation::class);
    }

    public function media()
    {
        return $this->hasMany(PackageMedia::class)->orderBy('order');
    }

    public function getImagesAttribute()
    {
        return $this->media->pluck('url')->toArray();
    }

    public function getNameEnAttribute()
    {
        return $this->translations->where('locale', 'en')->first()?->title;
    }

    public function getDescriptionEnAttribute()
    {
        return $this->translations->where('locale', 'en')->first()?->description;
    }


    public function translate($locale = 'en')
    {
        return $this->translations()->where('locale', $locale)->first();
    }

    public function mainImage()
    {
        return $this->media()->where('is_main', true)->first();
    }

    public function bookingItems()
    {
        return $this->morphMany(BookingItem::class, 'bookable');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
