<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
  public function run(): void
  {
    // Ensure Egypt exists
    $egypt = Country::firstOrCreate(
      ['iso_code' => 'EGY'],
      ['name_en' => 'Egypt', 'name_ar' => 'مصر', 'is_active' => true]
    );

    $destinations = [
      'Cairo' => [
        'name_ar' => 'القاهرة',
        'destinations' => [
          [
            'name_en' => 'Giza Pyramids',
            'name_ar' => 'أهرامات الجيزة',
            'description_en' => 'The Great Pyramids of Giza and the Sphinx.',
            'description_ar' => 'أهرامات الجيزة العظيمة وأبو الهول.',
            'is_featured' => true,
            'rating' => 4.9,
            'images' => ['https://images.unsplash.com/photo-1599571234935-8b8004f14760?w=800'],
          ],
          [
            'name_en' => 'Egyptian Museum',
            'name_ar' => 'المتحف المصري',
            'description_en' => 'Home to the largest collection of ancient Egyptian antiquities.',
            'description_ar' => 'موطن لأكبر مجموعة من الآثار المصرية القديمة.',
            'is_featured' => false,
            'rating' => 4.7,
            'images' => ['https://images.unsplash.com/photo-1572252009286-268acec5a0af?w=800'],
          ],
          [
            'name_en' => 'Khan el-Khalili',
            'name_ar' => 'خان الخليلي',
            'description_en' => 'A famous bazaar and souq in the historic center of Cairo.',
            'description_ar' => 'بازار وسوق شهير في المركز التاريخي للقاهرة.',
            'is_featured' => true,
            'rating' => 4.6,
            'images' => ['https://images.unsplash.com/photo-1553913861-c0fddf2619ee?w=800'],
          ],
        ],
      ],
      'Luxor' => [
        'name_ar' => 'الأقصر',
        'destinations' => [
          [
            'name_en' => 'Karnak Temple',
            'name_ar' => 'معبد الكرنك',
            'description_en' => 'Ranking among the world’s largest ancient temples.',
            'description_ar' => 'يصنف من بين أكبر المعابد القديمة في العالم.',
            'is_featured' => true,
            'rating' => 4.9,
            'images' => ['https://images.unsplash.com/photo-1503177119275-0aa32b3a9368?w=800'],
          ],
          [
            'name_en' => 'Valley of the Kings',
            'name_ar' => 'وادي الملوك',
            'description_en' => 'Royal burial ground for pharaohs such as Tutankhamun.',
            'description_ar' => 'مدفن ملكي للفراعنة مثل توت عنخ آمون.',
            'is_featured' => true,
            'rating' => 4.9,
            'images' => ['https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800'],
          ],
          [
            'name_en' => 'Luxor Temple',
            'name_ar' => 'معبد الأقصر',
            'description_en' => 'A large Ancient Egyptian temple complex located on the east bank.',
            'description_ar' => 'مجمع معابد مصري قديم كبير يقع على الضفة الشرقية.',
            'is_featured' => false,
            'rating' => 4.8,
            'images' => ['https://images.unsplash.com/photo-1596525996025-a4f5f595f9c6?w=800'],
          ],
        ],
      ],
      'Aswan' => [
        'name_ar' => 'أسوان',
        'destinations' => [
          [
            'name_en' => 'Philae Temple',
            'name_ar' => 'معبد فيلة',
            'description_en' => 'An island temple complex dedicated to the goddess Isis.',
            'description_ar' => 'مجمع معابد جزيرة مخصص للإلهة إيزيس.',
            'is_featured' => true,
            'rating' => 4.8,
            'images' => ['https://images.unsplash.com/photo-1539650116455-8efdbcc612d4?w=800'],
          ],
          [
            'name_en' => 'Abu Simbel',
            'name_ar' => 'أبو سمبل',
            'description_en' => 'Two massive rock-cut temples in the village of Abu Simbel.',
            'description_ar' => 'معبدان صخريان ضخمان في قرية أبو سمبل.',
            'is_featured' => true,
            'rating' => 5.0,
            'images' => ['https://images.unsplash.com/photo-1560124376-7495753db823?w=800'],
          ],
        ],
      ],
      'Hurghada' => [
        'name_ar' => 'الغردقة',
        'destinations' => [
          [
            'name_en' => 'Giftun Island',
            'name_ar' => 'جزيرة الجفتون',
            'description_en' => 'A protected island with sandy beaches and coral reefs.',
            'description_ar' => 'جزيرة محمية ذات شواطئ رملية وشعاب مرجانية.',
            'is_featured' => true,
            'rating' => 4.7,
            'images' => ['https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800'],
          ],
        ],
      ],
      'Sharm El Sheikh' => [
        'name_ar' => 'شرم الشيخ',
        'destinations' => [
          [
            'name_en' => 'Ras Mohammed',
            'name_ar' => 'رأس محمد',
            'description_en' => 'A national park at the southern extreme of the Sinai Peninsula.',
            'description_ar' => 'حديقة وطنية في أقصى جنوب شبه جزيرة سيناء.',
            'is_featured' => true,
            'rating' => 4.9,
            'images' => ['https://images.unsplash.com/photo-1510312305653-8ed496efae75?w=800'],
          ],
        ],
      ],
      'Alexandria' => [
        'name_ar' => 'الإسكندرية',
        'destinations' => [
          [
            'name_en' => 'Bibliotheca Alexandrina',
            'name_ar' => 'مكتبة الإسكندرية',
            'description_en' => 'A major library and cultural center located on the shore.',
            'description_ar' => 'مكتبة كبرى ومركز ثقافي يقع على الشاطئ.',
            'is_featured' => true,
            'rating' => 4.8,
            'images' => ['https://images.unsplash.com/photo-1627931674404-51f7f0e69814?w=800'],
          ],
        ],
      ],
      'Siwa' => [
        'name_ar' => 'سيوة',
        'destinations' => [
          [
            'name_en' => 'Cleopatra\'s Bath',
            'name_ar' => 'حمام كليوباترا',
            'description_en' => 'A famous natural spring in the Siwa Oasis.',
            'description_ar' => 'نبع طبيعي شهير في واحة سيوة.',
            'is_featured' => false,
            'rating' => 4.5,
            'images' => ['https://images.unsplash.com/photo-1547234935-80c7142ee969?w=800'],
          ],
        ],
      ],
    ];

    foreach ($destinations as $cityNameEn => $cityData) {
      $city = City::firstOrCreate(
        ['name_en' => $cityNameEn, 'country_id' => $egypt->id],
        ['name_ar' => $cityData['name_ar'], 'is_active' => true]
      );

      foreach ($cityData['destinations'] as $destData) {
        Destination::firstOrCreate(
          ['city_id' => $city->id, 'name_en' => $destData['name_en']],
          [
            'name_ar' => $destData['name_ar'],
            'description_en' => $destData['description_en'],
            'description_ar' => $destData['description_ar'],
            'images' => $destData['images'],
            'is_featured' => $destData['is_featured'],
            'is_recommended' => $destData['is_featured'], // Default recommendation logic
            'rating' => $destData['rating'],
          ]
        );
      }
    }
  }
}
