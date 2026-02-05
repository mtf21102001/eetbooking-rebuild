<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\TeamMember;
use App\Models\AboutSetting;
use Illuminate\Database\Seeder;

class ExampleAboutDataSeeder extends Seeder
{
  public function run(): void
  {
    // 1. Partners
    Partner::create([
      'name' => 'IATA Accreditation',
      'logo_path' => 'https://egyptexpresstvl.com/wp-content/uploads/2025/02/IATA.png',
      'website_url' => 'https://www.iata.org'
    ]);

    Partner::create([
      'name' => 'Global Destination Association',
      'logo_path' => 'https://egyptexpresstvl.com/wp-content/uploads/2025/02/GDA.png',
      'website_url' => 'https://example.com'
    ]);

    // 2. Team Members
    TeamMember::create([
      'name' => 'Ahmed Mansour',
      'role' => 'CEO & Founder',
      'image_path' => 'https://egyptexpresstvl.com/wp-content/uploads/2024/11/pqGIEoPLSQFPf3bkZLRNpMXIjyT2IBp4qkTgcufD.jpg',
      'bio' => 'Ahmed has over 20 years of experience in the Egyptian tourism industry.',
      'display_order' => 1
    ]);

    TeamMember::create([
      'name' => 'Sarah Johnson',
      'role' => 'Operations Manager',
      'image_path' => 'https://egyptexpresstvl.com/wp-content/uploads/2024/11/about-us-Small_01-150x150.webp',
      'bio' => 'Sarah ensures every trip is executed perfectly.',
      'display_order' => 2
    ]);

    // 3. Settings
    AboutSetting::setValue('hero_title', 'Discover Egypt & Beyond');
    AboutSetting::setValue('hero_subtitle', 'Your trusted partner for authentic travel experiences.');
  }
}
