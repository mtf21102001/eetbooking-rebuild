@extends('layouts.app')

@section('title', 'Transportation & Transfers - Egypt Express Travel')

@section('content')
  <div class="min-h-screen bg-white">
    <!-- Hero Section with Booking Form -->
    <div class="relative pt-32 pb-20 overflow-hidden">
      <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1541443131876-44b03de101c5?auto=format&fit=crop&w=1920&q=80"
          class="w-full h-full object-cover opacity-10" alt="Background">
        <div class="absolute inset-0 bg-gradient-to-b from-white via-white/80 to-white"></div>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
          <div data-aos="fade-right">
            <span
              class="inline-block px-4 py-1.5 rounded-full bg-blue-50 text-blue-600 font-bold text-sm tracking-wider uppercase mb-6">
              Reliable & Premium
            </span>
            <h1 class="text-5xl md:text-7xl font-black text-gray-900 mb-8 leading-tight">
              Egypt <span class="text-blue-600">Transfers</span> <br>Redefined.
            </h1>
            <p class="text-gray-500 text-xl leading-relaxed mb-10 max-w-xl">
              Experience seamless transportation across Egypt. From luxury airport greeted arrivals to personalized
              city-to-city private journeys.
            </p>

            <div class="flex items-center gap-8 py-6 border-t border-gray-100">
              <div class="flex flex-col">
                <span class="text-3xl font-black text-gray-900">24/7</span>
                <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">Support</span>
              </div>
              <div class="w-px h-12 bg-gray-200"></div>
              <div class="flex flex-col">
                <span class="text-3xl font-black text-gray-900">500+</span>
                <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">Vehicles</span>
              </div>
              <div class="w-px h-12 bg-gray-200"></div>
              <div class="flex flex-col">
                <span class="text-3xl font-black text-gray-900">100%</span>
                <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">Safe</span>
              </div>
            </div>
          </div>

          <div id="booking" data-aos="fade-left"
            class="bg-white p-8 md:p-10 rounded-[3rem] shadow-2xl shadow-blue-500/80 border border-gray-100 relative group">
            <div
              class="absolute -top-6 -right-6 w-24 h-24 bg-blue-600 rounded-full flex items-center justify-center text-white text-3xl shadow-xl shadow-blue-500/40 transform rotate-12 group-hover:rotate-0 transition-transform duration-500">
              <i class="fa-solid fa-car"></i>
            </div>

            <h2 class="text-2xl font-black text-gray-900 mb-8">Quick Booking</h2>

            <form action="{{ route('transfers.book') }}" method="POST" class="space-y-6">
              @csrf
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                  <label class="text-sm font-bold text-gray-400 uppercase tracking-widest ml-1">Pickup Location</label>
                  <div class="relative">
                    <i class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-blue-500"></i>
                    <input type="text" name="pickup_location" required placeholder="Airport, Hotel, etc."
                      class="w-full pl-12 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition">
                  </div>
                </div>
                <div class="space-y-2">
                  <label class="text-sm font-bold text-gray-400 uppercase tracking-widest ml-1">Dropoff Point</label>
                  <div class="relative">
                    <i class="fa-solid fa-map-pin absolute left-4 top-1/2 -translate-y-1/2 text-blue-500"></i>
                    <input type="text" name="dropoff_location" required placeholder="Destination City"
                      class="w-full pl-12 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition">
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                  <label class="text-sm font-bold text-gray-400 uppercase tracking-widest ml-1">Date</label>
                  <div class="relative">
                    <i class="fa-solid fa-calendar absolute left-4 top-1/2 -translate-y-1/2 text-blue-500"></i>
                    <input type="date" name="pickup_date" required min="{{ date('Y-m-d') }}"
                      class="w-full pl-12 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition">
                  </div>
                </div>
                <div class="space-y-2">
                  <label class="text-sm font-bold text-gray-400 uppercase tracking-widest ml-1">Passengers</label>
                  <div class="relative">
                    <i class="fa-solid fa-user-group absolute left-4 top-1/2 -translate-y-1/2 text-blue-500"></i>
                    <select name="passengers"
                      class="w-full pl-12 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition appearance-none">
                      <option value="1">1 Passenger</option>
                      <option value="2">2 Passengers</option>
                      <option value="3">3 Passengers</option>
                      <option value="4">4+ Passengers</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                  <label class="text-sm font-bold text-gray-400 uppercase tracking-widest ml-1">Vehicle Preference</label>
                  <div class="relative">
                    <i class="fa-solid fa-car-side absolute left-4 top-1/2 -translate-y-1/2 text-blue-500"></i>
                    <select name="vehicle_type"
                      class="w-full pl-12 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition appearance-none">
                      <option value="sedan">Luxury Sedan</option>
                      <option value="suv">Premium SUV</option>
                      <option value="van">Luxury Van</option>
                      <option value="bus">Tourist Coach</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- Personal Info (Simplified for Lead) -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-50">
                @php
                  $firstName = '';
                  $lastName = '';
                  if (auth()->check()) {
                    $nameParts = explode(' ', auth()->user()->name, 2);
                    $firstName = $nameParts[0] ?? '';
                    $lastName = $nameParts[1] ?? '';
                  }
                @endphp
                <input type="text" name="first_name" placeholder="First Name" required
                  value="{{ old('first_name', $firstName) }}"
                  class="w-full px-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition">
                <input type="text" name="last_name" placeholder="Last Name" required
                  value="{{ old('last_name', $lastName) }}"
                  class="w-full px-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition">
              </div>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input type="email" name="email" placeholder="Email" required
                  value="{{ old('email', auth()->user()->email ?? '') }}"
                  class="w-full px-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition">
                <input type="tel" name="phone" placeholder="Phone" required value="{{ old('phone') }}"
                  class="w-full px-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition">
              </div>

              <button type="submit"
                class="w-full py-5 bg-blue-600 text-white font-black rounded-2xl hover:bg-blue-700 transition shadow-xl shadow-blue-500/30 flex items-center justify-center gap-3">
                Check Availability <i class="fa-solid fa-arrow-right"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Services Section -->
    <div class="py-24 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
          <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">Our Services</h2>
          <p class="text-gray-500 text-lg max-w-2xl mx-auto font-medium">Tailored transportation solutions for every need,
            from individual travelers to large touring groups.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
          <!-- Airport Transfers -->
          <div
            class="group bg-white p-10 rounded-[3rem] shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:-translate-y-2">
            <div
              class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-8 transform group-hover:rotate-12 transition-transform">
              <i class="fa-solid fa-plane-arrival text-2xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900 mb-4">Airport Meet & Greet</h3>
            <p class="text-gray-500 leading-relaxed mb-8">Professional drivers waiting for you with a personalized name
              board inside the terminal.</p>
            <ul class="space-y-4 mb-10">
              <li class="flex items-center gap-3 text-sm font-bold text-gray-700">
                <i class="fa-solid fa-check text-green-500"></i> Free Waiting Time
              </li>
              <li class="flex items-center gap-3 text-sm font-bold text-gray-700">
                <i class="fa-solid fa-check text-green-500"></i> Flight Tracking
              </li>
            </ul>
            <a href="#booking" class="inline-flex items-center gap-2 text-blue-600 font-black hover:gap-4 transition-all">
              Learn More <i class="fa-solid fa-chevron-right text-xs"></i>
            </a>
          </div>

          <!-- Intercity -->
          <div
            class="group bg-white p-10 rounded-[3rem] shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:-translate-y-2">
            <div
              class="w-16 h-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-8 transform group-hover:rotate-12 transition-transform">
              <i class="fa-solid fa-city text-2xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900 mb-4">City to City</h3>
            <p class="text-gray-500 leading-relaxed mb-8">Fixed-price private transfers between Cairo, Luxor, Aswan, and
              the Red Sea resorts.</p>
            <ul class="space-y-4 mb-10">
              <li class="flex items-center gap-3 text-sm font-bold text-gray-700">
                <i class="fa-solid fa-check text-green-500"></i> Door to Door
              </li>
              <li class="flex items-center gap-3 text-sm font-bold text-gray-700">
                <i class="fa-solid fa-check text-green-500"></i> Highway Fees Included
              </li>
            </ul>
            <a href="#booking"
              class="inline-flex items-center gap-2 text-purple-600 font-black hover:gap-4 transition-all">
              Learn More <i class="fa-solid fa-chevron-right text-xs"></i>
            </a>
          </div>

          <!-- VIP Disposal -->
          <div
            class="group bg-white p-10 rounded-[3rem] shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:-translate-y-2">
            <div
              class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-8 transform group-hover:rotate-12 transition-transform">
              <i class="fa-solid fa-clock text-2xl"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-900 mb-4">Hourly Disposal</h3>
            <p class="text-gray-500 leading-relaxed mb-8">Dedicated vehicle and driver at your disposal for 4, 8, or 12
              hours for maximum flexibility.</p>
            <ul class="space-y-4 mb-10">
              <li class="flex items-center gap-3 text-sm font-bold text-gray-700">
                <i class="fa-solid fa-check text-green-500"></i> Multiple Stops
              </li>
              <li class="flex items-center gap-3 text-sm font-bold text-gray-700">
                <i class="fa-solid fa-check text-green-500"></i> Local Area Expertise
              </li>
            </ul>
            <a href="#booking"
              class="inline-flex items-center gap-2 text-indigo-600 font-black hover:gap-4 transition-all">
              Learn More <i class="fa-solid fa-chevron-right text-xs"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- PRESERVED FLEET SECTION -->
    <div class="py-24">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-900 rounded-[3rem] p-12 md:p-24 text-white overflow-hidden relative">
          <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
              <h2 class="text-3xl md:text-5xl font-black mb-8 leading-tight">Our Premium Fleet</h2>
              <p class="text-white/70 text-lg mb-12">We maintain a diverse fleet of modern, late-model vehicles to suit
                every group size and preference. From luxury sedans to large tourist coaches.</p>

              <div class="space-y-6">
                <div class="flex items-center gap-4 group">
                  <div
                    class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center font-black transition group-hover:scale-110">
                    SUV</div>
                  <span class="text-xl font-bold">Premium SUVs (Toyota Fortuner or similar)</span>
                </div>
                <div class="flex items-center gap-4 group">
                  <div
                    class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center font-black transition group-hover:scale-110">
                    VAN</div>
                  <span class="text-xl font-bold">Luxury Vans (Toyota Hiace or similar)</span>
                </div>
                <div class="flex items-center gap-4 group">
                  <div
                    class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center font-black transition group-hover:scale-110">
                    BUS</div>
                  <span class="text-xl font-bold">Coaches (Up to 50 Passengers)</span>
                </div>
              </div>
            </div>
            <div class="relative items-center justify-center flex">
              <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&w=800&q=80"
                class="rounded-3xl shadow-2xl rotate-3 scale-110" alt="Premium Car">
              <!-- Abstract glow -->
              <div class="absolute -z-10 w-64 h-64 bg-blue-600/30 blur-[100px] rounded-full"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Trust signals / Why Choose Us -->
    <div class="py-24 bg-white border-t border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 text-center">
          <div
            class="space-y-4 group bg-white p-10 rounded-[3rem] shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:-translate-y-2">
            <div class="text-blue-600 text-4xl"><i class="fa-solid fa-shield-heart"></i></div>
            <h4 class="text-xl font-black text-gray-900">Safety First</h4>
            <p class="text-gray-500 font-medium">Fully insured vehicles and top-rated professional drivers.</p>
          </div>
          <div
            class="space-y-4 group bg-white p-10 rounded-[3rem] shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:-translate-y-2">
            <div class="text-blue-600 text-4xl"><i class="fa-solid fa-tags"></i></div>
            <h4 class="text-xl font-black text-gray-900">Fixed Rates</h4>
            <p class="text-gray-500 font-medium">Transparent pricing with no hidden fees or surge pricing.</p>
          </div>
          <div
            class="space-y-4 group bg-white p-10 rounded-[3rem] shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:-translate-y-2">
            <div class="text-blue-600 text-4xl"><i class="fa-solid fa-headset"></i></div>
            <h4 class="text-xl font-black text-gray-900">24/7 Support</h4>
            <p class="text-gray-500 font-medium">WhatsApp and phone support for all your transport needs.</p>
          </div>
          <div
            class="space-y-4 group bg-white p-10 rounded-[3rem] shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:-translate-y-2">
            <div class="text-blue-600 text-4xl"><i class="fa-solid fa-leaf"></i></div>
            <h4 class="text-xl font-black text-gray-900">Well Maintained</h4>
            <p class="text-gray-500 font-medium">Modern fleet including premium and eco-friendly options.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Smooth Scroll & Focus for #booking links
      document.querySelectorAll('a[href="#booking"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute('href'));
          if (target) {
            target.scrollIntoView({
              behavior: 'smooth',
              block: 'center'
            });

            // Focus the first input field after scroll finishes
            setTimeout(() => {
              const firstInput = target.querySelector('input');
              if (firstInput) {
                firstInput.focus();
                // Optional: add a temporary highlight effect
                firstInput.classList.add('ring-4', 'ring-blue-100');
                setTimeout(() => firstInput.classList.remove('ring-4', 'ring-blue-100'), 1500);
              }
            }, 800);
          }
        });
      });
    });
  </script>
@endsection