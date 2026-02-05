@extends('layouts.app')

@section('title', $visa->title . ' - Egypt Express Travel')

@section('content')
  <div class="bg-gray-50 min-h-screen pt-32 pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

        <!-- Left: Visa Details -->
        <div class="lg:col-span-2 space-y-8">
          <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-sm border border-gray-100" data-aos="fade-up">
            <div class="relative h-96">
              <img
                src="{{ $visa->image_url ? Storage::url($visa->image_url) : 'https://images.unsplash.com/photo-1544027993-37dbfe43552e?auto=format&fit=crop&w=1200' }}"
                class="w-full h-full object-cover" alt="{{ $visa->title }}">
              <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
              <div class="absolute bottom-10 left-10">
                <h1 class="text-4xl md:text-5xl font-black text-white mb-2">{{ $visa->title }}</h1>
                <p class="text-xl text-white/90 font-bold">{{ $visa->destination->name_en }}</p>
              </div>
            </div>

            <div class="p-10 space-y-10">
              <!-- Description -->
              <div class="prose max-w-none text-gray-600 leading-relaxed text-lg">
                {!! nl2br(e($visa->description)) !!}
              </div>

              <!-- Requirements Dynamic Section -->
              <div class="bg-blue-50 rounded-3xl p-8 border border-blue-100">
                @if($requirement)
                  <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-2xl flex items-center justify-center">
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                    </div>
                    <h2 class="text-2xl font-black text-gray-900">Requirements for {{ $requirement->nationality->name }}
                    </h2>
                  </div>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                      <h3 class="font-black text-gray-900 flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                        Documents Needed
                      </h3>
                      <ul class="space-y-3">
                        @foreach($visa->required_documents ?? [] as $doc)
                          <li class="flex items-center gap-2 text-gray-600">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                              <path
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z">
                              </path>
                            </svg>
                            {{ $doc['document'] }}
                          </li>
                        @endforeach
                        @foreach($requirement->additional_documents ?? [] as $doc)
                          <li class="flex items-center gap-2 text-blue-600 font-bold">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                              <path
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z">
                              </path>
                            </svg>
                            {{ $doc['document'] }} (Specific requirement)
                          </li>
                        @endforeach
                      </ul>
                    </div>
                    <div class="space-y-4">
                      <h3 class="font-black text-gray-900 flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                        Fee Calculation
                      </h3>
                      <div class="bg-white p-6 rounded-2xl border border-blue-100 shadow-sm">
                        <div class="flex justify-between items-center mb-2">
                          <span class="text-gray-500">Service Fee</span>
                          <span class="font-bold">{{ $visa->price }} {{ $visa->currency }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-4 text-blue-600">
                          <span class="font-bold">Nationality Fee</span>
                          <span class="font-bold">+{{ $requirement->fees ?? 0 }} {{ $visa->currency }}</span>
                        </div>
                        <div class="border-t border-gray-100 pt-4 flex justify-between items-end">
                          <span class="text-gray-900 font-black">Total Price</span>
                          <span class="text-3xl font-black text-blue-600">{{ $visa->price + ($requirement->fees ?? 0) }}
                            {{ $visa->currency }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                  <div class="text-center py-6">
                    <p class="text-blue-900 font-bold opacity-75">Select your nationality on the search page to see specific
                      requirements and final fees.</p>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>

        <!-- Right: Application Form -->
        <div class="lg:col-span-1">
          <div class="bg-white rounded-[2.5rem] p-10 shadow-xl border border-gray-100 sticky top-32" data-aos="fade-left">
            <h2 class="text-3xl font-black text-gray-900 mb-6">Apply Now</h2>

            @if(session('success'))
              <div class="bg-green-50 text-green-700 p-4 rounded-2xl mb-6 font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z">
                  </path>
                </svg>
                {{ session('success') }}
              </div>
            @endif

            <form action="{{ route('visas.apply') }}" method="POST" class="space-y-4">
              @csrf
              <input type="hidden" name="visa_id" value="{{ $visa->id }}">
              <input type="hidden" name="nationality_id" value="{{ $requirement->nationality_id ?? 1 }}">
              <!-- Default or from req -->

              <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                  <label class="text-xs font-black text-gray-400 uppercase tracking-widest pl-2">First Name</label>
                  <input type="text" name="first_name" required
                    value="{{ Auth::check() ? explode(' ', Auth::user()->name)[0] : '' }}"
                    class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="space-y-1">
                  <label class="text-xs font-black text-gray-400 uppercase tracking-widest pl-2">Last Name</label>
                  <input type="text" name="last_name" required
                    value="{{ Auth::check() ? (explode(' ', Auth::user()->name)[1] ?? '') : '' }}"
                    class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500">
                </div>
              </div>

              <div class="space-y-1">
                <label class="text-xs font-black text-gray-400 uppercase tracking-widest pl-2">Email Address</label>
                <input type="email" name="email" required value="{{ Auth::check() ? Auth::user()->email : '' }}"
                  class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500">
              </div>

              <div class="space-y-1">
                <label class="text-xs font-black text-gray-400 uppercase tracking-widest pl-2">Phone Number</label>
                <input type="tel" name="phone" required value="{{ Auth::check() ? Auth::user()->phone : '' }}"
                  class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500"
                  placeholder="+XX-XXX-XXX-XXXX">
              </div>

              <div class="space-y-1">
                <label class="text-xs font-black text-gray-400 uppercase tracking-widest pl-2">Passport Number</label>
                <input type="text" name="passport_number" required
                  class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500">
              </div>

              <div class="space-y-1 text-gray-400">
                <label class="text-xs font-black text-gray-400 uppercase tracking-widest pl-2">Passport Expiry</label>
                <input type="date" name="passport_expiry" required
                  class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500">
              </div>

              <button type="submit"
                class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-xl shadow-blue-600/30 transition transform hover:-translate-y-1 mt-6">
                Submit Application
              </button>
              <p class="text-center text-xs text-gray-400 pt-4 font-bold uppercase tracking-widest">Secure & encrypted
                processing</p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection