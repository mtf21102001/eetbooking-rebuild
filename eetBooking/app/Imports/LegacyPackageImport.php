<?php

namespace App\Imports;

use App\Models\Package;
use App\Models\PackageTranslation;
use App\Models\Destination;
use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LegacyPackageImport implements ToModel, WithHeadingRow
{
  public $successful = 0;
  public $skipped = 0;
  public $errors = [];

  private $locationMap = [
    'Riyadh' => ['country' => 'Saudi Arabia', 'iso' => 'SA', 'city' => 'Riyadh'],
    'Jeddah' => ['country' => 'Saudi Arabia', 'iso' => 'SA', 'city' => 'Jeddah'],
    'Abha' => ['country' => 'Saudi Arabia', 'iso' => 'SA', 'city' => 'Abha'],
    'Dahab' => ['country' => 'Egypt', 'iso' => 'EG', 'city' => 'Dahab'],
    'Aswan' => ['country' => 'Egypt', 'iso' => 'EG', 'city' => 'Aswan'],
    'Luxor' => ['country' => 'Egypt', 'iso' => 'EG', 'city' => 'Luxor'],
    'Hurghada' => ['country' => 'Egypt', 'iso' => 'EG', 'city' => 'Hurghada'],
    'Sharm El Sheikh' => ['country' => 'Egypt', 'iso' => 'EG', 'city' => 'Sharm El Sheikh'],
    'Marsa Alam' => ['country' => 'Egypt', 'iso' => 'EG', 'city' => 'Marsa Alam'],
    'Taba' => ['country' => 'Egypt', 'iso' => 'EG', 'city' => 'Taba'],
    'Giza' => ['country' => 'Egypt', 'iso' => 'EG', 'city' => 'Giza'],
    'Cairo' => ['country' => 'Egypt', 'iso' => 'EG', 'city' => 'Cairo'],
    'El Gouna' => ['country' => 'Egypt', 'iso' => 'EG', 'city' => 'El Gouna'],
    'Red Sea' => ['country' => 'Egypt', 'iso' => 'EG', 'city' => 'Hurghada'],
    'Dubai' => ['country' => 'United Arab Emirates', 'iso' => 'AE', 'city' => 'Dubai'],
    'Istanbul' => ['country' => 'Turkey', 'iso' => 'TR', 'city' => 'Istanbul'],
    'Bursa' => ['country' => 'Turkey', 'iso' => 'TR', 'city' => 'Bursa'],
    'Cappadocia' => ['country' => 'Turkey', 'iso' => 'TR', 'city' => 'Cappadocia'],
    'Baku' => ['country' => 'Azerbaijan', 'iso' => 'AZ', 'city' => 'Baku'],
    'Silk Way' => ['country' => 'Azerbaijan', 'iso' => 'AZ', 'city' => 'Baku'],
    'Tbilisi' => ['country' => 'Georgia', 'iso' => 'GE', 'city' => 'Tbilisi'],
    'Yerevan' => ['country' => 'Armenia', 'iso' => 'AM', 'city' => 'Yerevan'],
    'Muscat' => ['country' => 'Oman', 'iso' => 'OM', 'city' => 'Muscat'],
    'London' => ['country' => 'United Kingdom', 'iso' => 'GB', 'city' => 'London'],
    'Italy' => ['country' => 'Italy', 'iso' => 'IT', 'city' => 'Rome'],
    'Italian' => ['country' => 'Italy', 'iso' => 'IT', 'city' => 'Rome'],
    'Rome' => ['country' => 'Italy', 'iso' => 'IT', 'city' => 'Rome'],
    'Venice' => ['country' => 'Italy', 'iso' => 'IT', 'city' => 'Venice'],
    'Florence' => ['country' => 'Italy', 'iso' => 'IT', 'city' => 'Florence'],
    'Amsterdam' => ['country' => 'Netherlands', 'iso' => 'NL', 'city' => 'Amsterdam'],
    'Benelux' => ['country' => 'Netherlands', 'iso' => 'NL', 'city' => 'Amsterdam'],
    'Brussels' => ['country' => 'Belgium', 'iso' => 'BE', 'city' => 'Brussels'],
    'Luxembourg' => ['country' => 'Luxembourg', 'iso' => 'LU', 'city' => 'Luxembourg'],
    'Phuket' => ['country' => 'Thailand', 'iso' => 'TH', 'city' => 'Phuket'],
    'Zanzibar' => ['country' => 'Tanzania', 'iso' => 'TZ', 'city' => 'Zanzibar'],
    'Maldives' => ['country' => 'Maldives', 'iso' => 'MV', 'city' => 'Malé'],
    'Kuala Lumpur' => ['country' => 'Malaysia', 'iso' => 'MY', 'city' => 'Kuala Lumpur'],
    'Langkawi' => ['country' => 'Malaysia', 'iso' => 'MY', 'city' => 'Langkawi'],
    'Malaysia' => ['country' => 'Malaysia', 'iso' => 'MY', 'city' => 'Kuala Lumpur'],
    'Cyprus' => ['country' => 'Cyprus', 'iso' => 'CY', 'city' => 'Larnaca'],
  ];

  public function model(array $row)
  {
    $title = trim($row['title'] ?? '');
    if (empty($title)) return null;

    // 1. Detect Destination
    $destination = $this->getOrCreateDestination($title);

    if (!$destination) {
      $this->skipped++;
      $this->errors[] = "Could not detect destination for: {$title}";
      return null;
    }

    try {
      // 2. Map Boolean
      $featured = (trim(strtolower($row['featured'] ?? '')) === 'yes');

      // 3. Create or Update Package
      $package = Package::updateOrCreate(
        ['slug' => Str::slug($title)],
        [
          'destination_id' => $destination->id,
          'price' => $this->cleanPrice($row['price']),
          'original_price' => $this->cleanPrice($row['discounted_price'] ?? null),
          'duration_days' => $row['duration_days'] ?? 1,
          'type' => $row['type'] ?? 'General',
          'rating' => $row['rating'] ?? 5,
          'featured' => $featured,
          'is_active' => true,
        ]
      );

      // 4. Update Translations
      $package->translations()->delete();

      // Clean description
      $desc = $this->cleanText($row['description'] ?? '');

      $t1 = PackageTranslation::create([
        'package_id' => $package->id,
        'locale' => 'en',
        'title' => $title,
        'description' => $desc,
        'inclusions' => $this->parseInclusions($row['inclusions'] ?? ''),
      ]);

      // Create placeholder AR translation
      $t2 = PackageTranslation::create([
        'package_id' => $package->id,
        'locale' => 'ar',
        'title' => $title, // Placeholder
        'description' => $desc, // Placeholder
      ]);

      $this->successful++;
      return $package;
    } catch (\Exception $e) {
      $this->skipped++;
      $this->errors[] = "Error importing '{$title}': " . $e->getMessage();
      return null;
    }
  }

  private function getOrCreateDestination($title)
  {
    $detected = null;
    foreach ($this->locationMap as $key => $info) {
      if (stripos($title, $key) !== false) {
        $detected = $info;
        break;
      }
    }

    if (!$detected) return null;

    // Ensure Country
    $country = Country::firstOrCreate(
      ['name_en' => $detected['country']],
      ['name_ar' => $detected['country'], 'iso_code' => $detected['iso'], 'is_active' => true]
    );

    // Ensure City
    $city = City::firstOrCreate(
      ['name_en' => $detected['city'], 'country_id' => $country->id],
      ['name_ar' => $detected['city'], 'is_active' => true]
    );

    // Ensure Destination
    return Destination::firstOrCreate(
      ['name_en' => $detected['city'], 'city_id' => $city->id],
      ['name_ar' => $detected['city'], 'is_featured' => true]
    );
  }

  private function cleanPrice($val)
  {
    if (!$val) return null;
    return (float) preg_replace('/[^0-9.]/', '', $val);
  }

  private function cleanText($text)
  {
    $text = str_replace('', '✓', $text);
    return trim($text);
  }

  private function parseInclusions($json)
  {
    if (empty($json)) return [];
    $data = json_decode($json, true);
    if (is_array($data)) {
      return array_map([$this, 'cleanText'], $data);
    }
    return [];
  }
}
