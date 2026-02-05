@extends('layouts.app')

@section('title', $package->name_en . ' - Egypt Express Travel')

@section('content')
  @php
    $images = $package->images;
    $mainImage = count($images) > 0
      ? (Str::startsWith($images[0], 'http') ? $images[0] : Storage::url($images[0]))
      : 'https://images.unsplash.com/photo-1547127796-06bb04e4b315?ixlib=rb-1.2.1&auto=format&fit=crop&w=1351&q=80';

    // Get current translation for dynamic content
    $translation = $package->translate(app()->getLocale()) ?? $package->translate('en');
    $itinerary = $translation->itinerary ?? [];
    $inclusions = $translation->inclusions ?? [];
    $exclusions = $translation->exclusions ?? [];
  @endphp

  <!-- Immersive Hero Section -->
  <div class="relative h-[70vh] w-full overflow-hidden">
    <div class="absolute inset-0">
      <img src="{{ $mainImage }}" alt="{{ $package->name_en }}" class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
    </div>

    <div class="absolute bottom-0 left-0 right-0 pb-16 pt-32 bg-gradient-to-t from-gray-900 to-transparent">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
          <div class="animate-fade-in-up">
            <div class="flex items-center gap-3 mb-4 text-sm font-bold text-sky-400 uppercase tracking-widest">
              <a href="{{ route('packages.index') }}" class="hover:text-white transition">Packages</a>
              <i class="fa-solid fa-chevron-right text-[10px] text-gray-500"></i>
              <span class="text-white">{{ $package->destination->name_en ?? 'Egypt' }}</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-black text-white font-serif mb-4 drop-shadow-lg leading-tight">
              {{ $package->name_en }}
            </h1>
            <div class="flex items-center gap-6 text-gray-300 font-medium">
              <div class="flex items-center gap-2">
                <i class="fa-regular fa-clock text-sky-500"></i>
                <span>{{ $package->duration_days }} Days</span>
              </div>
              @if($package->rating)
                <div class="flex items-center gap-2">
                  <i class="fa-solid fa-star text-yellow-500"></i>
                  <span class="text-white">{{ $package->rating }} <span class="text-gray-500 font-normal">/ 5</span></span>
                </div>
              @endif
              @if($package->best_season)
                <div class="flex items-center gap-2">
                  <i class="fa-regular fa-calendar text-sky-500"></i>
                  <span>{{ $package->best_season }}</span>
                </div>
              @endif
            </div>
          </div>

          <!-- Price Badge on Mobile -->
          <div class="md:hidden">
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-4 text-white">
              <p class="text-xs text-gray-300 uppercase tracking-wider mb-1">Starting from</p>
              <div class="flex items-baseline gap-2">
                <span class="text-3xl font-bold">${{ number_format($package->price, 0) }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-white min-h-screen relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

        <!-- Main Content -->
        <div class="lg:col-span-8 space-y-12 pb-24">

          <!-- Quick Stats Grid -->
          <div class="bg-white rounded-3xl shadow-xl p-8 grid grid-cols-2 lg:grid-cols-3 gap-6 border border-gray-100">
            <div class="text-center p-4 rounded-2xl bg-gray-50">
              <i class="fa-solid fa-person-hiking text-3xl text-sky-600 mb-3"></i>
              <p class="text-xs text-gray-500 uppercase tracking-wider font-bold">Difficulty</p>
              <p class="font-bold text-gray-900">{{ $package->difficulty_level ?? 'Moderate' }}</p>
            </div>
            <div class="text-center p-4 rounded-2xl bg-gray-50">
              <i class="fa-solid fa-users text-3xl text-sky-600 mb-3"></i>
              <p class="text-xs text-gray-500 uppercase tracking-wider font-bold">Group Size</p>
              <p class="font-bold text-gray-900">{{ $package->min_people }} - {{ $package->max_people }}</p>
            </div>
            @if($package->distance_from_center)
              <div class="text-center p-4 rounded-2xl bg-gray-50">
                <i class="fa-solid fa-location-crosshairs text-3xl text-sky-600 mb-3"></i>
                <p class="text-xs text-gray-500 uppercase tracking-wider font-bold">Center Dist.</p>
                <p class="font-bold text-gray-900">{{ $package->distance_from_center }} km</p>
              </div>
            @endif
          </div>

          <!-- Gallery Scroll (Horizontal Strip) -->
          @if(count($images) > 0)
            <div>
              <h2 class="text-2xl font-black text-gray-900 font-serif mb-6 flex items-center gap-3">
                <i class="fa-regular fa-images text-sky-600"></i> Gallery
              </h2>
              <!-- Scroll Container -->
              <div class="flex overflow-x-auto pb-6 gap-4 snap-x snap-mandatory scrollbar-hide">
                @foreach($images as $image)
                  @php
                    $imgUrl = Str::startsWith($image, 'http') ? $image : Storage::url($image);
                  @endphp
                  <div class="flex-none snap-center">
                    <img src="{{ $imgUrl }}"
                      class="h-[300px] w-auto max-w-[80vw] md:max-w-[400px] rounded-2xl shadow-lg object-cover hover:scale-[1.02] transition-transform duration-300"
                      alt="Gallery Image">
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- Description -->
          <div>
            <h2 class="text-2xl font-black text-gray-900 font-serif mb-6 flex items-center gap-3">
              <i class="fa-solid fa-align-left text-sky-600"></i> Overview
            </h2>
            <div class="prose prose-lg prose-sky text-gray-600 leading-relaxed max-w-none">
              {!! $translation->description !!}
            </div>
          </div>

          <!-- Itinerary (Dynamic) -->
          @if(!empty($itinerary))
            <div>
              <h2 class="text-2xl font-black text-gray-900 font-serif mb-6 flex items-center gap-3">
                <i class="fa-solid fa-route text-sky-600"></i> Itinerary
              </h2>
              <div class="space-y-4">
                @foreach($itinerary as $day)
                  <div
                    class="flex gap-4 md:gap-6 p-6 rounded-2xl hover:bg-gray-50 transition border border-transparent hover:border-gray-100 items-start">
                    <div class="flex-shrink-0 w-12 md:w-16 text-center pt-1">
                      <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Day</span>
                      <span class="block text-2xl md:text-3xl font-black text-sky-600">{{ $loop->iteration }}</span>
                    </div>
                    <div>
                      <h4 class="text-lg md:text-xl font-bold text-gray-900 mb-2">
                        {{ $day['day_title'] ?? 'Day ' . $loop->iteration }}</h4>
                      <p class="text-gray-600 text-sm md:text-base leading-relaxed whitespace-pre-line">
                        {{ $day['day_description'] ?? '' }}</p>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          <!-- Inclusions / Exclusions -->
          <div class="grid md:grid-cols-2 gap-8">
            @if(!empty($inclusions))
              <div class="bg-green-50/50 rounded-2xl p-6 border border-green-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                  <i class="fa-solid fa-check-circle text-green-600"></i> Included
                </h3>
                <ul class="space-y-3">
                  @foreach($inclusions as $inc)
                    <li class="flex items-start gap-3 text-sm text-gray-700">
                      <span class="mt-1 w-1.5 h-1.5 rounded-full bg-green-500 flex-shrink-0"></span>
                      <span>{{ $inc }}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            @endif

            @if(!empty($exclusions))
              <div class="bg-red-50/50 rounded-2xl p-6 border border-red-100">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                  <i class="fa-solid fa-times-circle text-red-600"></i> Not Included
                </h3>
                <ul class="space-y-3">
                  @foreach($exclusions as $exc)
                    <li class="flex items-start gap-3 text-sm text-gray-700">
                      <span class="mt-1 w-1.5 h-1.5 rounded-full bg-red-400 flex-shrink-0"></span>
                      <span>{{ $exc }}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            @endif
          </div>

        </div>

        <!-- Sticky Sidebar -->
        <div class="hidden lg:block lg:col-span-4">
          <div class="sticky top-32 space-y-8">

            <!-- Booking Card -->
            <div
              class="bg-white rounded-3xl shadow-[0_20px_50px_rgba(8,_112,_184,_0.1)] border border-gray-100 p-8 overflow-hidden relative">
              <div class="absolute top-0 right-0 w-32 h-32 bg-sky-50 rounded-full -mr-16 -mt-16 blur-2xl"></div>

              <div class="relative">
                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Total Price</p>
                <div class="flex items-end gap-3 mb-6">
                  <span
                    class="text-5xl font-black text-gray-900 font-serif">${{ number_format($package->price, 0) }}</span>
                  @if($package->discount_percentage > 0)
                    <div class="mb-2">
                      <span
                        class="text-lg text-gray-400 line-through block">${{ number_format($package->original_price, 0) }}</span>
                      <span
                        class="bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded-full">{{ $package->discount_percentage }}%
                        OFF</span>
                    </div>
                  @endif
                </div>

                <div class="space-y-4 mb-8">
                  <div class="flex items-center justify-between text-sm text-gray-600 border-b border-gray-50 pb-3">
                    <span class="flex items-center gap-2"><i class="fa-regular fa-calendar-check text-sky-500"></i> Best
                      Season</span>
                    <span class="font-bold text-gray-900">{{ $package->best_season ?? 'All Year' }}</span>
                  </div>
                  <div class="flex items-center justify-between text-sm text-gray-600 border-b border-gray-50 pb-3">
                    <span class="flex items-center gap-2"><i class="fa-solid fa-map-location-dot text-sky-500"></i>
                      Location</span>
                    <span class="font-bold text-gray-900">{{ $package->distance_from_center ?? 'Central' }} km from
                      center</span>
                  </div>
                </div>

                <a href="{{ route('bookings.create', ['package_id' => $package->id]) }}"
                  class="block w-full py-4 rounded-xl bg-gray-900 hover:bg-sky-600 text-white font-bold text-center text-lg shadow-lg hover:shadow-sky-600/30 transform hover:-translate-y-1 transition duration-300">
                  Book Now
                </a>

                <p class="mt-4 text-center text-xs text-gray-400 flex items-center justify-center gap-2">
                  <i class="fa-solid fa-shield-halved"></i> No payment required to reserve
                </p>
              </div>
            </div>

            <!-- Assistance Card -->
            <div class="bg-sky-50 rounded-3xl p-8 border border-sky-100 text-center">
              <h3 class="font-bold text-gray-900 text-lg mb-2">Need Help Booking?</h3>
              <p class="text-gray-500 text-sm mb-6">Our travel experts are available 24/7 to help you plan your perfect
                trip.</p>
              <a href="https://wa.me/201234567890" target="_blank"
                class="inline-flex items-center gap-2 text-sky-700 font-bold hover:text-sky-900 transition">
                <i class="fa-brands fa-whatsapp text-xl"></i> Chat on WhatsApp
              </a>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
@endsection