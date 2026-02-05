<nav x-data="{ 
    mobileMenuOpen: false, 
    scrolled: false,
    init() {
        window.addEventListener('scroll', () => {
            this.scrolled = window.pageYOffset > 20;
        });
    }
}" :class="{ 'bg-white/90 backdrop-blur-md shadow-md py-1': scrolled, 'bg-white py-2': !scrolled }"
  class="fixed top-0 w-full z-50 transition-all duration-300 border-b border-gray-100/50">

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center transition-all duration-300"
      :class="{ 'h-10': scrolled, 'h-12': !scrolled }">

      {{-- Logo Area --}}
      <div class="flex-shrink-0 flex items-center gap-3">
        <a href="{{ route('home') }}" class="flex items-center gap-2 group">
          <img src="{{ asset('logo.png') }}" alt="Egypt Express Travel" class="w-auto transition-all duration-300"
            :class="{ 'h-8': scrolled, 'h-10': !scrolled }">
        </a>
      </div>

      {{-- Desktop Navigation --}}
      <div class="hidden lg:flex lg:items-center lg:space-x-8">
        {{-- Home --}}
        <a href="{{ route('home') }}"
          class="text-sm font-bold transition {{ request()->routeIs('home') ? 'text-blue-600 relative after:content-[\'\'] after:absolute after:bottom-[-4px] after:left-0 after:h-0.5 after:bg-blue-600 after:w-full' : 'text-gray-600 hover:text-blue-600 relative after:content-[\'\'] after:absolute after:bottom-[-4px] after:left-0 after:w-0 after:h-0.5 after:bg-blue-600 after:transition-all hover:after:w-full' }}">
          Home
        </a>

        {{-- About us --}}
        <a href="{{ route('about') }}"
          class="text-sm font-bold transition {{ request()->routeIs('about') ? 'text-blue-600 relative after:content-[\'\'] after:absolute after:bottom-[-4px] after:left-0 after:h-0.5 after:bg-blue-600 after:w-full' : 'text-gray-600 hover:text-blue-600 relative after:content-[\'\'] after:absolute after:bottom-[-4px] after:left-0 after:w-0 after:h-0.5 after:bg-blue-600 after:transition-all hover:after:w-full' }}">
          About us
        </a>

        {{-- Holiday Packages Dropdown --}}
        <div class="relative group" x-data="{ packagesOpen: false }" @mouseenter="packagesOpen = true"
          @mouseleave="packagesOpen = false">
          <button
            class="flex items-center gap-1 text-sm font-bold transition py-2 {{ request()->routeIs('packages.*') ? 'text-blue-600' : 'text-gray-600 group-hover:text-blue-600' }}">
            Holiday Packages
            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300"
              :class="{ 'rotate-180': packagesOpen }"></i>
          </button>

          <div x-show="packagesOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            class="absolute left-0 mt-0 w-56 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden py-1 z-50">

            <div class="h-1 bg-gradient-to-r from-blue-500 to-sky-400"></div>

            <a href="{{ route('packages.index', ['country_id' => 1]) }}"
              class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition group/item">
              <span
                class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 group-hover/item:bg-blue-600 group-hover/item:text-white transition">
                {{-- <i class="fa-solid fa-pyramid"></i> --}}
                <i class="fa-solid fa-plane"></i>
              </span>
              Egypt Packages
            </a>
            <a href="{{ route('packages.index', ['country_id' => 2]) }}"
              class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition group/item">
              <span
                class="w-8 h-8 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 group-hover/item:bg-sky-600 group-hover/item:text-white transition">
                <i class="fa-solid fa-globe"></i>
              </span>
              Worldwide
            </a>
            <a href="{{ route('packages.custom') }}"
              class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-700 hover:bg-amber-50 hover:text-amber-600 transition group/item">
              <span
                class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 group-hover/item:bg-amber-600 group-hover/item:text-white transition">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
              </span>
              Custom Package
            </a>
            <div class="border-t border-gray-100 my-1"></div>
            <a href="{{ route('packages.index') }}"
              class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-gray-900 hover:bg-blue-50 hover:text-blue-600 transition">
              View All Packages
            </a>
          </div>
        </div>

        {{-- Services Dropdown --}}
        <div class="relative group" x-data="{ servicesOpen: false }" @mouseenter="servicesOpen = true"
          @mouseleave="servicesOpen = false">
          <button
            class="flex items-center gap-1 text-sm font-bold transition py-2 {{ request()->routeIs('transfers.*') || request()->routeIs('visas.*') || request()->routeIs('flights.index') ? 'text-blue-600' : 'text-gray-600 group-hover:text-blue-600' }}">
            Services
            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300"
              :class="{ 'rotate-180': servicesOpen }"></i>
          </button>
          <div x-show="servicesOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            class="absolute left-0 mt-0 w-56 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden py-1 z-50">

            <div class="h-1 bg-gradient-to-r from-purple-500 to-pink-400"></div>

            <a href="#tours"
              class="block px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition">
              <i class="fa-solid fa-bus mr-2 text-gray-400"></i> Tours
            </a>
            <a href="{{ route('transfers.index') }}"
              class="block px-4 py-2.5 text-sm font-medium {{ request()->routeIs('transfers.*') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600' }} transition">
              <i class="fa-solid fa-car mr-2 text-gray-400"></i> Transfers
            </a>
            <a href="{{ route('visas.index') }}"
              class="block px-4 py-2.5 text-sm font-medium {{ request()->routeIs('visas.*') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600' }} transition">
              <i class="fa-solid fa-passport mr-2 text-gray-400"></i> Travel Visa
            </a>
            <a href="{{ route('flights.index') }}"
              class="block px-4 py-2.5 text-sm font-medium {{ request()->routeIs('flights.index') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-purple-50 hover:text-purple-600' }} transition">
              <i class="fa-solid fa-plane mr-2 text-gray-400"></i> Flight Ticket
            </a>
          </div>
        </div>

        {{-- MICE --}}
        <a href="https://eetevent.com/" target="_blank"
          class="text-sm font-bold text-gray-600 hover:text-blue-600 transition relative after:content-[''] after:absolute after:bottom-[-4px] after:left-0 after:w-0 after:h-0.5 after:bg-blue-600 after:transition-all hover:after:w-full">
          MICE
        </a>

        {{-- Contact --}}
        <a href="{{ route('contact') }}"
          class="text-sm font-bold transition {{ request()->routeIs('contact') ? 'text-blue-600 relative after:content-[\'\'] after:absolute after:bottom-[-4px] after:left-0 after:h-0.5 after:bg-blue-600 after:w-full' : 'text-gray-600 hover:text-blue-600 relative after:content-[\'\'] after:absolute after:bottom-[-4px] after:left-0 after:w-0 after:h-0.5 after:bg-blue-600 after:transition-all hover:after:w-full' }}">
          Contact us
        </a>
      </div>

      {{-- Auth Buttons (Desktop) --}}
      <div class="hidden lg:flex lg:items-center lg:space-x-3">
        @auth
          <div class="relative" x-data="{ userMenuOpen: false }">
            <button @click="userMenuOpen = !userMenuOpen"
              class="flex items-center gap-2 pl-2 pr-1 py-1 rounded-full border border-gray-200 hover:border-blue-400 hover:shadow-md transition bg-white">
              <div
                class="w-8 h-8 bg-gradient-to-br from-blue-600 to-sky-500 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-sm">
                {{ substr(auth()->user()->name, 0, 1) }}
              </div>
              <span class="text-sm font-bold text-gray-700 pr-2">{{ auth()->user()->name }}</span>
              <i class="fa-solid fa-chevron-down text-gray-400 text-xs pr-2"></i>
            </button>
            <div x-show="userMenuOpen" @click.away="userMenuOpen = false"
              x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2"
              x-transition:enter-end="opacity-100 translate-y-0"
              class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-1 overflow-hidden z-50">
              <a href="{{ route('dashboard') }}"
                class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                <i class="fa-regular fa-user text-gray-400"></i> My Profile
              </a>
              <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                <i class="fa-solid fa-gear text-gray-400"></i> Settings
              </a>
              <div class="border-t border-gray-100 my-1"></div>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                  class="w-full text-left flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                  <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                </button>
              </form>
            </div>
          </div>
        @else
          {{-- Login Button (Primary) --}}
          <a href="{{ route('login') }}"
            class="px-6 py-2.5 rounded-full bg-blue-600 text-white text-sm font-bold shadow-lg shadow-blue-600/30 hover:bg-blue-700 hover:shadow-blue-600/40 transform hover:-translate-y-0.5 transition-all duration-300">
            <i class="fa-regular fa-user mr-1"></i> Login
          </a>
        @endauth
      </div>

      {{-- Mobile Menu Button --}}
      <div class="lg:hidden flex items-center gap-4">
        @guest
          <a href="{{ route('login') }}" class="text-sm font-bold text-blue-600">Login</a>
        @endguest

        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-800 hover:text-blue-600 transition p-2">
          <i class="fa-solid fa-bars text-xl" x-show="!mobileMenuOpen"></i>
          <i class="fa-solid fa-xmark text-xl" x-show="mobileMenuOpen" style="display: none;"></i>
        </button>
      </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0 height-0" x-transition:enter-end="opacity-100 height-auto"
      x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 height-auto"
      x-transition:leave-end="opacity-0 height-0" class="lg:hidden border-t border-gray-100 overflow-hidden"
      style="display: none;">

      <div class="py-4 space-y-1">
        <a href="{{ route('home') }}"
          class="block px-4 py-3 text-base font-bold transition rounded-lg mx-2 {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
          Home
        </a>
        <a href="{{ route('about') }}"
          class="block px-4 py-3 text-base font-bold transition rounded-lg mx-2 {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
          About us
        </a>

        {{-- Mobile Packages Dropdown --}}
        <div x-data="{ mobilePackagesOpen: false }">
          <button @click="mobilePackagesOpen = !mobilePackagesOpen"
            class="w-full text-left px-4 py-3 text-base font-bold transition rounded-lg mx-2 flex items-center justify-between {{ request()->routeIs('packages.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
            Holiday Packages
            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300"
              :class="{ 'rotate-180': mobilePackagesOpen }"></i>
          </button>
          <div x-show="mobilePackagesOpen" x-transition class="pl-4 space-y-1 bg-gray-50/50 rounded-lg mx-2 py-2 mb-2"
            style="display: none;">
            <a href="{{ route('packages.index', ['country_id' => 1]) }}"
              class="block px-4 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 transition">
              <i class="fa-solid fa-pyramid w-5 text-center mr-2"></i> Egypt Packages
            </a>
            <a href="{{ route('packages.index', ['country_id' => 2]) }}"
              class="block px-4 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 transition">
              <i class="fa-solid fa-globe w-5 text-center mr-2"></i> Worldwide
            </a>
            <a href="{{ route('packages.index') }}"
              class="block px-4 py-2 text-sm font-bold text-blue-600 hover:text-blue-700 transition">
              View All Packages
            </a>
          </div>
        </div>

        {{-- Mobile Services Dropdown --}}
        <div x-data="{ mobileServicesOpen: false }">
          <button @click="mobileServicesOpen = !mobileServicesOpen"
            class="w-full text-left px-4 py-3 text-base font-bold transition rounded-lg mx-2 flex items-center justify-between {{ request()->routeIs('transfers.*') || request()->routeIs('visas.*') || request()->routeIs('flights.index') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
            Services
            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300"
              :class="{ 'rotate-180': mobileServicesOpen }"></i>
          </button>
          <div x-show="mobileServicesOpen" x-transition class="pl-4 space-y-1 bg-gray-50/50 rounded-lg mx-2 py-2 mb-2"
            style="display: none;">
            <a href="#tours" class="block px-4 py-2 text-sm font-medium text-gray-600 hover:text-purple-600 transition">
              <i class="fa-solid fa-bus w-5 text-center mr-2"></i> Tours
            </a>
            <a href="{{ route('transfers.index') }}"
              class="block px-4 py-2 text-sm font-medium transition {{ request()->routeIs('transfers.*') ? 'text-purple-600 bg-purple-100 rounded' : 'text-gray-600 hover:text-purple-600' }}">
              <i class="fa-solid fa-car w-5 text-center mr-2"></i> Transfers
            </a>
            <a href="{{ route('visas.index') }}"
              class="block px-4 py-2 text-sm font-medium transition {{ request()->routeIs('visas.*') ? 'text-purple-600 bg-purple-100 rounded' : 'text-gray-600 hover:text-purple-600' }}">
              <i class="fa-solid fa-passport w-5 text-center mr-2"></i> Travel Visa
            </a>
            <a href="{{ route('flights.index') }}"
              class="block px-4 py-2 text-sm font-medium transition {{ request()->routeIs('flights.index') ? 'text-purple-600 bg-purple-100 rounded' : 'text-gray-600 hover:text-purple-600' }}">
              <i class="fa-solid fa-plane w-5 text-center mr-2"></i> Flight Ticket
            </a>
          </div>
        </div>

        <a href="https://eetevent.com/" target="_blank"
          class="block px-4 py-3 text-base font-bold text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition rounded-lg mx-2">
          MICE
        </a>
        <a href="{{ route('contact') }}"
          class="block px-4 py-3 text-base font-bold transition rounded-lg mx-2 {{ request()->routeIs('contact') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
          Contact us
        </a>

        {{-- Mobile Auth Links --}}
        <div class="border-t border-gray-100 pt-4 mt-4 space-y-2 px-4">
          @auth
            <a href="{{ route('dashboard') }}" class="block py-3 text-gray-700 font-bold hover:text-blue-600 transition">
              <i class="fa-regular fa-user mr-2"></i> My Profile
            </a>
            <a href="{{ route('profile.edit') }}"
              class="block py-3 text-gray-700 font-bold hover:text-blue-600 transition">
              <i class="fa-solid fa-gear mr-2"></i> Settings
            </a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left py-3 text-red-600 font-bold hover:text-red-700 transition">
                <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Logout
              </button>
            </form>
          @else
            <a href="{{ route('login') }}"
              class="block w-full py-3 bg-blue-600 text-white font-bold rounded-xl text-center shadow-lg hover:bg-blue-700 transition">
              Login
            </a>
            <p class="text-center text-sm text-gray-500 mt-2">
              Don't have an account? <a href="{{ route('register') }}"
                class="text-blue-600 font-bold hover:underline">Register</a>
            </p>
          @endauth
        </div>
      </div>
    </div>
  </div>
</nav>