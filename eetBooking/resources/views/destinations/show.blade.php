@extends('layouts.app')

@section('title', $destination->name_en . ' Packages - Egypt Express Travel')

@section('content')
  <div class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-4">
          <li><a href="/" class="text-gray-400 hover:text-gray-500">Home</a></li>
          <li class="flex items-center">
            <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
              <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
            </svg>
            <a href="{{ route('destinations.index') }}" class="ml-4 text-gray-400 hover:text-gray-500">Destinations</a>
          </li>
          <li class="flex items-center">
            <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
              <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
            </svg>
            <span class="ml-4 text-gray-900 font-bold" aria-current="page">{{ $destination->name_en }}</span>
          </li>
        </ol>
      </nav>

      <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-12">
        <div class="md:flex">
          <div class="md:flex-shrink-0 md:w-1/3 h-64 md:h-auto">
            @php
              $headerImage = data_get($destination->images, 0, 'https://images.unsplash.com/photo-1547127796-06bb04e4b315?auto=format&fit=crop&w=800&q=80');
              if (!Str::startsWith($headerImage, 'http')) {
                $headerImage = Storage::url($headerImage);
              }
             @endphp
            <x-image-with-skeleton :src="$headerImage" :alt="$destination->name_en" class="" />
          </div>
          <div class="p-8 md:p-12">
            <div class="uppercase tracking-widest text-sm text-sky-600 font-black mb-2">
              {{ $destination->city->name_en ?? 'Destination' }}
            </div>
            <h1 class="text-4xl font-black text-gray-900 mb-6 tracking-tight">{{ $destination->name_en }}</h1>
            <p class="text-gray-500 leading-relaxed text-lg">{{ $destination->description_en }}</p>
          </div>
        </div>
      </div>

      <h2 class="text-2xl font-black text-gray-900 mb-8 tracking-tight italic">Packages in {{ $destination->name_en }}
      </h2>

      <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        @forelse($packages as $package)
          @include('partials.package-card', ['package' => $package])
        @empty
          <div class="col-span-full py-24 text-center bg-white rounded-3xl border border-dashed border-gray-200">
            <p class="text-gray-400 italic">No specific packages for this destination yet. Check back soon!</p>
          </div>
        @endforelse
      </div>

      <div class="mt-12">
        {{ $packages->links() }}
      </div>
    </div>
  </div>
@endsection