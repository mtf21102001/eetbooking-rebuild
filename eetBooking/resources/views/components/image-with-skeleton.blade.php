@props(['src', 'alt' => '', 'class' => ''])

<div class="relative w-full h-full overflow-hidden {{ $class }}" x-data="{ loaded: false }">
  <!-- Skeleton Loader -->
  <div x-show="!loaded" class="absolute inset-0 flex items-center justify-center bg-gray-200 animate-pulse z-10">
    <svg class="w-12 h-12 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
      fill="none" viewBox="0 0 24 24">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="m3 16 5-7 6 6.5m6.5 2.5L16 13l-4.286 6M14 10h.01M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
    </svg>
  </div>

  <!-- Actual Image -->
  <img src="{{ $src }}" alt="{{ $alt }}" loading="lazy" @load="loaded = true" {{ $attributes->merge(['class' => 'w-full h-full object-cover transition-opacity duration-500']) }} :class="{ 'opacity-100': loaded, 'opacity-0': !loaded }">
</div>