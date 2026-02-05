@extends('layouts.app')

@section('title', 'Transportation & Transfers - Egypt Express Travel')

@section('content')
  <div class="bg-gray-50 min-h-screen pt-32 pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16" data-aos="fade-up">
        <h1 class="text-4xl md:text-6xl font-black text-gray-900 mb-6 font-sans">Premium Transfers</h1>
        <p class="text-gray-500 text-xl max-w-3xl mx-auto">Safe, reliable, and luxury transportation services across
          Egypt. From airport pickups to private chauffeur services.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24">
        <!-- Service 1 -->
        <div
          class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-xl transition duration-500"
          data-aos="fade-up">
          <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-8">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8">
              </path>
            </svg>
          </div>
          <h3 class="text-2xl font-black text-gray-900 mb-4">Airport Pickups</h3>
          <p class="text-gray-500 leading-relaxed mb-6">Our professional drivers will be waiting for you at the airport
            with a personalized sign, ensuring a smooth transition to your hotel.</p>
          <ul class="space-y-3 mb-8">
            <li class="flex items-center gap-2 text-sm font-bold text-gray-700">
              <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z">
                </path>
              </svg>
              Meet & Greet Service
            </li>
            <li class="flex items-center gap-2 text-sm font-bold text-gray-700">
              <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z">
                </path>
              </svg>
              Luggage Assistance
            </li>
          </ul>
          <button class="w-full py-4 bg-gray-900 text-white font-black rounded-2xl hover:bg-blue-600 transition">Book
            Now</button>
        </div>

        <!-- Service 2 -->
        <div
          class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-xl transition duration-500"
          data-aos="fade-up" data-aos-delay="100">
          <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-8">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
              </path>
            </svg>
          </div>
          <h3 class="text-2xl font-black text-gray-900 mb-4">City to City</h3>
          <p class="text-gray-500 leading-relaxed mb-6">Travel comfortably between major cities like Cairo, Alexandria,
            Luxor, and Aswan with our long-distance transfer services.</p>
          <ul class="space-y-3 mb-8">
            <li class="flex items-center gap-2 text-sm font-bold text-gray-700">
              <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z">
                </path>
              </svg>
              English Speaking Drivers
            </li>
            <li class="flex items-center gap-2 text-sm font-bold text-gray-700">
              <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z">
                </path>
              </svg>
              AC Premium Vehicles
            </li>
          </ul>
          <button class="w-full py-4 bg-gray-900 text-white font-black rounded-2xl hover:bg-blue-600 transition">Book
            Now</button>
        </div>

        <!-- Service 3 -->
        <div
          class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-xl transition duration-500"
          data-aos="fade-up" data-aos-delay="200">
          <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-8">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
              </path>
            </svg>
          </div>
          <h3 class="text-2xl font-black text-gray-900 mb-4">VIP Disposal</h3>
          <p class="text-gray-500 leading-relaxed mb-6">Need a car for the whole day? Our disposal service gives you the
            freedom to explore at your own pace with a dedicated vehicle.</p>
          <ul class="space-y-3 mb-8">
            <li class="flex items-center gap-2 text-sm font-bold text-gray-700">
              <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z">
                </path>
              </svg>
              Flexible Schedule
            </li>
            <li class="flex items-center gap-2 text-sm font-bold text-gray-700">
              <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z">
                </path>
              </svg>
              Unlimited Stops
            </li>
          </ul>
          <button class="w-full py-4 bg-gray-900 text-white font-black rounded-2xl hover:bg-blue-600 transition">Book
            Now</button>
        </div>
      </div>

      <!-- Vehicles -->
      <div class="bg-gray-900 rounded-[3rem] p-12 md:p-24 text-white overflow-hidden relative">
        <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
          <div>
            <h2 class="text-3xl md:text-5xl font-black mb-8 leading-tight">Our Premium Fleet</h2>
            <p class="text-white/70 text-lg mb-12">We maintain a diverse fleet of modern, late-model vehicles to suit
              every group size and preference. From luxury sedans to large tourist coaches.</p>

            <div class="space-y-6">
              <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center font-black">SUV</div>
                <span class="text-xl font-bold">Premium SUVs (Toyota Fortuner or similar)</span>
              </div>
              <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center font-black">VAN</div>
                <span class="text-xl font-bold">Luxury Vans (Toyota Hiace or similar)</span>
              </div>
              <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center font-black">BUS</div>
                <span class="text-xl font-bold">Coaches (Up to 50 Passengers)</span>
              </div>
            </div>
          </div>
          <div class="relative">
            <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&w=800&q=80"
              class="rounded-3xl shadow-2xl rotate-3 scale-110" alt="Premium Car">
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection