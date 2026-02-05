<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\City;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Package;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampleDataSeeder extends Seeder
{
  public function run(): void
  {
    // 1. Create Country
    $egypt = Country::create([
      'name_en' => 'Egypt',
      'name_ar' => 'مصر',
      'iso_code' => 'EGY',
      'is_active' => true,
    ]);

    // 2. Create Cities
    $cairo = City::create(['country_id' => $egypt->id, 'name_en' => 'Cairo', 'name_ar' => 'القاهرة', 'is_active' => true]);
    $luxor = City::create(['country_id' => $egypt->id, 'name_en' => 'Luxor', 'name_ar' => 'الأقصر', 'is_active' => true]);
    $aswan = City::create(['country_id' => $egypt->id, 'name_en' => 'Aswan', 'name_ar' => 'أسوان', 'is_active' => true]);
    $hurghada = City::create(['country_id' => $egypt->id, 'name_en' => 'Hurghada', 'name_ar' => 'الغردقة', 'is_active' => true]);

    // 3. Create Destinations (Featured)
    Destination::create([
      'city_id' => $cairo->id,
      'name_en' => 'Giza Pyramids',
      'name_ar' => 'أهرامات الجيزة',
      'description_en' => 'The only remaining wonder of the ancient world.',
      'description_ar' => 'الأثر الوحيد الباقي من عجائب الدنيا السبع القديمة.',
      'images' => ['/cairo.png'],
      'is_featured' => true,
      'is_recommended' => true,
      'rating' => 4.9,
    ]);

    Destination::create([
      'city_id' => $luxor->id,
      'name_en' => 'Karnak Temple',
      'name_ar' => 'معبد الكرنك',
      'description_en' => 'The largest religious complex ever built.',
      'description_ar' => 'أكبر مجمع ديني تم بناؤه على الإطلاق.',
      'images' => ['/cairo.png'],
      'is_featured' => true,
    ]);

    Destination::create([
      'city_id' => $aswan->id,
      'name_en' => 'Philae Temple',
      'name_ar' => 'معبد فيلة',
      'description_en' => 'The beautiful temple dedicated to the goddess Isis.',
      'description_ar' => 'المعبد الجميل المخصص للإلهة إيزيس.',
      'images' => ['/cairo.png'],
      'is_featured' => true,
    ]);

    // 4. Skipping Hotels for now (schema different)

    // 5. OLD PACKAGES SEEDING - DISABLED (Using RefactoredPackageSeeder instead)
    /*
    Package::create([
      'city_id' => $cairo->id,
      'name_en' => 'Classical Egypt Tour',
      'name_ar' => 'جولة مصر الكلاسيكية',
      'description_en' => 'A comprehensive 7-day tour covering Cairo, Luxor, and Aswan highlights.',
      'description_ar' => 'جولة شاملة لمدة 7 أيام تغطي أبرز معالم القاهرة والأقصر وأسوان.',
      'price' => 1250,
      'duration_days' => 7,
      'images' => ['/cairo.png'],
      'is_featured' => true,
      'is_active' => true,
    ]);

    Package::create([
      'city_id' => $hurghada->id,
      'name_en' => 'Red Sea Luxury Getaway',
      'name_ar' => 'عطلة البحر الأحمر الفاخرة',
      'description_en' => 'Relax and enjoy the crystal clear waters of Hurghada for 5 days.',
      'description_ar' => 'استرخ واستمتع بمياه الغردقة الصافية لمدة 5 أيام.',
      'price' => 850,
      'duration_days' => 5,
      'images' => ['/cairo.png'],
      'is_featured' => true,
      'is_active' => true,
    ]);

    Package::create([
      'city_id' => $luxor->id,
      'name_en' => 'Nile Cruise Adventure',
      'name_ar' => 'مغامرة كروز النيل',
      'description_en' => 'Sail through history on a 4-night luxury Nile cruise between Luxor and Aswan.',
      'description_ar' => 'أبحر عبر التاريخ في رحلة نيلية فاخرة لمدة 4 ليالٍ بين الأقصر وأسوان.',
      'price' => 1100,
      'duration_days' => 4,
      'images' => ['/cairo.png'],
      'is_featured' => true,
      'is_active' => true,
    ]);
    */
  }
}
