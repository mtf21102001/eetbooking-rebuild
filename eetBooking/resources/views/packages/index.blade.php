@extends('layouts.app')

@section('title', 'Luxury Packages - Egypt Express Travel')

@section('content')
  <!-- Hero Section -->
  <div class="relative min-h-[80vh] flex items-center justify-center py-20 bg-gray-900 border-b border-gray-800">
    <div class="absolute inset-0 overflow-hidden">
      <img src="https://images.unsplash.com/photo-1568322445389-f64ac2515020?q=80&w=2070&auto=format&fit=crop"
        alt="Travel Background" class="w-full h-full object-cover opacity-60">
      <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-sky-900/40 to-transparent"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-12">
      <span class="text-sky-400 font-bold tracking-[0.2em] uppercase text-sm mb-4 block animate-fade-in-up">Discover
        Egypt</span>
      <h1
        class="text-6xl font-black text-white sm:text-8xl tracking-tight mb-8 font-serif drop-shadow-2xl animate-fade-in-up delay-100">
        Curated Journeys
      </h1>
      <p
        class="max-w-2xl mx-auto text-xl text-gray-100 font-medium leading-relaxed drop-shadow-md animate-fade-in-up delay-200">
        Handpicked luxury experiences tailored for memories that last a lifetime.
      </p>
    </div>
  </div>

  <div class="min-h-screen bg-gray-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="lg:grid lg:grid-cols-12 lg:gap-12">
        <!-- Sidebar Filters (Modernized) -->
        <aside class="hidden lg:block lg:col-span-3">
          <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sticky top-24">
            <div class="flex items-center justify-between mb-6">
              <h2 class="text-lg font-bold text-gray-900">Filters</h2>
              <a href="{{ route('packages.index') }}" class="text-xs font-bold text-sky-600 hover:text-sky-700">Reset</a>
            </div>

            <form action="{{ route('packages.index') }}" method="GET" class="space-y-8">
              <!-- Search -->
              <div>
                <label for="search"
                  class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Search</label>
                <div class="relative">
                  <span class="absolute left-3 top-2.5 text-gray-400">
                    <i class="fa-solid fa-search text-sm"></i>
                  </span>
                  <input type="text" name="search" id="search" value="{{ request('search') }}"
                    class="pl-9 w-full rounded-xl border-gray-200 bg-gray-50 text-sm focus:border-sky-500 focus:ring-sky-500 transition-shadow py-2.5"
                    placeholder="Pyramids, Luxor...">
                </div>
              </div>

              <!-- Price Range -->
              <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Budget (EGP)</label>
                <div class="flex items-center gap-2">
                  <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min"
                    class="w-full rounded-xl border-gray-200 bg-gray-50 text-sm focus:border-sky-500 focus:ring-sky-500 py-2.5 text-center">
                  <span class="text-gray-300">-</span>
                  <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max"
                    class="w-full rounded-xl border-gray-200 bg-gray-50 text-sm focus:border-sky-500 focus:ring-sky-500 py-2.5 text-center">
                </div>
              </div>

              <!-- Duration -->
              <div>
                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Duration</label>
                <div class="space-y-2">
                  <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="duration[]" value="short" {{ in_array('short', request('duration', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-sky-600 focus:ring-sky-500">
                    <span class="text-sm text-gray-600 group-hover:text-sky-600 transition">Short (1-3 Days)</span>
                  </label>
                  <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="duration[]" value="medium" {{ in_array('medium', request('duration', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-sky-600 focus:ring-sky-500">
                    <span class="text-sm text-gray-600 group-hover:text-sky-600 transition">Medium (4-7 Days)</span>
                  </label>
                  <label class="flex items-center gap-2 cursor-pointer group">
                    <input type="checkbox" name="duration[]" value="long" {{ in_array('long', request('duration', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-sky-600 focus:ring-sky-500">
                    <span class="text-sm text-gray-600 group-hover:text-sky-600 transition">Long (8+ Days)</span>
                  </label>
                </div>
              </div>

              <button type="submit"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg shadow-sky-600/20 text-sm font-bold text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition-all transform hover:-translate-y-0.5">
                Update Results
              </button>
            </form>
          </div>
        </aside>

        <!-- Main Listing -->
        <div class="lg:col-span-9">
          <!-- Results Header -->
          <div class="mb-6 flex items-center justify-between">
            <p class="text-gray-500 font-medium">Found <span
                class="text-gray-900 font-bold">{{ $packages->total() }}</span> experiences</p>
            <div class="flex items-center gap-2">
              <span class="text-sm text-gray-500">Sort by:</span>
              <form id="sortForm" action="{{ route('packages.index') }}" method="GET" class="inline-block">
                <!-- Preserve other filters -->
                @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                @if(request('min_price')) <input type="hidden" name="min_price" value="{{ request('min_price') }}"> @endif
                @if(request('max_price')) <input type="hidden" name="max_price" value="{{ request('max_price') }}"> @endif
                @if(request('duration'))
                  @foreach(request('duration') as $dur)
                    <input type="hidden" name="duration[]" value="{{ $dur }}">
                  @endforeach
                @endif

                <select name="sort" onchange="this.form.submit()"
                  class="border-none bg-transparent text-sm font-bold text-gray-900 focus:ring-0 cursor-pointer">
                  <option value="recommended" {{ request('sort') == 'recommended' ? 'selected' : '' }}>Recommended</option>
                  <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High
                  </option>
                  <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low
                  </option>
                  <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Added</option>
                </select>
              </form>
            </div>
          </div>

          <div id="packages-grid" class="grid gap-8 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
            @include('packages.partials.list', ['packages' => $packages])
          </div>

          <!-- Pagination / Load More -->
          <div class="mt-16 text-center">
            @if($packages->hasMorePages())
              <button id="load-more-btn" data-next-page="{{ $packages->currentPage() + 1 }}"
                class="inline-flex items-center px-8 py-4 border border-transparent text-sm font-bold rounded-full text-white bg-gray-900 hover:bg-gray-800 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <span id="load-more-text">Show More Experiences</span>
                <i id="load-more-icon" class="fa-solid fa-arrow-down ml-2 animate-bounce"></i>
                <i id="load-more-spinner" class="fa-solid fa-circle-notch fa-spin ml-2 hidden"></i>
              </button>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const loadMoreBtn = document.getElementById('load-more-btn');
      const grid = document.getElementById('packages-grid');

      if (!loadMoreBtn || !grid) return;

      loadMoreBtn.addEventListener('click', function () {
        const nextPage = this.getAttribute('data-next-page');
        if (!nextPage) return;

        const url = new URL(window.location.href);
        url.searchParams.set('page', nextPage);

        // UI Elements
        const btnText = document.getElementById('load-more-text');
        const btnIcon = document.getElementById('load-more-icon');
        const btnSpinner = document.getElementById('load-more-spinner');
        const originalText = 'Show More Experiences';

        // Set Loading State
        btnText.textContent = 'Loading...';
        btnIcon.style.display = 'none';      // Force hide arrow
        btnSpinner.style.display = 'inline-block'; // Force show spinner
        loadMoreBtn.disabled = true;
        loadMoreBtn.classList.add('opacity-75', 'cursor-not-allowed');

        fetch(url, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
          .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
          })
          .then(html => {
            // Check if content is empty (stricter check including whitespace)
            if (!html || html.replace(/\s/g, '').length === 0) {
              loadMoreBtn.remove();
              return;
            }

            // Append content
            grid.insertAdjacentHTML('beforeend', html);

            // Update next page
            loadMoreBtn.setAttribute('data-next-page', parseInt(nextPage) + 1);

            // Reset Button State
            btnText.textContent = originalText;
            btnIcon.style.display = 'inline-block'; // Restore arrow
            btnSpinner.style.display = 'none';      // Hide spinner
            loadMoreBtn.disabled = false;
            loadMoreBtn.classList.remove('opacity-75', 'cursor-not-allowed');
          })
          .catch(error => {
            console.error('Error loading packages:', error);
            btnText.textContent = 'Error - Try Again';

            // Reset Spinner on Error
            btnIcon.style.display = 'inline-block';
            btnSpinner.style.display = 'none';

            loadMoreBtn.disabled = false;
            loadMoreBtn.classList.remove('opacity-75', 'cursor-not-allowed');
          });
      });
    });
  </script>
@endpush