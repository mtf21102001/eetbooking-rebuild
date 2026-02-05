<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nationality;
use App\Models\City;
use App\Models\Country;
use App\Models\Destination;
use App\Models\Visa;
use App\Models\VisaRequirement;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class VisaSeeder extends Seeder
{
  public function run()
  {
    // 1. Create Nationalities
    $nationalities = [
      ['name' => 'Egyptian', 'code' => 'EG', 'active' => true],
      ['name' => 'Saudi', 'code' => 'SA', 'active' => true],
      ['name' => 'American', 'code' => 'US', 'active' => true],
      ['name' => 'Emirati', 'code' => 'AE', 'active' => true],
    ];

    foreach ($nationalities as $nat) {
      Nationality::firstOrCreate(['code' => $nat['code']], $nat);
    }

    $egyptian = Nationality::where('code', 'EG')->first();
    $saudi = Nationality::where('code', 'SA')->first();

    // 2. Create Countries & Cities for Destinations
    // UAE
    $uae = Country::firstOrCreate(
      ['iso_code' => 'AE'],
      ['name_en' => 'United Arab Emirates', 'name_ar' => 'الإمارات', 'is_active' => true]
    );
    $dubaiCity = City::firstOrCreate(
      ['name_en' => 'Dubai'],
      ['country_id' => $uae->id, 'name_ar' => 'دبي', 'is_active' => true]
    );

    // Turkey
    $turkey = Country::firstOrCreate(
      ['iso_code' => 'TR'],
      ['name_en' => 'Turkey', 'name_ar' => 'تركيا', 'is_active' => true]
    );
    $istanbulCity = City::firstOrCreate(
      ['name_en' => 'Istanbul'],
      ['country_id' => $turkey->id, 'name_ar' => 'اسطنبول', 'is_active' => true]
    );

    // 3. Create Destinations
    $dubaiDest = Destination::firstOrCreate(
      ['city_id' => $dubaiCity->id],
      [
        'name_en' => 'Dubai',
        'name_ar' => 'دبي',
        'description_en' => 'Discover the luxury of Dubai.',
        'description_ar' => 'استكشف فخامة دبي.',
        'is_featured' => true,
        'rating' => 5
      ]
    );

    $turkeyDest = Destination::firstOrCreate(
      ['city_id' => $istanbulCity->id],
      [
        'name_en' => 'Turkey', // Technically country, but using as destination for visa
        'name_ar' => 'تركيا',
        'description_en' => 'Experience the history of Turkey.',
        'description_ar' => 'عش تاريخ تركيا.',
        'is_featured' => true,
        'rating' => 4
      ]
    );

    // 4. Create Visas
    // Dubai 30 Days
    $dubaiVisa = Visa::firstOrCreate(
      ['title' => 'Dubai 30 Days Tourist Visa'],
      [
        'destination_id' => $dubaiDest->id,
        'description' => 'Single entry tourist visa for 30 days.',
        'price' => 3500,
        'currency' => 'EGP',
        'processing_time' => '2-3 Working Days',
        'validity_period' => '60 Days',
        'entry_type' => 'Single Entry',
        'active' => true,
        'required_documents' => [
          ['document' => 'Passport Scan'],
          ['document' => 'Personal Photo']
        ]
      ]
    );

    // Turkey E-Visa
    $turkeyVisa = Visa::firstOrCreate(
      ['title' => 'Turkey E-Visa'],
      [
        'destination_id' => $turkeyDest->id,
        'description' => 'Electronic visa for tourism.',
        'price' => 50,
        'currency' => 'USD',
        'processing_time' => '24 Hours',
        'validity_period' => '180 Days',
        'entry_type' => 'Multiple Entry',
        'active' => true,
        'required_documents' => [
          ['document' => 'Passport Scan']
        ]
      ]
    );

    // 5. Create Visa Requirements (The Matrix)

    // Egyptian -> Dubai (Needs Visa)
    VisaRequirement::firstOrCreate(
      ['visa_id' => $dubaiVisa->id, 'nationality_id' => $egyptian->id],
      [
        'requirement_details' => 'Passport must be valid for 6 months. White background photo.',
        'fees' => 3500, // EGP
        'processing_time' => '3 Days',
        'active' => true
      ]
    );

    // Saudi -> Dubai (Visa Free / Different rules - hypothetical for testing)
    VisaRequirement::firstOrCreate(
      ['visa_id' => $dubaiVisa->id, 'nationality_id' => $saudi->id],
      [
        'requirement_details' => 'GCC Residents entry. Just ID card.',
        'fees' => 0,
        'processing_time' => 'Instant',
        'notes' => 'Visa on arrival available.',
        'active' => true
      ]
    );

    // Egyptian -> Turkey (Needs Visa + Specifics)
    VisaRequirement::firstOrCreate(
      ['visa_id' => $turkeyVisa->id, 'nationality_id' => $egyptian->id],
      [
        'requirement_details' => 'Valid Schengen/US/UK visa required for E-Visa eligibility otherwise Embassy.',
        'fees' => 60, // USD approx
        'processing_time' => '24 Hours',
        'notes' => 'Under 20 or Over 45 years old don\'t need Schengen.',
        'active' => true
      ]
    );
  }
}
