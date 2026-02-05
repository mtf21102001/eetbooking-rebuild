@extends('layouts.app')

@section('title', 'Visa Requirements - Egypt Express Travel')

@section('content')
  <div class="bg-gray-50 min-h-screen pt-32 pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Header -->
      <div class="mb-12" data-aos="fade-up">
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 font-sans">Visa Requirements</h1>
        <p class="text-gray-500 text-lg">Select your destination and nationality to view exact fees and documents.</p>
      </div>

      <!-- Search Bar -->
      <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 mb-12" data-aos="fade-up">
        <form action="{{ route('visas.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
          <div class="space-y-1">
            <label class="text-sm font-bold text-gray-700">Where are you going?</label>
            <select name="destination_id"
              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500">
              <option value="">All Destinations</option>
              @foreach($destinations as $dest)
                <option value="{{ $dest->id }}" {{ request('destination_id') == $dest->id ? 'selected' : '' }}>
                  {{ $dest->name_en }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="space-y-1">
            <label class="text-sm font-bold text-gray-700">Nationality</label>
            <select name="nationality_id"
              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500">
              <option value="">Your Passport</option>
              @foreach($nationalities as $nat)
                <option value="{{ $nat->id }}" {{ request('nationality_id') == $nat->id ? 'selected' : '' }}>
                  {{ $nat->name }}
                </option>
              @endforeach
            </select>
          </div>
          <button type="submit"
            class="py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition shadow-lg shadow-blue-600/20">
            Filter Results
          </button>
        </form>
      </div>

      <!-- Visa Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($visas as $visa)
          <div
            class="group bg-white rounded-[2rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-500"
            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="relative h-64 overflow-hidden">
              <img
                src="{{ $visa->image_url ? Storage::url($visa->image_url) : 'https://images.unsplash.com/photo-1544027993-37dbfe43552e?auto=format&fit=crop&w=800&q=80' }}"
                alt="{{ $visa->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
              <div class="absolute bottom-6 left-6 text-white">
                <h3 class="text-2xl font-black mb-1">{{ $visa->title }}</h3>
                <p class="text-sm font-bold opacity-90">{{ $visa->destination->name_en }}</p>
              </div>
            </div>
            <div class="p-8">
              <div class="flex items-center gap-4 mb-6">
                <div class="p-3 bg-blue-50 rounded-2xl text-blue-600">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <div>
                  <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Processing Time</p>
                  <p class="text-lg font-black text-gray-900">{{ $visa->processing_time ?? 'Contact Us' }}</p>
                </div>
              </div>

              <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                <div>
                  <span class="text-xs text-gray-400 font-bold">Starting from</span>
                  <p class="text-2xl font-black text-blue-600">{{ $visa->price }} {{ $visa->currency }}</p>
                </div>
                <a href="{{ route('visas.show', ['visa' => $visa->id, 'nationality_id' => request('nationality_id')]) }}"
                  class="px-6 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-blue-600 transition shadow-lg shadow-blue-900/10">
                  View Details
                </a>
              </div>
            </div>
          </div>
        @empty
          <div class="col-span-full py-24 text-center">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400">
              <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                </path>
              </svg>
            </div>
            <h3 class="text-2xl font-black text-gray-900 mb-2">No Visas Found</h3>
            <p class="text-gray-500">We couldn't find any visa requirements matching your search.</p>
          </div>
        @endforelse
      </div>
    </div>
  </div>
@endsection