<div
  class="flex flex-col rounded-3xl shadow-sm overflow-hidden bg-white border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
  <div class="flex-shrink-0 relative h-64 w-full">
    @php
      $mainImageObj = $package->mainImage();
      $rawImage = $mainImageObj ? $mainImageObj->url : data_get($package->images, 0);

      $cardImage = $rawImage ?? 'https://images.unsplash.com/photo-1547127796-06bb04e4b315?auto=format&fit=crop&w=1351&q=80';
      if (!Str::startsWith($cardImage, 'http')) {
        $cardImage = Storage::url($cardImage);
      }
     @endphp
    <x-image-with-skeleton :src="$cardImage" :alt="$package->name_en" class="" />
    <div
      class="absolute top-4 right-4 bg-sky-600 px-4 py-2 rounded-xl text-xs font-bold text-white shadow-xl shadow-sky-600/30">
      {{ $package->duration_days }} Days
    </div>
    <div class="absolute bottom-4 left-4 font-black text-white text-2xl drop-shadow-md">
      ${{ number_format($package->price, 0) }}
    </div>
  </div>
  <div class="flex-1 p-8 flex flex-col justify-between">
    <div class="flex-1">
      <p class="text-sm font-bold text-sky-600 uppercase tracking-tighter mb-2">
        Adventure Package
      </p>
      <a href="{{ route('packages.show', $package) }}" class="block">
        <p class="text-2xl font-bold text-gray-900 leading-snug">{{ $package->name_en }}</p>
        <p class="mt-4 text-gray-500 line-clamp-3 text-base leading-relaxed">
          {{ $package->description_en }}
        </p>
      </a>
    </div>
    <div class="mt-8 flex items-center justify-between pt-6 border-t border-gray-50">
      <div class="flex items-center space-x-1">
        <span class="text-amber-400">★★★★★</span>
        <span class="text-gray-400 text-xs">(4.9)</span>
      </div>
      <a href="{{ route('packages.show', $package) }}"
        class="text-sky-600 font-bold hover:text-sky-700 transition flex items-center group">
        Details
        <svg class="h-4 w-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24"
          stroke="currentColor font-bold">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
        </svg>
      </a>
    </div>
  </div>
</div>