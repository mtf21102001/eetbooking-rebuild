<footer class="bg-gray-900 text-white pt-16 pb-8 border-t border-gray-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Top Partners Section (Optional - can be logos) --}}
    <div class="flex justify-center gap-8 mb-12 opacity-50 grayscale hover:grayscale-0 transition duration-500">
      {{-- Placeholders for partner logos if needed, using generic icons for now --}}
      <i class="fa-brands fa-cc-visa text-4xl"></i>
      <i class="fa-brands fa-cc-mastercard text-4xl"></i>
      <i class="fa-brands fa-fly text-4xl"></i>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">

      {{-- Column 1: About & Social --}}
      <div class="space-y-6">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
          <img src="{{ asset('logo.png') }}" alt="Egypt Express Travel" class="h-12 w-auto brightness-1">
        </a>
        <p class="text-gray-400 text-sm leading-relaxed">
          Explore the wonders of Egypt with us. We provide premium travel experiences, from historical tours to relaxing
          getaways.
        </p>
        <div class="flex gap-4">
          <a href="https://www.facebook.com/egyptexpresstravel"
            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-blue-600 hover:text-white transition duration-300">
            <i class="fa-brands fa-facebook-f"></i>
          </a>
          <a href="https://twitter.com/EETEGYPT"
            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-sky-500 hover:text-white transition duration-300">
            <i class="fa-brands fa-twitter"></i>
          </a>
          <a href="https://www.instagram.com/egyptexpresstravel/"
            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-pink-600 hover:text-white transition duration-300">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <a href="https://www.tiktok.com/@egyptexpress"
            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-red-600 hover:text-white transition duration-300">
            <i class="fa-brands fa-tiktok"></i>
          </a>
        </div>
      </div>

      {{-- Column 2: Visit Us (Contact) --}}
      <div>
        <h3 class="text-lg font-bold text-white mb-6 uppercase tracking-wider">Visit Us</h3>
        <ul class="space-y-4 text-sm text-gray-400">
          <li class="flex items-start gap-3">
            <i class="fa-solid fa-location-dot mt-1 text-blue-500"></i>
            <span>94 Shehab St, Mit Akaba, Agouza, Giza Governorate 3752641</span>
          </li>
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-phone text-blue-500"></i>
            <a href="tel:0233033371" class="hover:text-white transition">02 33033371</a>
          </li>
          <li class="flex items-center gap-3">
            <i class="fa-solid fa-envelope text-blue-500"></i>
            <a href="mailto:info@egyptexpresstvl.com" class="hover:text-white transition">info@egyptexpresstvl.com</a>
          </li>
        </ul>
      </div>

      {{-- Column 3: Quick Links --}}
      <div>
        <h3 class="text-lg font-bold text-white mb-6 uppercase tracking-wider">Quick Links</h3>
        <ul class="space-y-3 text-sm text-gray-400">
          <li><a href="{{ route('packages.index') }}" class="hover:text-blue-400 transition flex items-center gap-2"><i
                class="fa-solid fa-angle-right text-xs"></i> Packages</a></li>
          <li><a href="#tours" class="hover:text-blue-400 transition flex items-center gap-2"><i
                class="fa-solid fa-angle-right text-xs"></i> Tours</a></li>
          <li><a href="{{ route('transfers.index') }}" class="hover:text-blue-400 transition flex items-center gap-2"><i
                class="fa-solid fa-angle-right text-xs"></i> Transfers</a></li>
          <li><a href="{{ route('visas.index') }}" class="hover:text-blue-400 transition flex items-center gap-2"><i
                class="fa-solid fa-angle-right text-xs"></i> Visa Services</a></li>
          <li><a href="{{ route('about') }}" class="hover:text-blue-400 transition flex items-center gap-2"><i
                class="fa-solid fa-angle-right text-xs"></i> About Us</a></li>
          <li><a href="{{ route('contact') }}" class="hover:text-blue-400 transition flex items-center gap-2"><i
                class="fa-solid fa-angle-right text-xs"></i> Contact Us</a></li>
        </ul>
      </div>

      {{-- Column 4: Affiliations (Placeholder) --}}
      <div>
        <h3 class="text-lg font-bold text-white mb-6 uppercase tracking-wider">Affiliations</h3>
        <div class="flex flex-wrap gap-4">
          {{-- Example Badges --}}
          <div
            class="h-12 w-12 bg-gray-800 rounded-full flex items-center justify-center text-yellow-500 border border-gray-700">
            <i class="fa-solid fa-award text-xl"></i>
          </div>
          <div
            class="h-12 w-12 bg-gray-800 rounded-full flex items-center justify-center text-blue-400 border border-gray-700">
            <i class="fa-solid fa-plane-up text-xl"></i>
          </div>
          <div
            class="h-12 w-12 bg-gray-800 rounded-full flex items-center justify-center text-green-500 border border-gray-700">
            <i class="fa-solid fa-leaf text-xl"></i>
          </div>
        </div>
        <p class="text-xs text-gray-500 mt-4">Proud member of global travel associations.</p>
      </div>
    </div>

    <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
      <p class="text-sm text-gray-500">
        &copy; {{ date('Y') }} <span class="text-white font-bold">Egypt Express Travel</span>. All Rights Reserved.
      </p>
      <div class="flex gap-6 text-sm text-gray-500">
        <a href="#" class="hover:text-white transition">Privacy Policy</a>
        <a href="#" class="hover:text-white transition">Terms of Service</a>
      </div>
    </div>
  </div>
</footer>