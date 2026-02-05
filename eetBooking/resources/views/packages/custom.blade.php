@extends('layouts.app')

@section('title', 'Design Your Own Package - Egypt Express Travel')

@section('content')
  <!-- Hero Section -->
  <div class="relative py-24 bg-gray-900 border-b border-gray-800">
    <div class="absolute inset-0 overflow-hidden">
      <img src="https://images.unsplash.com/photo-1503756234508-e32369269deb?q=80&w=2070&auto=format&fit=crop"
        alt="Design Your Trip" class="w-full h-full object-cover opacity-40">
      <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-sky-900/40 to-transparent"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-8">
      <span class="text-sky-400 font-bold tracking-[0.2em] uppercase text-sm mb-4 block animate-fade-in-up">Tailor-Made
        Luxury</span>
      <h1
        class="text-5xl font-black text-white sm:text-7xl tracking-tight mb-6 font-serif drop-shadow-2xl animate-fade-in-up delay-100">
        Design Your Dream Journey
      </h1>
      <p
        class="max-w-2xl mx-auto text-xl text-gray-100 font-medium leading-relaxed drop-shadow-md animate-fade-in-up delay-200">
        Tell us what you love, and our travel curators will craft a personalized itinerary just for you.
      </p>
    </div>
  </div>

  <div class="min-h-screen bg-gray-50 py-16" x-data="{ 
        selectedDestinations: [], 
        toggleDestination(id) {
            if (this.selectedDestinations.includes(id)) {
                this.selectedDestinations = this.selectedDestinations.filter(item => item !== id);
            } else {
                this.selectedDestinations.push(id);
            }
        },
        hasOther: false
    }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

      @if(session('success'))
        <div
          class="mb-8 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl shadow-sm flex items-center gap-4">
          <i class="fa-solid fa-check-circle text-xl"></i>
          <div>
            <p class="font-bold">Request Received!</p>
            <p class="text-sm">{{ session('success') }}</p>
          </div>
        </div>
      @endif

      @if($errors->any())
        <div class="mb-8 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl shadow-sm">
          <ul class="list-disc list-inside text-sm font-medium">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('packages.custom.store') }}" method="POST" class="space-y-12">
        @csrf

        <!-- SECTION 1: Shopping Grid (Destinations) -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 overflow-hidden relative">
          <div class="absolute top-0 left-0 w-2 h-full bg-sky-600"></div>
          <h2 class="text-2xl font-black text-gray-900 mb-2">1. Where would you like to go?</h2>
          <p class="text-gray-500 mb-8">Select all the destinations you dream of visiting.</p>

          <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-6">
            @foreach($destinations as $destination)
              <div @click="toggleDestination({{ $destination->id }})"
                class="group relative cursor-pointer rounded-xl overflow-hidden aspect-[4/3] border-2 transition-all duration-300"
                :class="selectedDestinations.includes({{ $destination->id }}) ? 'border-sky-600 ring-2 ring-sky-600 ring-offset-2' : 'border-transparent hover:border-gray-200 hover:shadow-lg'">
                <!-- Image -->
                @php
                  $img = is_array($destination->images) ? ($destination->images[0] ?? null) : null;
                  $url = $img ? (Str::startsWith($img, 'http') ? $img : Storage::url($img)) : 'https://via.placeholder.com/300';
                @endphp
                <img src="{{ $url }}"
                  class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                  alt="{{ $destination->name_en }}">

                <!-- Overlay Checkbox UI -->
                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/20 transition-colors"></div>

                <!-- Title & Checkmark -->
                <div
                  class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-black/80 to-transparent flex items-end justify-between">
                  <span class="text-white font-bold text-sm text-shadow">{{ $destination->name_en }}</span>
                  <div
                    class="w-6 h-6 rounded-full bg-white flex items-center justify-center transition-transform duration-300 scale-0"
                    :class="selectedDestinations.includes({{ $destination->id }}) ? 'scale-100 text-sky-600' : ''">
                    <i class="fa-solid fa-check text-xs"></i>
                  </div>
                </div>

                <!-- Hidden Input for Form Submission -->
                <input type="checkbox" name="destinations[]" value="{{ $destination->id }}" x-model="selectedDestinations"
                  class="hidden">
              </div>
            @endforeach
          </div>

          <!-- Other Destination Toggle -->
          <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl cursor-pointer hover:bg-gray-100 transition"
            @click="hasOther = !hasOther">
            <div class="w-5 h-5 rounded border border-gray-300 flex items-center justify-center bg-white"
              :class="hasOther ? 'bg-sky-600 border-sky-600 text-white' : ''">
              <i class="fa-solid fa-check text-xs" x-show="hasOther"></i>
            </div>
            <span class="text-gray-700 font-bold text-sm">I have another destination in mind</span>
          </div>

          <div x-show="hasOther" x-transition class="mt-4">
            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Other
              Destination(s)</label>
            <input type="text" name="other_destination"
              class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-sky-500 focus:ring-sky-500 transition-shadow p-3"
              placeholder="e.g. Siwa Oasis, White Desert...">
          </div>
        </div>

        <!-- SECTION 2: Trip Details -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 relative overflow-hidden">
          <div class="absolute top-0 left-0 w-2 h-full bg-sky-600"></div>
          <h2 class="text-2xl font-black text-gray-900 mb-8">2. Trip Details</h2>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Dates -->
            <div>
              <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Expected Arrival</label>
              <input type="date" name="arrival_date" required min="{{ date('Y-m-d') }}"
                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-sky-500 focus:ring-sky-500 p-3">
            </div>

            <!-- Duration -->
            <div>
              <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Duration (Days)</label>
              <div class="relative">
                <input type="number" name="duration" required min="1" placeholder="e.g. 7"
                  class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-sky-500 focus:ring-sky-500 p-3 pl-4">
                <span class="absolute right-4 top-3.5 text-gray-400 text-sm font-bold">Days</span>
              </div>
            </div>

            <!-- Pax -->
            <div>
              <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Travelers</label>
              <div class="flex gap-4">
                <div class="flex-1">
                  <input type="number" name="adults" required min="1" placeholder="Adults"
                    class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-sky-500 focus:ring-sky-500 p-3">
                </div>
                <div class="flex-1">
                  <input type="number" name="children" min="0" placeholder="Children"
                    class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-sky-500 focus:ring-sky-500 p-3">
                </div>
              </div>
            </div>

            <!-- Budget -->
            <div>
              <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Budget Per Person
                (approx)</label>
              <select name="budget"
                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-sky-500 focus:ring-sky-500 p-3">
                <option value="">Flexible / Not Sure</option>
                <option value="$1000 - $2000">$1000 - $2000</option>
                <option value="$2000 - $3000">$2000 - $3000</option>
                <option value="$3000 - $5000">$3000 - $5000</option>
                <option value="$5000+">$5000+</option>
              </select>
            </div>
          </div>
        </div>

        <!-- SECTION 3: Your Info -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 relative overflow-hidden">
          <div class="absolute top-0 left-0 w-2 h-full bg-sky-600"></div>
          <h2 class="text-2xl font-black text-gray-900 mb-8">3. Contact Information</h2>

          <div class="space-y-4">
            <div>
              <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Full Name</label>
              <input type="text" name="name" required placeholder="John Doe"
                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-sky-500 focus:ring-sky-500 p-3">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Email Address</label>
                <input type="email" name="email" required placeholder="john@example.com"
                  class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-sky-500 focus:ring-sky-500 p-3">
              </div>
              <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Phone /
                  WhatsApp</label>
                <input type="text" name="phone" required placeholder="+1 234 567 890"
                  class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-sky-500 focus:ring-sky-500 p-3">
              </div>
            </div>

            <div>
              <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Any Specific Requests or
                Interests?</label>
              <textarea name="notes" rows="4"
                placeholder="E.g. We love history, want a Nile Cruise, require wheelchair access..."
                class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-sky-500 focus:ring-sky-500 p-3"></textarea>
            </div>
          </div>
        </div>

        <button type="submit"
          class="w-full py-5 rounded-2xl bg-sky-600 hover:bg-sky-700 text-white font-black text-lg uppercase tracking-widest shadow-xl shadow-sky-600/30 transform hover:-translate-y-1 transition duration-300">
          Submit Request
        </button>

      </form>
    </div>
  </div>
@endsection