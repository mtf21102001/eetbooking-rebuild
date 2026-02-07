<?php

namespace App\Imports;

use App\Models\Package;
use App\Models\PackageTranslation;
use App\Models\Destination;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PackageImport implements ToModel, WithHeadingRow
{
  public $successful = 0;
  public $skipped = 0;
  public $errors = [];

  public function model(array $row)
  {
    $titleEn = trim($row['title_en'] ?? '');
    $destinationName = trim($row['destination_name_en'] ?? '');

    // 1. Skip strictly guidance row
    if ($destinationName === 'MANDATORY' || $titleEn === 'MANDATORY') {
      return null;
    }

    // 2. Validate mandatory fields
    if (empty($titleEn)) {
      $this->skipped++;
      $this->errors[] = "Row skipped: English Title is empty.";
      echo "[-] Skipped: Missing Title EN.\n";
      return null;
    }

    // 3. Find Destination
    $destination = Destination::where('name_en', 'LIKE', $destinationName)->first();

    if (!$destination) {
      $this->skipped++;
      $errorMsg = "Row '{$titleEn}' skipped: Destination '{$destinationName}' not found in database.";
      $this->errors[] = $errorMsg;
      echo "[-] Error: Destination '{$destinationName}' for package '{$titleEn}' doesn't exist.\n";
      return null;
    }

    try {
      // Find or Create the Package by Slug
      $slug = Str::slug($titleEn);
      $package = Package::updateOrCreate(
        ['slug' => $slug], // Search by slug
        [
          'destination_id' => $destination->id,
          'price' => $row['price'] ?? 0,
          'original_price' => $row['original_price'] ?? null,
          'discount_percentage' => $row['discount'] ?? null,
          'duration_days' => $row['duration_nights'] ?? 1,
          'type' => $row['type'] ?? 'General',
          'min_people' => $row['min_people'] ?? 1,
          'max_people' => $row['max_people'] ?? null,
          'distance_from_center' => $row['distance_from_center_km'] ?? null,
          'difficulty_level' => $row['difficulty_level'] ?? null,
          'best_season' => $row['best_season'] ?? null,
          'featured' => (bool) ($row['is_featured_10'] ?? false),
          'is_offer' => (bool) ($row['is_offer_10'] ?? false),
          'offer_tag' => $row['offer_tag'] ?? null,
          'is_popular' => (bool) ($row['is_popular_10'] ?? false),
          'rating' => $row['rating'] ?? 5,
          'is_active' => (bool) ($row['is_active_10'] ?? true),
        ]
      );

      // Clean up old translations/itinerary to avoid mess if updating
      $package->translations()->delete();

      // Save Translations
      $this->saveTranslations($package, $row);

      $this->successful++;
      echo "[+] Success: Imported '{$titleEn}'.\n";
      return $package;
    } catch (\Exception $e) {
      $this->skipped++;
      $this->errors[] = "Row '{$titleEn}' failed: " . $e->getMessage();
      echo "[!] Critical Error for '{$titleEn}': " . $e->getMessage() . "\n";
      return null;
    }
  }

  private function saveTranslations($package, $row)
  {
    $stringToArray = function ($str) {
      if (!$str) return [];
      return array_filter(array_map('trim', explode(',', $str)));
    };

    // EN
    PackageTranslation::create([
      'package_id' => $package->id,
      'locale' => 'en',
      'title' => trim($row['title_en']),
      'short_description' => $row['short_description_en'] ?? null,
      'description' => $row['full_description_en'] ?? null,
      'itinerary' => $this->getItineraryArray($row, 'en'),
      'inclusions' => $stringToArray($row['inclusions_en_comma_separated'] ?? ''),
      'exclusions' => $stringToArray($row['exclusions_en_comma_separated'] ?? ''),
    ]);

    // AR
    PackageTranslation::create([
      'package_id' => $package->id,
      'locale' => 'ar',
      'title' => trim($row['title_ar'] ?? $row['title_en']),
      'short_description' => $row['short_description_ar'] ?? null,
      'description' => $row['full_description_ar'] ?? null,
      'itinerary' => $this->getItineraryArray($row, 'ar'),
      'inclusions' => $stringToArray($row['inclusions_ar_comma_separated'] ?? ''),
      'exclusions' => $stringToArray($row['exclusions_ar_comma_separated'] ?? ''),
    ]);
  }

  private function getItineraryArray($row, $locale)
  {
    $data = [];
    for ($i = 1; $i <= 5; $i++) {
      $tKey = "day_{$i}_title_{$locale}";
      $aKey = "day_{$i}_activities_{$locale}";
      if (!empty($row[$tKey])) {
        $data[] = ['day_title' => $row[$tKey], 'day_description' => $row[$aKey] ?? ''];
      }
    }
    return $data;
  }
}
