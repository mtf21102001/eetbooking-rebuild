<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\PackageTranslation;
use App\Models\PackageMedia;
use App\Models\Destination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EnhancedPackageSeeder extends Seeder
{
  public function run(): void
  {
    $packages = $this->getPackagesData();

    foreach ($packages as $pkgData) {
      $package = Package::updateOrCreate(
        ['slug' => $pkgData['slug']],
        [
          'destination_id' => $this->getRandomDestinationId(),
          'price' => $pkgData['price'],
          'currency' => 'EGP',
          'duration_days' => $pkgData['duration'],
          'type' => $pkgData['type'],
          'is_offer' => $pkgData['is_offer'],
          'offer_tag' => $pkgData['offer_tag'] ?? null,
          'is_popular' => $pkgData['is_popular'],
          'rating' => $pkgData['rating'],
          'featured' => $pkgData['featured'],
          'distance_from_center' => $pkgData['distance'] ?? null,
          'min_people' => $pkgData['min_people'],
          'max_people' => $pkgData['max_people'],
          'difficulty_level' => $pkgData['difficulty'],
          'best_season' => $pkgData['season'],
          'discount_percentage' => $pkgData['discount'] ?? null,
          'original_price' => $pkgData['original_price'] ?? null,
          'is_active' => true,
        ]
      );

      // English Translation
      PackageTranslation::updateOrCreate(
        ['package_id' => $package->id, 'locale' => 'en'],
        [
          'title' => $pkgData['title_en'],
          'description' => $pkgData['description_en'],
          'short_description' => $pkgData['short_desc_en'],
          'itinerary' => $pkgData['itinerary_en'],
          'inclusions' => $pkgData['inclusions_en'],
          'exclusions' => $pkgData['exclusions_en'],
          'terms_and_conditions' => $pkgData['terms_en'],
        ]
      );

      // Arabic Translation
      PackageTranslation::updateOrCreate(
        ['package_id' => $package->id, 'locale' => 'ar'],
        [
          'title' => $pkgData['title_ar'],
          'description' => $pkgData['description_ar'],
          'short_description' => $pkgData['short_desc_ar'],
          'itinerary' => $pkgData['itinerary_ar'],
          'inclusions' => $pkgData['inclusions_ar'],
          'exclusions' => $pkgData['exclusions_ar'],
          'terms_and_conditions' => $pkgData['terms_ar'],
        ]
      );

      // Remove existing media to avoid duplicates or orphaned records if list changes
      PackageMedia::where('package_id', $package->id)->delete();

      // Add Images
      foreach ($pkgData['images'] as $index => $imageUrl) {
        PackageMedia::create([
          'package_id' => $package->id,
          'url' => $imageUrl,
          'type' => 'image',
          'is_main' => $index === 0,
          'order' => $index,
        ]);
      }

      $this->command->info("Created: {$pkgData['title_en']}");
    }
  }

  private function getRandomDestinationId()
  {
    $destination = Destination::inRandomOrder()->first();
    return $destination ? $destination->id : null;
  }

  private function getPackagesData(): array
  {
    return [
      // Package 1: Pyramids & Cairo
      [
        'slug' => 'cairo-pyramids-adventure',
        'title_en' => 'Cairo Pyramids Adventure',
        'title_ar' => 'مغامرة أهرامات القاهرة',
        'short_desc_en' => 'Explore the ancient wonders of Cairo including the Great Pyramids and Sphinx',
        'short_desc_ar' => 'استكشف عجائب القاهرة القديمة بما في ذلك الأهرامات العظيمة وأبو الهول',
        'description_en' => 'Embark on an unforgettable journey through time as you explore Cairo\'s most iconic landmarks. Visit the Great Pyramids of Giza, stand before the enigmatic Sphinx, and discover the treasures of the Egyptian Museum.',
        'description_ar' => 'انطلق في رحلة لا تُنسى عبر الزمن أثناء استكشاف أشهر معالم القاهرة. قم بزيارة أهرامات الجيزة العظيمة، وقف أمام أبو الهول الغامض، واكتشف كنوز المتحف المصري.',
        'price' => 1200,
        'original_price' => 1500,
        'discount' => 20,
        'duration' => 3,
        'type' => 'Cultural',
        'is_offer' => true,
        'offer_tag' => 'Best Seller',
        'is_popular' => true,
        'rating' => 4.8,
        'featured' => true,
        'distance' => 15.5,
        'min_people' => 2,
        'max_people' => 15,
        'difficulty' => 'Easy',
        'season' => 'Year-round',
        'itinerary_en' => [
          ['day' => 1, 'title' => 'Pyramids of Giza', 'description' => 'Visit the Great Pyramid, Khafre, and Menkaure pyramids'],
          ['day' => 2, 'title' => 'Egyptian Museum', 'description' => 'Explore ancient artifacts and Tutankhamun treasures'],
          ['day' => 3, 'title' => 'Old Cairo', 'description' => 'Discover Coptic Cairo and Khan el-Khalili bazaar'],
        ],
        'itinerary_ar' => [
          ['day' => 1, 'title' => 'أهرامات الجيزة', 'description' => 'زيارة الهرم الأكبر وخفرع ومنقرع'],
          ['day' => 2, 'title' => 'المتحف المصري', 'description' => 'استكشاف الآثار القديمة وكنوز توت عنخ آمون'],
          ['day' => 3, 'title' => 'القاهرة القديمة', 'description' => 'اكتشاف القاهرة القبطية وخان الخليلي'],
        ],
        'inclusions_en' => ['Professional guide', 'Hotel pickup', 'Entrance fees', 'Lunch'],
        'inclusions_ar' => ['مرشد محترف', 'نقل من الفندق', 'رسوم الدخول', 'غداء'],
        'exclusions_en' => ['Personal expenses', 'Tips', 'Drinks'],
        'exclusions_ar' => ['المصروفات الشخصية', 'الإكراميات', 'المشروبات'],
        'terms_en' => 'Cancellation 48 hours before for full refund',
        'terms_ar' => 'الإلغاء قبل 48 ساعة لاسترداد كامل المبلغ',
        'images' => [
          'https://images.unsplash.com/photo-1572252009286-268acec5a0af?w=800',
          'https://images.unsplash.com/photo-1568322445389-f64ac2515020?w=800',
        ],
      ],

      // Package 2: Luxor Temple Tour
      [
        'slug' => 'luxor-temples-discovery',
        'title_en' => 'Luxor Temples Discovery',
        'title_ar' => 'اكتشاف معابد الأقصر',
        'short_desc_en' => 'Journey through Luxor\'s magnificent temples and tombs',
        'short_desc_ar' => 'رحلة عبر معابد ومقابر الأقصر الرائعة',
        'description_en' => 'Discover the ancient capital of Thebes with visits to Karnak Temple, Valley of the Kings, and Luxor Temple.',
        'description_ar' => 'اكتشف العاصمة القديمة طيبة مع زيارات لمعبد الكرنك ووادي الملوك ومعبد الأقصر.',
        'price' => 1800,
        'duration' => 4,
        'type' => 'Cultural',
        'is_offer' => false,
        'is_popular' => true,
        'rating' => 4.9,
        'featured' => true,
        'distance' => 5.2,
        'min_people' => 1,
        'max_people' => 20,
        'difficulty' => 'Moderate',
        'season' => 'Winter',
        'itinerary_en' => [
          ['day' => 1, 'title' => 'Karnak Temple', 'description' => 'Explore the largest temple complex'],
          ['day' => 2, 'title' => 'Valley of the Kings', 'description' => 'Visit royal tombs'],
          ['day' => 3, 'title' => 'Hatshepsut Temple', 'description' => 'Marvel at the terraced temple'],
          ['day' => 4, 'title' => 'Luxor Temple', 'description' => 'Evening temple visit'],
        ],
        'itinerary_ar' => [
          ['day' => 1, 'title' => 'معبد الكرنك', 'description' => 'استكشاف أكبر مجمع معابد'],
          ['day' => 2, 'title' => 'وادي الملوك', 'description' => 'زيارة المقابر الملكية'],
          ['day' => 3, 'title' => 'معبد حتشبسوت', 'description' => 'استمتع بالمعبد المدرج'],
          ['day' => 4, 'title' => 'معبد الأقصر', 'description' => 'زيارة المعبد المسائية'],
        ],
        'inclusions_en' => ['Expert Egyptologist guide', 'All transfers', 'Entrance tickets', 'Meals'],
        'inclusions_ar' => ['مرشد متخصص في علم المصريات', 'جميع التنقلات', 'تذاكر الدخول', 'الوجبات'],
        'exclusions_en' => ['Flights', 'Personal shopping', 'Optional activities'],
        'exclusions_ar' => ['الرحلات الجوية', 'التسوق الشخصي', 'الأنشطة الاختيارية'],
        'terms_en' => 'Minimum 2 people required',
        'terms_ar' => 'الحد الأدنى شخصين مطلوب',
        'images' => [
          'https://images.unsplash.com/photo-1553913861-c0fddf2619ee?w=800',
          'https://images.unsplash.com/photo-1539768942893-daf53e448371?w=800',
        ],
      ],

      // Package 3: Red Sea Diving
      [
        'slug' => 'red-sea-diving-adventure',
        'title_en' => 'Red Sea Diving Adventure',
        'title_ar' => 'مغامرة الغوص في البحر الأحمر',
        'short_desc_en' => 'Explore the underwater paradise of the Red Sea',
        'short_desc_ar' => 'استكشف الجنة تحت الماء في البحر الأحمر',
        'description_en' => 'Dive into crystal-clear waters and discover vibrant coral reefs teeming with marine life.',
        'description_ar' => 'اغطس في المياه الصافية واكتشف الشعاب المرجانية النابضة بالحياة البحرية.',
        'price' => 2500,
        'original_price' => 3000,
        'discount' => 16.67,
        'duration' => 5,
        'type' => 'Adventure',
        'is_offer' => true,
        'offer_tag' => 'Trending',
        'is_popular' => true,
        'rating' => 4.7,
        'featured' => false,
        'distance' => 0.5,
        'min_people' => 2,
        'max_people' => 8,
        'difficulty' => 'Challenging',
        'season' => 'Spring',
        'itinerary_en' => [
          ['day' => 1, 'title' => 'Arrival & Orientation', 'description' => 'Equipment check and safety briefing'],
          ['day' => 2, 'title' => 'Shallow Reef Dive', 'description' => 'First dive at 12m depth'],
          ['day' => 3, 'title' => 'Wreck Dive', 'description' => 'Explore the Thistlegorm wreck'],
          ['day' => 4, 'title' => 'Deep Reef Dive', 'description' => 'Advanced dive to 30m'],
          ['day' => 5, 'title' => 'Free Day', 'description' => 'Snorkeling or relaxation'],
        ],
        'itinerary_ar' => [
          ['day' => 1, 'title' => 'الوصول والتوجيه', 'description' => 'فحص المعدات وإحاطة السلامة'],
          ['day' => 2, 'title' => 'غوص الشعاب الضحلة', 'description' => 'أول غوصة على عمق 12 متر'],
          ['day' => 3, 'title' => 'غوص الحطام', 'description' => 'استكشاف حطام ثيستلجورم'],
          ['day' => 4, 'title' => 'غوص الشعاب العميقة', 'description' => 'غوصة متقدمة إلى 30 متر'],
          ['day' => 5, 'title' => 'يوم حر', 'description' => 'الغطس أو الاسترخاء'],
        ],
        'inclusions_en' => ['Diving equipment', 'Certified instructor', 'Boat trips', 'Accommodation', 'All meals'],
        'inclusions_ar' => ['معدات الغوص', 'مدرب معتمد', 'رحلات القارب', 'الإقامة', 'جميع الوجبات'],
        'exclusions_en' => ['Diving certification course', 'Travel insurance', 'Airport transfers'],
        'exclusions_ar' => ['دورة شهادة الغوص', 'تأمين السفر', 'النقل من المطار'],
        'terms_en' => 'Valid diving certification required',
        'terms_ar' => 'شهادة غوص سارية مطلوبة',
        'images' => [
          'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800',
          'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800',
        ],
      ],
    ];
  }
}
