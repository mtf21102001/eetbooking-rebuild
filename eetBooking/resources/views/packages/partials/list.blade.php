@forelse($packages as $package)
  <div
    class="group flex flex-col bg-white rounded-[2rem] shadow-sm hover:shadow-2xl hover:shadow-sky-900/5 hover:-translate-y-1 transition-all duration-500 overflow-hidden border border-gray-100 relative">

    <!-- Image Container -->
    <div class="relative h-72 overflow-hidden">
      @php
        $images = $package->images;
        if (empty($images)) {
          $imageUrl = 'https://images.unsplash.com/photo-1547127796-06bb04e4b315?ixlib=rb-1.2.1&auto=format&fit=crop&w=1351&q=80';
        } else {
          $firstImage = is_array($images) ? ($images[0] ?? null) : $images->first();
          $imageUrl = $firstImage ? (Str::startsWith($firstImage, 'http') ? $firstImage : Storage::url($firstImage)) : 'https://images.unsplash.com/photo-1547127796-06bb04e4b315?ixlib=rb-1.2.1&auto=format&fit=crop&w=1351&q=80';
        }
      @endphp

      <x-image-with-skeleton :src="$imageUrl" :alt="$package->name_en"
        class="transition-transform duration-700 group-hover:scale-110" />

      <!-- Gradient Overlay -->
      <div
        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity">
      </div>

      <!-- Badges -->
      <div class="absolute top-4 left-4 flex flex-col gap-2">
        @if($package->is_offer && $package->offer_tag)
          <span
            class="px-3 py-1 bg-sky-600 text-white text-[10px] font-black uppercase tracking-wider rounded-lg shadow-lg shadow-sky-600/20 backdrop-blur-md">
            {{ $package->offer_tag }}
          </span>
        @endif

        @if($package->discount_percentage > 0)
          <span
            class="self-start px-3 py-1 bg-red-500 text-white text-[10px] font-black uppercase tracking-wider rounded-lg shadow-lg backdrop-blur-md">
            {{ $package->discount_percentage }}% OFF
          </span>
        @endif
      </div>

      <!-- Quick Stats Overlay on Image -->
      <div class="absolute bottom-4 left-4 right-4 text-white">
        <div class="flex items-center gap-4 text-xs font-bold mb-2 opacity-90">
          <div class="flex items-center gap-1 bg-white/20 backdrop-blur-md px-2 py-1 rounded-lg">
            <i class="fa-regular fa-clock"></i>
            {{ $package->duration_days }} Days
          </div>
          @if($package->rating)
            <div class="flex items-center gap-1 bg-yellow-400/20 backdrop-blur-md px-2 py-1 rounded-lg text-yellow-300">
              <i class="fa-solid fa-star text-yellow-400"></i>
              {{ $package->rating }}
            </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="flex-1 p-6 flex flex-col">
      <div class="flex-1">
        <a href="{{ route('packages.show', $package) }}" class="block group/title">
          <div class="flex justify-between items-start mb-2">
            <h3 class="text-xl font-bold text-gray-900 group-hover/title:text-sky-600 transition-colors leading-tight">
              {{ $package->name_en }}
            </h3>
          </div>
          <p class="mt-2 text-sm text-gray-500 line-clamp-2 leading-relaxed">
            {{ $package->description_en }}
          </p>
        </a>
      </div>

      <!-- Footer -->
      <div class="mt-6 pt-6 border-t border-gray-50 flex items-center justify-between">
        <div class="flex flex-col">
          <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Starting from</span>
          <div class="flex items-baseline gap-2">
            <span class="text-2xl font-black text-gray-900 group-hover:text-sky-600 transition-colors">
              ${{ number_format($package->price, 0) }}
            </span>
            @if($package->discount_percentage > 0 && $package->original_price)
              <span class="text-sm font-medium text-gray-400 line-through">
                ${{ number_format($package->original_price, 0) }}
              </span>
            @endif
          </div>
        </div>
        <a href="{{ route('packages.show', $package) }}"
          class="h-10 w-10 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 group-hover:bg-sky-600 group-hover:text-white transition-all duration-300 shadow-sm">
          <i
            class="fa-solid fa-arrow-right transform -rotate-45 group-hover:rotate-0 transition-transform duration-300"></i>
        </a>
      </div>
    </div>
  </div>
@empty
  {{-- Only show empty state if on first page. If loading more and no results, button just hides via JS --}}
  @if(request('page', 1) == 1)
    <div class="col-span-full py-24 text-center">
      <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
        <i class="fa-regular fa-compass text-3xl"></i>
      </div>
      <h3 class="text-lg font-bold text-gray-900">No journeys found</h3>
      <p class="mt-2 text-gray-500">We couldn't find any packages matching your criteria.</p>
      <div class="mt-8">
        <a href="{{ route('packages.index') }}"
          class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-bold rounded-xl text-white bg-sky-600 hover:bg-sky-700 transition shadow-lg shadow-sky-600/20">
          Clear All Filters
        </a>
      </div>
    </div>
  @endif
@endforelse