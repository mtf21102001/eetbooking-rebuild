<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\PackageTranslation;
use App\Models\PackageMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RefactoredPackageSeeder extends Seeder
{
  public function run(): void
  {
    $csvFile = base_path('_TESTS/package.csv');

    if (!file_exists($csvFile)) {
      $this->command->error('CSV file not found!');
      return;
    }

    $file = fopen($csvFile, 'r');
    $header = fgetcsv($file); // Skip header row

    while (($row = fgetcsv($file)) !== false) {
      if (empty($row[0]) || empty($row[1])) {
        continue; // Skip empty rows
      }

      // Create Package
      $package = Package::create([
        'slug' => $row[2] ?: Str::slug($row[1]),
        'category_id' => null, // Will be set later if needed
        // Legacy CSV has IDs that don't match our fresh database (e.g. 49).
        // Setting to null to avoid Foreign Key constraint violations.
        'destination_id' => null,
        'price' => !empty($row[4]) ? (float)$row[4] : 0,
        'currency' => 'EGP',
        'duration_days' => !empty($row[6]) ? (int)$row[6] : 1,
        'featured' => strtolower($row[10]) === 'yes',
        'is_active' => true,
        // Dynamic Homepage Data
        'is_offer' => rand(0, 10) > 8, // 20% chance
        'offer_tag' => rand(0, 1) ? 'Best Seller' : 'Trending',
        'is_popular' => rand(0, 10) > 7, // 30% chance
        'rating' => fake()->randomFloat(1, 4, 5),
      ]);

      // Create English Translation
      PackageTranslation::create([
        'package_id' => $package->id,
        'locale' => 'en',
        'title' => $row[1],
        'description' => $row[3] ?? '',
        'short_description' => Str::limit($row[3] ?? '', 200),
        'itinerary' => null,
        'inclusions' => !empty($row[12]) ? json_decode($row[12], true) : null,
        'exclusions' => null,
        'terms_and_conditions' => null,
      ]);

      // Create Arabic Translation (placeholder for now)
      PackageTranslation::create([
        'package_id' => $package->id,
        'locale' => 'ar',
        'title' => $row[1], // Will be translated later
        'description' => $row[3] ?? '',
        'short_description' => Str::limit($row[3] ?? '', 200),
        'itinerary' => null,
        'inclusions' => !empty($row[12]) ? json_decode($row[12], true) : null,
        'exclusions' => null,
        'terms_and_conditions' => null,
      ]);

      // Create placeholder media (you can update with real images later)
      PackageMedia::create([
        'package_id' => $package->id,
        'url' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?auto=format&fit=crop&w=800&q=80',
        'type' => 'image',
        'is_main' => true,
        'order' => 0,
      ]);

      $this->command->info("Created package: {$row[1]}");
    }

    fclose($file);
    $this->command->info('Packages seeded successfully!');
  }
}
