@extends('layouts.app')

@section('content')
  <!-- Contact Hero Section -->
  <section class="relative h-[60vh] flex items-center justify-center overflow-hidden bg-gray-900">
    <!-- Parallax Background -->
    <div class="absolute inset-0 z-0">
      <img src="{{ asset('images/about/big_01.webp') }}" alt="Contact Egypt Express Travel"
        class="w-full h-full object-cover opacity-60 scale-110 motion-safe:animate-[parallax_20s_linear_infinite]">
      <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70"></div>
    </div>

    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto" data-aos="zoom-out" data-aos-duration="1500">
      <span class="inline-block text-sky-400 font-bold tracking-[0.3em] uppercase mb-4 text-sm">24/7 Support</span>
      <h1 class="text-4xl md:text-6xl font-serif text-white mb-6 leading-tight">
        "We’d Love to <span class="text-sky-500 italic">Hear From You!</span>"
      </h1>
      <p class="text-xl text-gray-200 font-light max-w-2xl mx-auto leading-relaxed">
        Whether you have questions, feedback, or just want to say hello, we’re here for you. Use the form below or visit
        us using the map to get in touch.
      </p>
    </div>
  </section>

  <!-- Contact Cards & Map -->
  <section class="py-20 bg-gray-50 -mt-20 relative z-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Contact Info Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
        <!-- Address -->
        <div class="bg-white p-8 rounded-3xl shadow-xl hover:-translate-y-2 transition duration-300 group">
          <div
            class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6 group-hover:bg-blue-600 group-hover:text-white transition">
            <i class="fa-solid fa-location-dot text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Visit Us</h3>
          <p class="text-gray-500 leading-relaxed">
            94 Shehab St, Mit Akaba, Agouza,<br>
            Giza Governorate 3752641
          </p>
          <a href="#map" class="inline-block mt-4 text-sm font-bold text-blue-600 hover:text-blue-700">View on Map
            &rarr;</a>
        </div>

        <!-- Phone -->
        <div class="bg-white p-8 rounded-3xl shadow-xl hover:-translate-y-2 transition duration-300 group">
          <div
            class="w-14 h-14 bg-sky-50 rounded-2xl flex items-center justify-center text-sky-600 mb-6 group-hover:bg-sky-600 group-hover:text-white transition">
            <i class="fa-solid fa-phone text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Phone</h3>
          <p class="text-gray-500 mb-4">We are available during working hours.</p>
          <div class="space-y-2">
            <a href="tel:0233033371" class="block text-2xl font-bold text-gray-800 hover:text-sky-600 transition">02
              33033371</a>
          </div>
        </div>

        <!-- Working Hours -->
        <div class="bg-white p-8 rounded-3xl shadow-xl hover:-translate-y-2 transition duration-300 group">
          <div
            class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 mb-6 group-hover:bg-purple-600 group-hover:text-white transition">
            <i class="fa-regular fa-clock text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3">Working Hours</h3>
          <ul class="text-gray-500 space-y-2">
            <li class="flex justify-between">
              <span>Monday – Friday:</span>
              <span class="font-bold text-gray-800">09:00 am – 09:00 pm</span>
            </li>
            <li class="flex justify-between">
              <span>Saturday – Sunday:</span>
              <span class="font-bold text-red-500">Closed</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- Form & Map Container -->
      <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden flex flex-col lg:flex-row mb-12">

        <!-- Contact Form -->
        <div class="lg:w-1/2 p-10 lg:p-16 bg-white order-2 lg:order-1">
          <div class="mb-10">
            <span class="text-sky-600 font-bold uppercase tracking-widest text-xs">Message Us</span>
            <h2 class="text-3xl font-serif text-gray-900 mt-2">Send us an inquiry</h2>
          </div>

          @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg">
              <p class="font-bold">Success!</p>
              <p>{{ session('success') }}</p>
            </div>
          @endif

          <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="space-y-2">
                <label for="first_name" class="text-sm font-bold text-gray-700">First Name</label>
                <input type="text" id="first_name" name="first_name"
                  class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 transition"
                  placeholder="First Name">
              </div>
              <div class="space-y-2">
                <label for="last_name" class="text-sm font-bold text-gray-700">Last Name</label>
                <input type="text" id="last_name" name="last_name"
                  class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 transition"
                  placeholder="Last Name">
              </div>
            </div>

            <div class="space-y-2">
              <label for="email" class="text-sm font-bold text-gray-700">Email Address</label>
              <input type="email" id="email" name="email"
                class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 transition"
                placeholder="Email Address">
            </div>

            <div class="space-y-2">
              <label for="subject" class="text-sm font-bold text-gray-700">Subject</label>
              <input type="text" id="subject" name="subject"
                class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 transition"
                placeholder="Subject">
            </div>

            <div class="space-y-2">
              <label for="message" class="text-sm font-bold text-gray-700">Your Message</label>
              <textarea id="message" name="message" rows="4"
                class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 transition"
                placeholder="Your Message"></textarea>
            </div>

            <button type="submit"
              class="w-full py-4 bg-gradient-to-r from-blue-600 to-sky-500 text-white font-bold rounded-xl shadow-lg shadow-sky-500/30 hover:shadow-sky-500/50 hover:scale-[1.01] transition duration-300">
              Send Message <i class="fa-solid fa-paper-plane ml-2"></i>
            </button>
          </form>
        </div>

        <!-- Google Map -->
        <div id="map" class="lg:w-1/2 bg-gray-200 h-96 lg:h-auto order-1 lg:order-2 relative">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d110502.6037928258!2d31.11802525540325!3d30.05856427494213!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584114367c9603%3A0x49568fc3fe169eee!2sEgypt%20Express%20Travel!5e0!3m2!1sen!2seg!4v1706868000000!5m2!1sen!2seg"
            width="100%" height="100%" style="border:0; filter: grayscale(0.2) contrast(1.1);" allowfullscreen=""
            loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="absolute inset-0 w-full h-full">
          </iframe>

          <!-- Map Overlay Card -->
          <div
            class="absolute bottom-6 left-6 right-6 p-6 bg-white/90 backdrop-blur-md rounded-2xl shadow-xl lg:max-w-xs">
            <h4 class="font-bold text-gray-900 mb-1">Egypt Express Travel</h4>
            <p class="text-sm text-gray-600">94 Shehab St, Mit Akaba, Agouza</p>
            <a href="https://maps.app.goo.gl/DWuoxsTDXkN8RXgCA" target="_blank"
              class="text-xs font-bold text-blue-600 hover:underline mt-1 inline-block">Open in Google Maps &rarr;</a>
          </div>
        </div>
      </div>

      <!-- Footer Note -->
      <div class="text-center max-w-2xl mx-auto pb-12 opacity-70">
        <p class="text-gray-600 italic">
          "if you face any problem you can use our above form to contact us by email,or you can use our phone"
        </p>
      </div>

    </div>
  </section>
@endsection