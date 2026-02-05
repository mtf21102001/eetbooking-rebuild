@extends('layouts.app')

@section('title', 'Destinations - Egypt Express Travel')

@section('content')
  <div class="bg-gray-900 py-24 relative overflow-hidden">
    <div class="absolute inset-0 opacity-40">
      <x-image-with-skeleton
        src="https://images.unsplash.com/photo-1553913861-c0fddf2619ee?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2000&q=80&quot"
        alt="Egypt Landscape" class="" />
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
      <h1 class="text-5xl font-black text-white tracking-tight mb-4 text-sky-400">Where to Next?</h1>
      <p class="text-xl text-gray-300 max-w-2xl mx-auto">Explore our curated destinations across Egypt. From the bustling
        streets of Cairo to the serene beaches of the Red Sea.</p>
    </div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <!-- Featured Destinations -->
    <div class="mb-20">
      <h2 class="text-3xl font-black text-gray-900 mb-10 tracking-tight">Featured Destinations</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($featured_destinations as $dest)
          <a href="{{ route('destinations.show', $dest) }}"
            class="group relative h-[400px] rounded-3xl overflow-hidden shadow-xl hover:shadow-sky-500/20 transition-all duration-500">
            @php
              $images = is_string($dest->images) ? json_decode($dest->images, true) : $dest->images;
              $imageUrl = !empty($images[0]) ? $images[0] : 'https://images.unsplash.com/photo-1547127796-06bb04e4b315?auto=format&fit=crop&w=800&q=80';
              if (!Str::startsWith($imageUrl, 'http')) {
                $imageUrl = Storage::url($imageUrl);
              }
             @endphp
            <x-image-with-skeleton :src="$imageUrl" class="group-hover:scale-110 transition-transform duration-700"
              :alt="$dest->name_en" />
            <div
              class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent flex flex-col justify-end p-8 pt-20">
              <p class="text-sky-400 font-bold uppercase tracking-widest text-xs mb-2">{{ $dest->city->name_en ?? 'Egypt' }}
              </p>
              <h4 class="text-2xl font-black text-white">{{ $dest->name_en }}</h4>
            </div>
          </a>
        @empty
          <div
            class="col-span-full py-12 text-center text-gray-400 bg-white rounded-3xl border border-dashed border-gray-200">
            No featured destinations found. Check back later!
          </div>
        @endforelse
      </div>
    </div>

    <!-- Countries & Cities -->
    <div>
      <h2 class="text-3xl font-black text-gray-900 mb-10 tracking-tight">Browse by Region</h2>
      <div class="space-y-12">
        @foreach($countries as $country)
          <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
            <div class="flex items-center space-x-4 mb-8">
              <div class="h-12 w-1.5 bg-sky-600 rounded-full"></div>
              <h3 class="text-2xl font-bold text-gray-900">{{ $country->name_en }}</h3>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
              @foreach($country->cities as $city)
                <a href="{{ route('destinations.city', $city) }}" class="flex flex-col items-center group">
                  <div
                    class="h-24 w-24 rounded-2xl bg-gray-50 flex items-center justify-center mb-3 group-hover:bg-sky-50 transition-colors">
                    <svg class="h-10 w-10 text-gray-300 group-hover:text-sky-500 transition-colors" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                  </div>
                  <span
                    class="text-sm font-bold text-gray-700 group-hover:text-sky-600 transition-colors">{{ $city->name_en }}</span>
                </a>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection