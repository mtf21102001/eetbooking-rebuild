@extends('layouts.app')

@section('title', 'Egypt Express Travel - Discover Your Life')

@section('content')
  <!-- Hero Section with Floating Search -->
  <section class="relative h-[90vh] flex items-center justify-center overflow-visible z-10">
    <!-- Background -->
    <div class="absolute inset-0 z-0">
      <img
        src="https://images.unsplash.com/photo-1553913861-c0fddf2619ee?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2000&q=80&quot"
        class="w-full h-full object-cover object-top" alt="Sphinx and Pyramids">
      <div class="absolute inset-0 bg-black/30"></div>
    </div>

    <div class="relative z-10 text-center px-4 -mt-32">
      <h1 class="text-4xl md:text-6xl font-black text-white mb-4 leading-tight drop-shadow-lg font-sans tracking-tight">
        Discover the Magic of the Middle <br> East
      </h1>
      <p class="text-lg md:text-xl text-gray-100 font-medium max-w-2xl mx-auto drop-shadow">
        Experience civilizations, fascinating landscapes, and rich culture with our curated travel packages.
      </p>
      <div class="flex justify-center gap-4 mt-8">
        <a href="{{ route('packages.index') }}"
          class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition">View Packages</a>
        <a href="{{ route('about') }}"
          class="px-8 py-3 bg-white text-gray-900 font-bold rounded-lg hover:bg-gray-100 transition">Read More</a>
      </div>
    </div>

    <!-- Search Widget (Floating) -->
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-1/2 w-full max-w-6xl px-4 z-20"
      id="search-widget">
      <div class="bg-white rounded-2xl shadow-2xl overflow-hidden" x-data="{ activeTab: 'packages' }"
        x-init="window.addEventListener('switch-tab', event => activeTab = event.detail)">
        <!-- Tabs -->
        <div class="flex overflow-x-auto border-b border-gray-100">
          <button @click="activeTab = 'packages'"
            :class="activeTab === 'packages' ? 'text-blue-600 border-b-2 border-blue-600 bg-blue-50/50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50'"
            class="flex items-center gap-2 px-6 py-4 font-bold text-sm transition-all whitespace-nowrap cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            Packages
          </button>
          <button @click="activeTab = 'flights'"
            :class="activeTab === 'flights' ? 'text-blue-600 border-b-2 border-blue-600 bg-blue-50/50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50'"
            class="flex items-center gap-2 px-6 py-4 font-bold text-sm transition-all whitespace-nowrap cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8">
              </path>
            </svg>
            Flights
          </button>
          <button @click="activeTab = 'hotels'"
            :class="activeTab === 'hotels' ? 'text-blue-600 border-b-2 border-blue-600 bg-blue-50/50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50'"
            class="flex items-center gap-2 px-6 py-4 font-bold text-sm transition-all whitespace-nowrap cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
              </path>
            </svg>
            Hotels
          </button>
          <button @click="activeTab = 'transportation'"
            :class="activeTab === 'transportation' ? 'text-blue-600 border-b-2 border-blue-600 bg-blue-50/50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50'"
            class="flex items-center gap-2 px-6 py-4 font-bold text-sm transition-all whitespace-nowrap cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
            </svg>
            Transportation
          </button>
          <button @click="activeTab = 'visas'"
            :class="activeTab === 'visas' ? 'text-blue-600 border-b-2 border-blue-600 bg-blue-50/50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50'"
            class="flex items-center gap-2 px-6 py-4 font-bold text-sm transition-all whitespace-nowrap cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
            </svg>
            Visas <!-- id: visa-tab -->
          </button>
          <button @click="activeTab = 'tours'"
            :class="activeTab === 'tours' ? 'text-blue-600 border-b-2 border-blue-600 bg-blue-50/50' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50'"
            class="flex items-center gap-2 px-6 py-4 font-bold text-sm transition-all whitespace-nowrap cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 20l-5.447-2.724A2 2 0 013 15.488V5.13a2 2 0 011.13-1.789L9 1m0 19v-19m0 19l5.447-2.724A2 2 0 0021 15.488V5.13a2 2 0 00-1.13-1.789L15 1m0 19v-19">
              </path>
            </svg>
            Tours
          </button>
        </div>

        <!-- Tab Content -->
        <div class="p-6 md:p-8">
          <!-- Flights Tab Content -->
          <div x-show="activeTab === 'flights'" class="space-y-6">
            <form action="{{ route('flights.book') }}" method="POST">
              @csrf
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-1">
                  <label class="text-sm font-bold text-gray-700">From</label>
                  <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-400">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                      </svg>
                    </span>
                    <input type="text" name="departure_city" required placeholder="Departure City"
                      class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                  </div>
                </div>
                <div class="space-y-1">
                  <label class="text-sm font-bold text-gray-700">To</label>
                  <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-400">
                      <svg class="w-5 h-5 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                      </svg>
                    </span>
                    <input type="text" name="arrival_city" required placeholder="Arrival City"
                      class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                  </div>
                </div>
                <div class="space-y-1">
                  <label class="text-sm font-bold text-gray-700">Departure Date</label>
                  <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-400">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                      </svg>
                    </span>
                    <input type="date" name="departure_date" required
                      class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end mt-4">
                <div class="space-y-1">
                  <label class="text-sm font-bold text-gray-700">Passengers (Adults)</label>
                  <select name="adults"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="1">1 Adult</option>
                    <option value="2">2 Adults</option>
                    <option value="3">3 Adults</option>
                    <option value="4">4 Adults</option>
                  </select>
                </div>
                <div class="space-y-1">
                  <label class="text-sm font-bold text-gray-700">Class</label>
                  <select name="class_preference"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="economy">Economy</option>
                    <option value="business">Business</option>
                    <option value="first">First Class</option>
                  </select>
                </div>
                <!-- Guest info hidden fields for simplicity or extra inputs -->
                <div class="md:col-span-1">
                  <input type="text" name="first_name" required placeholder="First Name" class="hidden" value="Guest">
                  <input type="text" name="last_name" required placeholder="Last Name" class="hidden" value="User">
                  <input type="email" name="email" required placeholder="Email" class="hidden" value="guest@example.com">
                  <input type="text" name="phone" required placeholder="Phone" class="hidden" value="000">
                </div>
                <div>
                  <button type="submit"
                    class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-600/30 transition flex items-center justify-center gap-2">
                    Request Flight
                  </button>
                </div>
              </div>
            </form>
          </div>

          <!-- Hotels Tab Content (Placeholder) -->
          <div x-show="activeTab === 'hotels'" class="text-center py-8" style="display: none;">
            <p class="text-gray-500 mb-4">Find the best places to stay.</p>
            <button class="px-8 py-3 bg-blue-600 text-white font-bold rounded-xl">Search Hotels</button>
          </div>
          <!-- Packages Tab Content -->
          <div x-show="activeTab === 'packages'" class="space-y-6">
            <form action="{{ route('packages.index') }}" method="GET">
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6" x-data="{ 
                                                          selectedCountry: '',
                                                          cities: {{ \App\Models\City::where('is_active', true)->get(['id', 'name_en', 'country_id']) }},
                                                          get filteredCities() {
                                                              return this.cities.filter(city => city.country_id == this.selectedCountry);
                                                          }
                                                       }">
                <!-- Country -->
                <div class="space-y-1">
                  <label class="text-sm font-bold text-gray-700">Country</label>
                  <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-400">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                      </svg>
                    </span>
                    <select name="country_id" x-model="selectedCountry"
                      class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none">
                      <option value="">Select Country</option>
                      @foreach(\App\Models\Country::where('is_active', true)->get() as $country)
                        <option value="{{ $country->id }}">{{ $country->name_en }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <!-- City -->
                <div class="space-y-1">
                  <label class="text-sm font-bold text-gray-700">City</label>
                  <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-400">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                      </svg>
                    </span>
                    <select name="city_id"
                      class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none"
                      :disabled="!selectedCountry">
                      <option value="">Select City</option>
                      <template x-for="city in filteredCities" :key="city.id">
                        <option :value="city.id" x-text="city.name_en"></option>
                      </template>
                    </select>
                  </div>
                </div>

                <!-- Nights -->
                <div class="space-y-1">
                  <label class="text-sm font-bold text-gray-700">Nights</label>
                  <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-400">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                        </path>
                      </svg>
                    </span>
                    <select name="nights"
                      class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none">
                      <option value="">Select Nights</option>
                      <option value="3">3 Nights</option>
                      <option value="4">4 Nights</option>
                      <option value="5">5 Nights</option>
                      <option value="7">7 Nights</option>
                      <option value="10">10+ Nights</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Row 2 -->
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end mt-6">
                <!-- Type -->
                <div class="space-y-1">
                  <label class="text-sm font-bold text-gray-700">Type</label>
                  <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-400">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                        </path>
                      </svg>
                    </span>
                    <select name="type"
                      class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none">
                      <option value="">Select Type</option>
                      <option>Honeymoon</option>
                      <option>Family</option>
                      <option>Adventure</option>
                      <option>Cultural</option>
                      <option>Luxury</option>
                    </select>
                  </div>
                </div>

                <div class="hidden md:block"></div> <!-- Spacer -->

                <div>
                  <button type="submit"
                    class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-600/30 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Find Packages
                  </button>
                </div>
              </div>
            </form>
          </div>

          <!-- Visas Tab -->
          <div x-show="activeTab === 'visas'" class="space-y-6" style="display: none;">
            <form action="{{ route('visas.index') }}" method="GET">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1">
                  <label class="text-sm font-bold text-gray-700">Destination Country</label>
                  <select name="destination_id" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Where are you going?</option>
                    @foreach(\App\Models\Destination::whereHas('visas')->get() as $dest)
                      <option value="{{ $dest->id }}">{{ $dest->name_en }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="space-y-1">
                  <label class="text-sm font-bold text-gray-700">Your Nationality</label>
                  <select name="nationality_id" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Search by your passport</option>
                    @foreach(\App\Models\Nationality::where('active', true)->orderBy('name')->get() as $nat)
                      <option value="{{ $nat->id }}">{{ $nat->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="mt-6">
                <button type="submit"
                  class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-600/30 transition">
                  Check Visa Requirements
                </button>
              </div>
            </form>
          </div>

          <!-- Transportation/Transfers Tab -->
          <div x-show="activeTab === 'transportation'" class="space-y-6">
            <form action="{{ route('transfers.book') }}" method="POST">
              @csrf
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1">
                  <label class="text-sm font-bold text-gray-700">Pickup Location</label>
                  <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-400">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      </svg>
                    </span>
                    <input type="text" name="pickup_location" required placeholder="Airport or Hotel Name"
                      class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                  </div>
                </div>
                <div class="space-y-1">
                  <label class="text-sm font-bold text-gray-700">Dropoff Location</label>
                  <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-400">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      </svg>
                    </span>
                    <input type="text" name="dropoff_location" required placeholder="Destination Address"
                      class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end mt-4">
                <div class="space-y-1">
                  <label class="text-sm font-bold text-gray-700">Date</label>
                  <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-400">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                      </svg>
                    </span>
                    <input type="date" name="pickup_date" required
                      class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                  </div>
                </div>

                <div class="space-y-1">
                  <label class="text-sm font-bold text-gray-700">Passengers</label>
                  <select name="passengers"
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="1">1 Passenger</option>
                    <option value="2">2 Passengers</option>
                    <option value="3">3 Passengers</option>
                    <option value="4">4-6 (Van)</option>
                    <option value="7">7+ (Bus)</option>
                  </select>
                </div>

                <div class="md:col-span-4 grid grid-cols-1 md:grid-cols-3 gap-6">
                  <div class="space-y-1">
                    <label class="text-sm font-bold text-gray-700">Full Name</label>
                    <div class="relative">
                      <span class="absolute left-4 top-3.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                      </span>
                      <input type="text" name="first_name" required placeholder="John Doe"
                        value="{{ Auth::check() ? Auth::user()->name : '' }}"
                        class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                      <input type="hidden" name="last_name" value=".">
                    </div>
                  </div>

                  <div class="space-y-1">
                    <label class="text-sm font-bold text-gray-700">Phone / WhatsApp</label>
                    <div class="relative">
                      <span class="absolute left-4 top-3.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                          </path>
                        </svg>
                      </span>
                      <input type="tel" name="phone" required placeholder="+20 123 456 7890"
                        value="{{ Auth::check() ? Auth::user()->phone : '' }}"
                        class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                  </div>

                  <div class="space-y-1">
                    <label class="text-sm font-bold text-gray-700">Email Address</label>
                    <div class="relative">
                      <span class="absolute left-4 top-3.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                          </path>
                        </svg>
                      </span>
                      <input type="email" name="email" required placeholder="name@example.com"
                        value="{{ Auth::check() ? Auth::user()->email : '' }}"
                        class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                  </div>
                </div>

                <div class="md:col-span-2">
                  <button type="submit"
                    class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-600/30 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    Book Transfer
                  </button>
                </div>
              </div>
            </form>
          </div>

          <!-- Tours Tab (Placeholder) -->
          <div x-show="activeTab === 'tours'" class="text-center py-8" style="display: none;">
            <p class="text-gray-500 mb-4 font-bold">Guided city tours and excursions are coming soon!</p>
            <button class="px-8 py-3 bg-blue-600 text-white font-bold rounded-xl opacity-50 cursor-not-allowed">Coming
              Soon</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Special Upcoming Offers -->
  <section class="mt-40 py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 font-sans">Special Upcoming Offers</h2>
        <p class="text-gray-500 max-w-2xl mx-auto">Explore our curated list of upcoming trips with exclusive deals just
          for you.</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @foreach($offers as $offer)
          <div
            class="group bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden"
            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="relative h-64 overflow-hidden rounded-t-3xl">
              @php
                $mainImage = $offer->media->where('is_main', true)->first();
                $imageUrl = $mainImage ? (Str::startsWith($mainImage->url, 'http') ? $mainImage->url : Storage::url($mainImage->url)) : 'https://images.unsplash.com/photo-1572252009286-268acec5a0af?auto=format&fit=crop&w=800&q=80';
              @endphp
              <x-image-with-skeleton :src="$imageUrl" :alt="$offer->translations->first()->title ?? $offer->name_en"
                class="group-hover:scale-105 transition duration-700" />
              <div
                class="absolute top-4 right-4 bg-white/90 backdrop-blur text-gray-900 text-xs font-bold px-3 py-1 rounded-full shadow-sm z-20">
                {{ $offer->duration_days }} Days
              </div>
              <div
                class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm z-20">
                {{ $offer->offer_tag ?? 'Special' }}
              </div>
            </div>
            <div class="p-6">
              <div class="flex justify-between items-start mb-2">
                <h4 class="text-xl font-bold text-gray-900 line-clamp-1">
                  {{ $offer->translations->first()->title ?? $offer->name_en }}
                </h4>
              </div>

              <div class="flex items-center gap-2 mb-4">
                <div class="flex text-yellow-400 text-xs">
                  @for($i = 0; $i < round($offer->rating); $i++) ★ @endfor
                </div>
                <span class="text-xs text-gray-400">({{ $offer->rating }} Rating)</span>
              </div>

              <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                <div>
                  <span class="text-xs text-gray-400 block">Starting from</span>
                  <span class="text-lg font-black text-blue-600">${{ $offer->price }}</span>
                </div>
                <a href="{{ route('packages.show', $offer->id) }}"
                  class="px-4 py-2 bg-gray-900 text-white text-sm font-bold rounded-xl hover:bg-blue-600 transition">Book
                  Now</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Travel Any Corner Section -->
  <section class="py-24 bg-gray-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col lg:flex-row items-center gap-16">
        <!-- Image with Overlay Card -->
        <div class="lg:w-1/2 relative" data-aos="fade-right">
          <div class="relative rounded-[3rem] overflow-hidden shadow-2xl">
            <img src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=1000&q=80"
              alt="Traveler" class="w-full h-auto object-cover">
          </div>

          <div class="absolute bottom-10 -right-10 bg-white p-6 rounded-3xl shadow-xl max-w-xs hidden md:block"
            data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-center gap-4 mb-4">
              <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
              </div>
              <div>
                <p class="font-bold text-gray-900">300+ Destinations</p>
                <p class="text-xs text-gray-500">Across the globe</p>
              </div>
            </div>
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
              <div>
                <p class="font-bold text-gray-900">98% Satisfaction</p>
                <p class="text-xs text-gray-500">Based on reviews</p>
              </div>
            </div>
          </div>
        </div>

        <div class="lg:w-1/2 space-y-8" data-aos="fade-left">
          <h2 class="text-3xl md:text-5xl font-black text-gray-900 leading-tight">Travel Any Corner Of The World With Us
          </h2>
          <p class="text-gray-500 text-lg leading-relaxed">
            We are an agency specialized in creating unique and unforgettable travel experiences. Whether you are looking
            for a relaxing beach holiday, a cultural city break, or an adventurous expedition, we have something for
            everyone.
          </p>

          <div class="grid grid-cols-2 gap-6">
            <div class="p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
              <h4 class="text-3xl font-black text-blue-600 mb-1">20+</h4>
              <p class="text-sm text-gray-500 font-bold">Years Experience</p>
            </div>
            <div class="p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
              <h4 class="text-3xl font-black text-blue-600 mb-1">55k+</h4>
              <p class="text-sm text-gray-500 font-bold">Happy Travelers</p>
            </div>
          </div>

          <a href="{{ route('about') }}"
            class="inline-block px-10 py-4 bg-gray-900 text-white font-bold rounded-xl hover:bg-blue-600 transition shadow-lg shadow-blue-900/10">More
            About Us</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Premium Services -->
  <section class="py-24 bg-white relative overflow-hidden">
    <!-- Decorational Blobs -->
    <div
      class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-50 rounded-full blur-3xl opacity-50 pointer-events-none">
    </div>
    <div
      class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-purple-50 rounded-full blur-3xl opacity-50 pointer-events-none">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <div class="text-center mb-16" data-aos="fade-up">
        <span class="text-blue-600 font-bold tracking-wider text-sm uppercase mb-2 block">Why Choose Us</span>
        <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-6 font-sans">Our Premium Services</h2>
        <p class="text-gray-500 max-w-2xl mx-auto text-lg">Beyond just booking, we manage every detail with precision.
          Choose the service that fits your journey.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

        <!-- Service 1: Flight Booking (Blue Theme) -->
        <div
          class="group relative p-8 rounded-[2.5rem] bg-white border border-gray-100 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-blue-500/20 transition-all duration-500 hover:-translate-y-2 overflow-hidden"
          data-aos="fade-up" data-aos-delay="0">
          <div
            class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-[100px] -mr-8 -mt-8 transition-transform duration-700 group-hover:scale-150 group-hover:bg-blue-600">
          </div>

          <div
            class="relative w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 text-2xl mb-8 shadow-sm group-hover:bg-white group-hover:text-blue-600 transition-colors duration-300">
            <i class="fa-solid fa-plane-up"></i>
          </div>

          <h3 class="relative text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">Flight
            Booking</h3>
          <p class="relative text-gray-500 text-sm leading-relaxed mb-6">
            Exclusive deals on domestic and international flights for a comfortable journey.
          </p>
          <a href="#flights"
            onclick="document.querySelector('[x-data]').__x.$data.activeTab = 'flights'; document.getElementById('search-widget').scrollIntoView({behavior: 'smooth'})"
            class="relative inline-flex items-center gap-2 text-sm font-bold text-blue-600 group-hover:translate-x-2 transition-transform">
            Book Now <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>

        <!-- Service 2: Visa Services (Purple Theme) -->
        <div
          class="group relative p-8 rounded-[2.5rem] bg-white border border-gray-100 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-purple-500/20 transition-all duration-500 hover:-translate-y-2 overflow-hidden"
          data-aos="fade-up" data-aos-delay="100">
          <div
            class="absolute top-0 right-0 w-32 h-32 bg-purple-50 rounded-bl-[100px] -mr-8 -mt-8 transition-transform duration-700 group-hover:scale-150 group-hover:bg-purple-600">
          </div>

          <div
            class="relative w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center text-purple-600 text-2xl mb-8 shadow-sm group-hover:bg-white group-hover:text-purple-600 transition-colors duration-300">
            <i class="fa-solid fa-passport"></i>
          </div>

          <h3 class="relative text-xl font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors">Visa
            Services</h3>
          <p class="relative text-gray-500 text-sm leading-relaxed mb-6">
            Hassle-free visa assistance. We handle the paperwork so you can focus on packing.
          </p>
          <a href="{{ route('visas.index') }}"
            class="relative inline-flex items-center gap-2 text-sm font-bold text-purple-600 group-hover:translate-x-2 transition-transform">
            Check Req. <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>

        <!-- Service 3: Transportation (Teal/Emerald Theme) -->
        <div
          class="group relative p-8 rounded-[2.5rem] bg-white border border-gray-100 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-emerald-500/20 transition-all duration-500 hover:-translate-y-2 overflow-hidden"
          data-aos="fade-up" data-aos-delay="200">
          <div
            class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-[100px] -mr-8 -mt-8 transition-transform duration-700 group-hover:scale-150 group-hover:bg-emerald-600">
          </div>

          <div
            class="relative w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600 text-2xl mb-8 shadow-sm group-hover:bg-white group-hover:text-emerald-600 transition-colors duration-300">
            <i class="fa-solid fa-car-side"></i>
          </div>

          <h3 class="relative text-xl font-bold text-gray-900 mb-3 group-hover:text-emerald-600 transition-colors">
            Transportation</h3>
          <p class="relative text-gray-500 text-sm leading-relaxed mb-6">
            Luxury airport transfers and private rentals with professional drivers.
          </p>
          <a href="{{ route('transfers.index') }}"
            class="relative inline-flex items-center gap-2 text-sm font-bold text-emerald-600 group-hover:translate-x-2 transition-transform">
            Book Ride <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>

        <!-- Service 4: MICE & Events (Rose/Pink Theme to match logo) -->
        <div
          class="group relative p-8 rounded-[2.5rem] bg-white border border-gray-100 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-pink-500/20 transition-all duration-500 hover:-translate-y-2 overflow-hidden"
          data-aos="fade-up" data-aos-delay="300">
          <div
            class="absolute top-0 right-0 w-32 h-32 bg-pink-50 rounded-bl-[100px] -mr-8 -mt-8 transition-transform duration-700 group-hover:scale-150 group-hover:bg-pink-600">
          </div>

          <div
            class="relative w-16 h-16 bg-pink-100 rounded-2xl flex items-center justify-center text-pink-600 text-2xl mb-8 shadow-sm group-hover:bg-white group-hover:text-pink-600 transition-colors duration-300">
            <i class="fa-solid fa-handshake"></i>
          </div>

          <h3 class="relative text-xl font-bold text-gray-900 mb-3 group-hover:text-pink-600 transition-colors">MICE &
            Events</h3>
          <p class="relative text-gray-500 text-sm leading-relaxed mb-6">
            Corporate conferences, luxury weddings, and full event planning solutions.
          </p>
          <a href="https://eetevent.com/" target="_blank"
            class="relative inline-flex items-center gap-2 text-sm font-bold text-pink-600 group-hover:translate-x-2 transition-transform">
            Visit Events <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>

      </div>
    </div>
  </section>

  <!-- Recommended & Trending Section -->
  <section class="py-24 bg-white" x-data="{ activeTab: 'recommended' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6" data-aos="fade-up">
        <div class="text-left">
          <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 font-sans"
            x-text="activeTab === 'recommended' ? 'Recommended Destinations' : (activeTab === 'trends' ? 'Trending Packages' : (activeTab === 'popular' ? 'Popular Choices' : 'Featured Deals'))">
            Recommended Destination</h2>
          <div class="w-24 h-1.5 bg-blue-600 rounded-full"></div>
        </div>

        <!-- Dynamic Tabs -->
        <div class="flex bg-gray-100 p-1.5 rounded-2xl gap-1">
          <button @click="activeTab = 'recommended'"
            :class="activeTab === 'recommended' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:bg-white/50 hover:text-gray-700'"
            class="px-6 py-2.5 rounded-xl font-bold transition">Recommended</button>
          <button @click="activeTab = 'trends'"
            :class="activeTab === 'trends' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:bg-white/50 hover:text-gray-700'"
            class="px-6 py-2.5 rounded-xl font-bold transition">Trends</button>
          <button @click="activeTab = 'popular'"
            :class="activeTab === 'popular' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:bg-white/50 hover:text-gray-700'"
            class="px-6 py-2.5 rounded-xl font-bold transition">Popular</button>
          <button @click="activeTab = 'features'"
            :class="activeTab === 'features' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:bg-white/50 hover:text-gray-700'"
            class="px-6 py-2.5 rounded-xl font-bold transition">Features</button>
        </div>
      </div>

      <!-- Tab Content: Recommended Destinations -->
      <div x-show="activeTab === 'recommended'" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
        class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($recommendedDestinations as $dest)
          <div
            class="group relative rounded-3xl overflow-hidden cursor-pointer shadow-sm hover:shadow-lg transition bg-white h-full">
            <div class="h-48 overflow-hidden relative">
              @php
                $images = is_string($dest->images) ? json_decode($dest->images, true) : $dest->images;
                $imageUrl = !empty($images[0]) ? $images[0] : 'https://images.unsplash.com/photo-1590253232230-80252579ee51?auto=format&fit=crop&w=600&q=80';
                if (!Str::startsWith($imageUrl, 'http')) {
                  $imageUrl = Storage::url($imageUrl);
                }
               @endphp
              <img src="{{ $imageUrl }}" alt="{{ $dest->name_en }}"
                class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60"></div>
            </div>
            <div class="p-4 relative">
              <div class="flex justify-between items-center mb-1">
                <h4 class="text-lg font-bold text-gray-900">{{ $dest->name_en }}</h4>
                <span class="flex items-center gap-1 text-xs font-bold bg-gray-100 px-2 py-1 rounded-lg">
                  <span class="text-yellow-400">★</span> {{ $dest->rating }}
                </span>
              </div>
              <p class="text-gray-400 text-sm flex items-center gap-1 font-medium">
                <i class="fa-solid fa-location-dot text-blue-500"></i> {{ $dest->city->country->name_en ?? 'Egypt' }}
              </p>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Tab Content: Trends (Packages) -->
      <div x-show="activeTab === 'trends'" style="display: none;" x-transition:enter="transition ease-out duration-300"
        class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($trends as $pkg)
          <div
            class="bg-white rounded-[2rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group">
            <div class="relative h-64 overflow-hidden">
              @php
                $mainImage = $pkg->media->where('is_main', true)->first();
                $imageUrl = $mainImage ? (Str::startsWith($mainImage->url, 'http') ? $mainImage->url : Storage::url($mainImage->url)) : 'https://images.unsplash.com/photo-1544550581-5f7ceaf7f992?auto=format&fit=crop&w=800&q=80';
              @endphp
              <img src="{{ $imageUrl }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
              <div
                class="absolute top-4 right-4 bg-white/90 backdrop-blur text-gray-900 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                {{ $pkg->duration_days }} Days
              </div>
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $pkg->translations->first()->title ?? $pkg->name_en }}
              </h3>
              <div class="flex justify-between items-center">
                <span class="text-lg font-black text-blue-600">${{ $pkg->price }}</span>
                <a href="{{ route('packages.show', $pkg->id) }}"
                  class="text-sm font-bold text-gray-500 hover:text-blue-600">View -></a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Tab Content: Popular (Packages in Grid) -->
      <div x-show="activeTab === 'popular'" style="display: none;" x-transition:enter="transition ease-out duration-300"
        class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($popularPackages->take(3) as $pkg)
          <div
            class="bg-white rounded-[2rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group">
            <div class="relative h-64 overflow-hidden">
              @php
                $mainImage = $pkg->media->where('is_main', true)->first();
                $imageUrl = $mainImage ? (Str::startsWith($mainImage->url, 'http') ? $mainImage->url : Storage::url($mainImage->url)) : 'https://images.unsplash.com/photo-1662562140417-7429188f8d6f?auto=format&fit=crop&w=800&q=80';
              @endphp
              <img src="{{ $imageUrl }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $pkg->translations->first()->title ?? $pkg->name_en }}
              </h3>
              <div class="flex justify-between items-center">
                <span class="text-lg font-black text-blue-600">${{ $pkg->price }}</span>
                <a href="{{ route('packages.show', $pkg->id) }}"
                  class="px-4 py-2 bg-gray-100 rounded-lg text-sm font-bold text-gray-600 hover:bg-blue-600 hover:text-white transition">Book</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Tab Content: Features (Packages) -->
      <div x-show="activeTab === 'features'" style="display: none;" x-transition:enter="transition ease-out duration-300"
        class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($featuredPackages as $pkg)
          <div
            class="bg-white rounded-[2rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group">
            <div class="relative h-64 overflow-hidden">
              @php
                $mainImage = $pkg->media->where('is_main', true)->first();
                $imageUrl = $mainImage ? (Str::startsWith($mainImage->url, 'http') ? $mainImage->url : Storage::url($mainImage->url)) : 'https://images.unsplash.com/photo-1503177119275-0aa32b3a9368?auto=format&fit=crop&w=800&q=80';
              @endphp
              <img src="{{ $imageUrl }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
              <div
                class="absolute top-4 left-4 bg-yellow-400 text-gray-900 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                Featured</div>
            </div>
            <div class="p-6">
              <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $pkg->translations->first()->title ?? $pkg->name_en }}
              </h3>
              <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $pkg->translations->first()->short_description }}</p>
              <div class="flex justify-between items-center">
                <span class="text-lg font-black text-blue-600">${{ $pkg->price }}</span>
                <a href="{{ route('packages.show', $pkg->id) }}" class="text-blue-600 font-bold hover:underline">Details</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </section>

  <!-- Popular Travel Packages -->
  <section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-end mb-12" data-aos="fade-up">
        <div>
          <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 font-sans">Popular Travel Packages</h2>
          <p class="text-gray-500 max-w-2xl">Discover our most booked packages and start your adventure today.</p>
        </div>
        <a href="{{ route('packages.index') }}"
          class="hidden md:inline-flex items-center gap-2 text-blue-600 font-bold hover:gap-4 transition-all">View All
          Packages -></a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($popularPackages as $pkg)
          <div
            class="bg-white rounded-[2rem] overflow-hidden border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-300 group"
            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="relative h-64 overflow-hidden">
              @php
                $mainImage = $pkg->media->where('is_main', true)->first();
                $imageUrl = $mainImage ? (Str::startsWith($mainImage->url, 'http') ? $mainImage->url : Storage::url($mainImage->url)) : 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?auto=format&fit=crop&w=800&q=80';
              @endphp
              <x-image-with-skeleton :src="$imageUrl" :alt="$pkg->translations->first()->title ?? $pkg->name_en"
                class="group-hover:scale-105 transition duration-700" />
              <div class="absolute top-4 right-4 bg-white p-2 rounded-xl shadow-md">
                <svg class="w-5 h-5 text-gray-400 hover:text-red-500 transition cursor-pointer" fill="none"
                  stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                  </path>
                </svg>
              </div>
            </div>
            <div class="p-8">
              <div class="flex justify-between items-start mb-4">
                <h3 class="text-xl font-black text-gray-900 leading-tight group-hover:text-blue-600 transition">
                  {{ $pkg->translations->first()->title ?? $pkg->name_en }}
                </h3>
                <span class="text-lg font-black text-blue-600">${{ $pkg->price }}</span>
              </div>

              <div class="flex items-center gap-1 mb-4">
                <div class="flex text-yellow-400 text-sm">★★★★★</div>
                <span class="text-xs text-gray-400 font-bold">({{ $pkg->rating }} Rating)</span>
              </div>

              <p class="text-gray-500 text-sm leading-relaxed mb-8 line-clamp-3">
                {{ $pkg->translations->first()->short_description ?? Str::limit($pkg->translations->first()->description ?? '', 100) }}
              </p>

              <div class="flex items-center gap-4">
                <a href="{{ route('packages.show', $pkg->id) }}"
                  class="flex-1 py-3 border-2 border-blue-600 text-blue-600 font-bold rounded-xl text-center hover:bg-blue-50 transition">View
                  Details</a>
                <button
                  class="flex-1 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-600/30">Book
                  Now</button>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-4 text-center" data-aos="zoom-in">
      <h2 class="text-3xl font-bold text-gray-900 mb-6 font-serif">Connect With Us</h2>
      <div class="w-20 h-1 bg-blue-600 mx-auto rounded-full mb-8"></div>
      <h3 class="text-xl font-bold text-gray-900 mb-2">Follow Our Adventures</h3>
      <p class="text-gray-500 mb-10">Stay updated with our latest packages and offers by following us on social media.</p>

      <div class="flex justify-center gap-6">
        <a href="https://www.facebook.com/egyptexpresstravel"
          class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-blue-600 hover:text-white transition text-xl">
          <i class="fa-brands fa-facebook-f"></i>
        </a>
        <a href="https://www.instagram.com/egyptexpresstravel/"
          class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-pink-600 hover:text-white transition text-xl">
          <i class="fa-brands fa-instagram"></i>
        </a>
        <a href="https://twitter.com/EETEGYPT"
          class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-sky-500 hover:text-white transition text-xl">
          <i class="fa-brands fa-twitter"></i>
        </a>
        <a href="https://www.tiktok.com/@egyptexpress"
          class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-red-600 hover:text-white transition text-xl">
          <i class="fa-brands fa-tiktok"></i>
        </a>
      </div>
    </div>
  </section>

@endsection