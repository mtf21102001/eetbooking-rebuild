@extends('layouts.app')

@section('content')
  <!-- High-End Hero Section -->
  <section class="relative h-screen flex items-center justify-center overflow-hidden bg-gray-900">
    <!-- Parallax Background -->
    @php
      $heroImage = \App\Models\AboutSetting::getValue('hero_image', 'cairo.png');

      if ($heroImage === 'cairo.png' || $heroImage === 'public/cairo.png') {
        $heroImageSrc = asset('cairo.png');
      } elseif (Str::startsWith($heroImage, 'http')) {
        $heroImageSrc = $heroImage;
      } else {
        $heroImageSrc = Storage::url($heroImage);
      }
    @endphp
    <div class="absolute inset-0 z-0">
      <x-image-with-skeleton :src="$heroImageSrc" alt="Egypt Travel Hero"
        class="scale-100 motion-safe:animate-[parallax_20s_linear_infinite]" />
      <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70"></div>
    </div>

    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto" data-aos="zoom-out" data-aos-duration="1500">
      <span class="inline-block text-sky-400 font-bold tracking-[0.3em] uppercase mb-4 text-sm">Since
        {{ \App\Models\AboutSetting::getValue('since_year', '2003') }}</span>
      <h1 class="text-5xl md:text-7xl lg:text-8xl font-serif text-white mb-6 leading-tight">
        {{ \App\Models\AboutSetting::getValue('hero_title', 'Discover Egypt & Beyond') }}
      </h1>
      <p class="text-xl text-gray-200 font-light max-w-2xl mx-auto leading-relaxed italic">
        "{{ \App\Models\AboutSetting::getValue('hero_subtitle', 'Your trusted partner for authentic travel experiences.') }}"
      </p>
      <div class="mt-12 flex flex-col sm:flex-row gap-6 justify-center">
        <a href="#story"
          class="px-8 py-4 bg-sky-600 hover:bg-sky-500 text-white rounded-full transition duration-300 font-medium tracking-wide">Explore
          Our Story</a>
        <a href="/packages"
          class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white border border-white/30 backdrop-blur-md rounded-full transition duration-300 font-medium">View
          Packages</a>
      </div>
    </div>

    <!-- Animated Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10 animate-bounce">
      <div class="w-1 h-12 rounded-full bg-gradient-to-b from-sky-400 to-transparent"></div>
    </div>
  </section>

  <!-- Our Story (Asymmetric Layout) -->
  <section id="story" class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24">
        <!-- Asymmetric Image Box -->
        <div class="lg:w-1/2 relative" data-aos="fade-right">
          <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl">
            <img src="/images/about/big_02.webp" alt="Travel Culture" class="w-full h-auto">
          </div>
          <!-- Decorative Elements -->
          <div class="absolute -top-10 -left-10 w-40 h-40 bg-sky-50 rounded-full -z-0"></div>
          <div class="absolute -bottom-10 -right-10 w-64 h-64 border-8 border-gray-50 rounded-2xl -z-0"></div>
          <div class="absolute bottom-10 left-[-20%] p-8 bg-sky-600 text-white rounded-2xl shadow-xl hidden lg:block">
            <p class="text-4xl font-serif font-bold">20+</p>
            <p class="text-sm uppercase tracking-widest opacity-80">Years of Luxury</p>
          </div>
        </div>

        <div class="lg:w-1/2 space-y-8" data-aos="fade-left">
          <div
            class="inline-block px-4 py-1 rounded-full bg-sky-50 text-sky-600 font-bold text-xs uppercase tracking-widest">
            Crafting Memories</div>
          <h2 class="text-4xl md:text-5xl font-serif text-gray-900 leading-snug">
            Crafting Unforgettable <span
              class="text-sky-600 underline decoration-sky-200 underline-offset-8">Journeys</span>.
          </h2>
          <div class="prose prose-lg text-gray-600 font-light leading-relaxed">
            {!! \App\Models\AboutSetting::getValue('mission_text', 'Egypt Express Travel (EET) is a premier travel management company dedicated to providing comprehensive travel solutions. With a passion for excellence and a commitment to customer satisfaction, we have established ourselves as a leader in the Egyptian tourism industry.') !!}
          </div>
          <div class="grid grid-cols-2 gap-8 pt-6">
            <div>
              <h4 class="text-lg font-bold text-gray-900 mb-2 font-serif">Global Reach</h4>
              <p class="text-sm text-gray-500">Connecting destinations worldwide through our extensive network.</p>
            </div>
            <div>
              <h4 class="text-lg font-bold text-gray-900 mb-2 font-serif">Expert Curation</h4>
              <p class="text-sm text-gray-500">Every itinerary is hand-crafted by our local specialists.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Values Section (Modern Grid) -->
  <section class="py-24 bg-gray-900 relative">
    <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-white to-transparent opacity-10"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-3xl md:text-5xl font-serif text-white mb-4">Our Core Values</h2>
        <div class="w-24 h-1 bg-sky-500 mx-auto rounded-full"></div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <!-- Mission Card -->
        <div
          class="group relative p-10 bg-white/5 border border-white/10 rounded-3xl backdrop-blur-md hover:bg-white/10 transition duration-500"
          data-aos="fade-up">
          <div
            class="w-16 h-16 bg-sky-600/20 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition duration-500">
            <svg class="w-8 h-8 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z">
              </path>
            </svg>
          </div>
          <h3 class="text-2xl font-serif text-white mb-6">Our Mission</h3>
          <p class="text-gray-400 font-light leading-relaxed text-lg">
            {!! \App\Models\AboutSetting::getValue('mission_text', 'To build our reputation by creating unique and socially responsible travel experiences.') !!}
          </p>
          <div
            class="absolute top-4 right-4 text-white/5 text-8xl font-bold font-serif -z-10 group-hover:text-white/10 transition duration-500">
            01</div>
        </div>

        <!-- Vision Card -->
        <div
          class="group relative p-10 bg-white/5 border border-white/10 rounded-3xl backdrop-blur-md hover:bg-white/10 transition duration-500"
          data-aos="fade-up" data-aos-delay="200">
          <div
            class="w-16 h-16 bg-sky-600/20 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 transition duration-500">
            <svg class="w-8 h-8 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
              </path>
            </svg>
          </div>
          <h3 class="text-2xl font-serif text-white mb-6">Our Vision</h3>
          <p class="text-gray-400 font-light leading-relaxed text-lg">
            {!! \App\Models\AboutSetting::getValue('vision_text', 'To achieve our ambition in becoming one of the leading tourism companies in the region, recognized for quality and social responsibility.') !!}
          </p>
          <div
            class="absolute top-4 right-4 text-white/5 text-8xl font-bold font-serif -z-10 group-hover:text-white/10 transition duration-500">
            02</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Team Section (Hover Reveal Effect) -->
  <section class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
        <div data-aos="fade-up">
          <span class="text-sky-600 font-bold uppercase tracking-[0.3em] text-xs">The Faces Behind EET</span>
          <h2 class="text-4xl md:text-5xl font-serif text-gray-900 mt-4 leading-tight">Meet Our <span
              class="text-sky-600">Travel Experts</span></h2>
        </div>
        <p class="max-w-md text-gray-500 font-light italic" data-aos="fade-up" data-aos-delay="100">
          Our team of dedicated professionals is here to ensure your journey is seamless and unforgettable.
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($teamMembers as $member)
          <div class="group relative h-[500px] overflow-hidden rounded-3xl bg-gray-200 cursor-pointer" data-aos="fade-up"
            data-aos-delay="{{ $loop->index * 100 }}">
            <!-- Image -->
            <x-image-with-skeleton :src="Str::startsWith($member->image_path, 'http') ? $member->image_path : Storage::url($member->image_path)" :alt="$member->name"
              class="transition duration-700 group-hover:scale-110" />

            <!-- Overlay Layer -->
            <div
              class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-black/95 via-black/60 to-transparent translate-y-24 group-hover:translate-y-0 transition duration-500 ease-out">
            </div>

            <!-- Content -->
            <div
              class="absolute inset-x-0 bottom-0 p-8 transform translate-y-12 group-hover:translate-y-0 transition duration-500 ease-out">
              <h4 class="text-2xl font-serif text-white mb-1">{{ $member->name }}</h4>
              <p class="text-sky-400 font-bold text-xs uppercase tracking-[0.2em] mb-4">{{ $member->role }}</p>

              <div
                class="overflow-hidden h-0 group-hover:h-32 transition-all duration-500 ease-out opacity-0 group-hover:opacity-100">
                <p class="text-gray-300 font-light text-sm italic leading-relaxed pt-2 border-t border-white/10">
                  {{ $member->bio }}
                </p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Partners (Elite Grayscale Roll) -->
  <section class="py-20 bg-gray-50 border-y border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-wrap justify-center items-center gap-12 md:gap-24">
        @foreach($partners as $partner)
          <div class="group relative" data-aos="fade-in" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="h-12 md:h-16 w-auto">
              <x-image-with-skeleton :src="Str::startsWith($partner->logo_path, 'http') ? $partner->logo_path : Storage::url($partner->logo_path)" :alt="$partner->name"
                class="object-contain grayscale opacity-40 group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-110 transition duration-500 cursor-pointer" />
            </div>
            @if($partner->website_url)
              <a href="{{ $partner->website_url }}" target="_blank" class="absolute inset-0 z-10"
                title="{{ $partner->name }}"></a>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Call to Action (Floating Glassmorphism) -->
  <section class="py-24 bg-sky-600 relative overflow-hidden">
    <!-- Abstract Shapes -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-black/10 rounded-full blur-3xl"></div>

    <div class="max-w-5xl mx-auto px-4 text-center relative z-10">
      <h2 class="text-4xl md:text-6xl font-serif text-white mb-8" data-aos="fade-up">Ready for your next adventure?</h2>
      <p class="text-xl text-sky-100 font-light mb-12 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
        Join thousands of happy travelers and experience Egypt like never before. Let our experts craft your dream
        itinerary today.
      </p>
      <div class="flex flex-col sm:flex-row gap-6 justify-center" data-aos="fade-up" data-aos-delay="200">
        <a href="/contact"
          class="px-10 py-5 bg-white text-sky-600 font-bold rounded-full shadow-2xl hover:bg-sky-50 transition duration-300 scale-100 hover:scale-105">Get
          in Touch</a>
        <a href="/packages"
          class="px-10 py-5 bg-sky-800 text-white font-bold rounded-full shadow-2xl hover:bg-sky-700 transition duration-300 border border-sky-400/30">Browse
          Tours</a>
      </div>
    </div>
  </section>

  @push('styles')
    <style>
      @keyframes parallax {
        0% {
          transform: scale(1.1) translateY(0);
        }

        50% {
          transform: scale(1.15) translateY(-20px);
        }

        100% {
          transform: scale(1.1) translateY(0);
        }
      }
    </style>
  @endpush

@endsection