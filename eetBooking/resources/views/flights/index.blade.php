@extends('layouts.app')

@section('title', 'Global Flight Tickets - Egypt Express Travel')

@section('content')
  <div class="min-h-screen bg-white">
    <!-- Hero Section with Flight Booking Form -->
    <div class="relative pt-32 pb-24 overflow-hidden">
      <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1436491865332-7a61a109c0f2?auto=format&fit=crop&w=1920&q=80"
          class="w-full h-full object-cover opacity-10" alt="Cloud Background">
        <div class="absolute inset-0 bg-gradient-to-b from-white via-white/70 to-white"></div>
      </div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col items-center gap-12 lg:gap-16">
          <div class="w-full text-center" data-aos="fade-down">
            <span
              class="inline-block px-4 py-1.5 rounded-full bg-blue-50 text-blue-600 font-bold text-sm tracking-wider uppercase mb-6">
              Best Deals Guaranteed
            </span>
            <h1 class="text-5xl md:text-7xl font-black text-gray-900 mb-8 leading-tight">
              Fly Anywhere, <span class="text-blue-600">Egypt</span> Style.
            </h1>
            <p class="text-gray-500 text-xl leading-relaxed max-w-2xl mx-auto font-medium">
              Access exclusive fares to thousands of destinations worldwide. From local hops to international luxury
              journeys, we find the best route for you.
            </p>
          </div>

          <div data-aos="fade-up"
            class="w-full bg-white p-8 md:p-12 rounded-[4rem] shadow-2xl shadow-blue-500/40 border border-gray-100 relative">
            <div
              class="absolute -top-10 left-1/2 -translate-x-1/2 w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center text-white text-3xl shadow-xl shadow-blue-500/30">
              <i class="fa-solid fa-plane-up"></i>
            </div>

            <form action="{{ route('flights.book') }}" id="booking" method="POST" class="space-y-8 mt-4">
              @csrf
              <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
                {{-- Route Info --}}
                <div class="space-y-2 lg:col-span-1">
                  <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Departure City</label>
                  <div class="relative">
                    <i class="fa-solid fa-plane-departure absolute left-4 top-1/2 -translate-y-1/2 text-blue-500"></i>
                    <input type="text" name="departure_city" required placeholder="From where?"
                      class="w-full pl-12 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition">
                  </div>
                </div>
                <div class="space-y-2 lg:col-span-1">
                  <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Arrival City</label>
                  <div class="relative">
                    <i class="fa-solid fa-plane-arrival absolute left-4 top-1/2 -translate-y-1/2 text-blue-500"></i>
                    <input type="text" name="arrival_city" required placeholder="To where?"
                      class="w-full pl-12 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition">
                  </div>
                </div>

                {{-- Dates --}}
                <div class="space-y-2 lg:col-span-1">
                  <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Departure Date</label>
                  <div class="relative">
                    <i class="fa-solid fa-calendar absolute left-4 top-1/2 -translate-y-1/2 text-blue-500"></i>
                    <input type="date" name="departure_date" required min="{{ date('Y-m-d') }}"
                      class="w-full pl-12 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition">
                  </div>
                </div>
                <div class="space-y-2 lg:col-span-1">
                  <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Return Date
                    (Optional)</label>
                  <div class="relative">
                    <i class="fa-regular fa-calendar absolute left-4 top-1/2 -translate-y-1/2 text-blue-500"></i>
                    <input type="date" name="return_date" min="{{ date('Y-m-d') }}"
                      class="w-full pl-12 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition">
                  </div>
                </div>

                {{-- Passengers & Class --}}
                <div class="space-y-2 lg:col-span-1">
                  <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Travelers</label>
                  <div class="relative group">
                    <i class="fa-solid fa-user-group absolute left-4 top-1/2 -translate-y-1/2 text-blue-500"></i>
                    <select name="adults"
                      class="w-full pl-12 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition appearance-none cursor-pointer">
                      <option value="1">1 Adult</option>
                      <option value="2">2 Adults</option>
                      <option value="3">3 Adults</option>
                      <option value="4">4+ Adults</option>
                    </select>
                    <i
                      class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none transition group-hover:translate-y-[-40%]"></i>
                  </div>
                </div>
                <div class="space-y-2 lg:col-span-1">
                  <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Class</label>
                  <div class="relative group">
                    <i class="fa-solid fa-crown absolute left-4 top-1/2 -translate-y-1/2 text-blue-500"></i>
                    <select name="class_preference"
                      class="w-full pl-12 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition appearance-none cursor-pointer">
                      <option value="economy">Economy</option>
                      <option value="business">Business</option>
                      <option value="first">First Class</option>
                    </select>
                    <i
                      class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none transition group-hover:translate-y-[-40%]"></i>
                  </div>
                </div>

                {{-- Personal Details --}}
                <div class="space-y-4 lg:col-span-2">
                  <label class="text-xs font-black text-gray-400 uppercase tracking-widest ml-1">Contact Details</label>
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @php
                      $firstName = '';
                      $lastName = '';
                      if (auth()->check()) {
                        $parts = explode(' ', auth()->user()->name, 2);
                        $firstName = $parts[0] ?? '';
                        $lastName = $parts[1] ?? '';
                      }
                    @endphp
                    <input type="text" name="first_name" required placeholder="First Name"
                      value="{{ old('first_name', $firstName) }}"
                      class="w-full px-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition">
                    <input type="text" name="last_name" required placeholder="Last Name"
                      value="{{ old('last_name', $lastName) }}"
                      class="w-full px-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition">
                    <input type="email" name="email" required placeholder="Email Address"
                      value="{{ old('email', auth()->user()->email ?? '') }}"
                      class="w-full px-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition">
                    <input type="tel" name="phone" required placeholder="Phone Number" value="{{ old('phone') }}"
                      class="w-full px-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold transition">
                  </div>
                </div>
              </div>

              <div class="flex flex-col md:flex-row items-center justify-between gap-8 pt-6 border-t border-gray-50">
                <div class="flex items-center gap-4">
                  <div class="flex -space-x-3">
                    <div
                      class="w-10 h-10 rounded-full border-2 border-white bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs uppercase">
                      E</div>
                    <div
                      class="w-10 h-10 rounded-full border-2 border-white bg-sky-100 flex items-center justify-center text-sky-600 font-bold text-xs uppercase">
                      E</div>
                    <div
                      class="w-10 h-10 rounded-full border-2 border-white bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs uppercase">
                      T</div>
                  </div>
                  <p class="text-sm font-bold text-gray-500">Join 1,000+ monthly happy travelers.</p>
                </div>
                <button type="submit"
                  class="w-full md:w-auto px-12 py-5 bg-blue-600 text-white font-black rounded-2xl hover:bg-blue-700 transition shadow-xl shadow-blue-500/30 flex items-center justify-center gap-3 group">
                  Request Best Quote <i
                    class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Featured Destinations -->
    <div class="py-24 bg-gray-50/50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
          <div data-aos="fade-right">
            <h2 class="text-4xl font-black text-gray-900 mb-4">Trending Destinations</h2>
            <p class="text-gray-500 text-lg font-medium">Most booked flight routes this month.</p>
          </div>
          <a href="{{ route('packages.index') }}"
            class="text-blue-600 font-black flex items-center gap-2 hover:gap-4 transition-all" data-aos="fade-left">
            Explore Holidays <i class="fa-solid fa-arrow-right"></i>
          </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          @php
            $destinations = [
              ['name' => 'Dubai, UAE', 'image' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=600&q=80', 'price' => 'From $299'],
              ['name' => 'Istanbul, Turkey', 'image' => 'https://images.unsplash.com/photo-1524231757912-21f4fe3a7200?auto=format&fit=crop&w=600&q=80', 'price' => 'From $199'],
              ['name' => 'London, UK', 'image' => 'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?auto=format&fit=crop&w=600&q=80', 'price' => 'From $450'],
              ['name' => 'Cairo, Egypt', 'image' => 'https://images.unsplash.com/photo-1572252009286-268acec5ca0a?auto=format&fit=crop&w=600&q=80', 'price' => 'Local Special'],
            ];
          @endphp

          @foreach($destinations as $dest)
            <div
              class="group relative rounded-[3rem] overflow-hidden bg-white shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
              data-aos="zoom-in">
              <div class="h-64 overflow-hidden">
                <img src="{{ $dest['image'] }}" alt="{{ $dest['name'] }}"
                  class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
              </div>
              <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-60"></div>
              <div class="absolute bottom-10 left-10">
                <h4 class="text-2xl font-black text-white mb-2">{{ $dest['name'] }}</h4>
                <span
                  class="inline-block px-3 py-1 bg-blue-600 text-white rounded-full text-xs font-black uppercase tracking-widest">{{ $dest['price'] }}</span>
              </div>
              <button type="button" onclick="preFillFlight('{{ $dest['name'] }}')"
                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-blue-600/10 backdrop-blur-sm z-20">
                <span
                  class="px-8 py-3 bg-white text-blue-600 font-black rounded-2xl shadow-xl transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">Get
                  Offer</span>
              </button>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <!-- Trust signals -->
    <div class="py-24 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
          <div class="flex items-start gap-6" data-aos="fade-up">
            <div
              class="w-16 h-16 bg-blue-50 text-blue-600 rounded-3xl flex items-center justify-center flex-shrink-0 text-2xl font-black">
              <i class="fa-solid fa-headset"></i>
            </div>
            <div>
              <h4 class="text-xl font-black text-gray-900 mb-3">24/7 Global Support</h4>
              <p class="text-gray-500 leading-relaxed font-medium">Real travel experts available around the clock to help
                with changes, cancellations, or emergencies.</p>
            </div>
          </div>

          <div class="flex items-start gap-6" data-aos="fade-up" data-aos-delay="100">
            <div
              class="w-16 h-16 bg-blue-50 text-blue-600 rounded-3xl flex items-center justify-center flex-shrink-0 text-2xl font-black">
              <i class="fa-solid fa-bolt"></i>
            </div>
            <div>
              <h4 class="text-xl font-black text-gray-900 mb-3">Instant Responses</h4>
              <p class="text-gray-500 leading-relaxed font-medium">Our team works directly with airlines to get you the
                fastest quote and confirmation possible.</p>
            </div>
          </div>

          <div class="flex items-start gap-6" data-aos="fade-up" data-aos-delay="200">
            <div
              class="w-16 h-16 bg-blue-50 text-blue-600 rounded-3xl flex items-center justify-center flex-shrink-0 text-2xl font-black">
              <i class="fa-solid fa-wallet"></i>
            </div>
            <div>
              <h4 class="text-xl font-black text-gray-900 mb-3">Exclusive Fares</h4>
              <p class="text-gray-500 leading-relaxed font-medium">Access private negotiated rates that aren't available
                on standard booking engines.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function preFillFlight(destination) {
      // Find the arrival city input
      const arrivalInput = document.querySelector('input[name="arrival_city"]');
      const bookingSection = document.getElementById('booking');

      if (arrivalInput && bookingSection) {
        // Clear country name if present (e.g., "Dubai, UAE" -> "Dubai")
        const cityName = destination.split(',')[0].trim();
        arrivalInput.value = cityName;

        // Scroll to form
        bookingSection.scrollIntoView({ behavior: 'smooth', block: 'center' });

        // Focus and highlight
        setTimeout(() => {
          arrivalInput.focus();
          arrivalInput.classList.add('ring-4', 'ring-blue-100');
          setTimeout(() => arrivalInput.classList.remove('ring-4', 'ring-blue-100'), 1500);
        }, 800);
      }
    }

    document.addEventListener('DOMContentLoaded', function () {
      // Generic Smooth Scroll for other anchors
      const anchors = document.querySelectorAll('a[href^="#"]');
      anchors.forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          const href = this.getAttribute('href');
          if (href && href !== '#') {
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
              target.scrollIntoView({ behavior: 'smooth', block: 'center' });
              setTimeout(() => {
                const input = target.querySelector('input');
                if (input) input.focus();
              }, 800);
            }
          }
        });
      });
    });
  </script>
@endsection