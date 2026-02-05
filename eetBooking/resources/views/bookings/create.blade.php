@extends('layouts.app')

@section('title', 'Book Your Trip - Egypt Express Travel')

@section('content')
  <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12 mt-12">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
      <div class="bg-sky-600 px-8 py-6 text-white text-center">
        <h1 class="text-2xl font-bold">Inquiry & Booking</h1>
        <p class="mt-1 text-sky-100">Tell us more about your trip and we'll handle the rest.</p>
      </div>

      <div class="p-8">
        @if($package)
          <div class="mb-8 p-4 bg-gray-50 rounded-xl border border-gray-100 flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Your Selection</p>
              <h3 class="text-xl font-bold text-gray-900">{{ $package->name_en }}</h3>
              <p class="text-gray-500 italic mt-1">{{ $package->duration_days }} Days Trip</p>
            </div>
            <div class="text-right">
              <span class="text-2xl font-black text-sky-600">${{ number_format($package->price, 0) }}</span>
              <p class="text-xs text-gray-400">per person</p>
            </div>
          </div>
        @endif

        @if(session('error'))
          <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
            <div class="flex">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
              </div>
            </div>
          </div>
        @endif

        @if ($errors->any())
          <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
            <div class="flex">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                    clip-rule="evenodd" />
                </svg>
              </div>
              <div class="ml-3">
                <p class="text-sm text-red-700">
                  Please check the errors below:
                </p>
                <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        @endif

        <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
          @csrf
          @if($package)
            <input type="hidden" name="package_id" value="{{ $package->id }}">
          @endif

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="customer_name" class="block text-sm font-semibold text-gray-700">Full Name</label>
              <input type="text" name="customer_name" id="customer_name" required
                class="mt-2 block w-full rounded-xl border-gray-200 shadow-sm focus:border-sky-500 focus:ring-sky-500 transition duration-200"
                placeholder="John Doe" value="{{ Auth::check() ? Auth::user()->name : '' }}">
            </div>
            <div>
              <label for="customer_email" class="block text-sm font-semibold text-gray-700">Email Address</label>
              <input type="email" name="customer_email" id="customer_email" required
                class="mt-2 block w-full rounded-xl border-gray-200 shadow-sm focus:border-sky-500 focus:ring-sky-500 transition duration-200"
                placeholder="john@example.com" value="{{ Auth::check() ? Auth::user()->email : '' }}">
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="customer_phone" class="block text-sm font-semibold text-gray-700">Phone Number</label>
              <input type="text" name="customer_phone" id="customer_phone" required value="01011497255"
                class="mt-2 block w-full rounded-xl border-gray-200 shadow-sm focus:border-sky-500 focus:ring-sky-500 transition duration-200"
                placeholder="+123 456 7890" value="{{ Auth::check() ? Auth::user()->phone : '' }}">
            </div>
            <div>
              <label for="travel_date" class="block text-sm font-semibold text-gray-700">Preferred Travel Date</label>
              <input type="date" name="travel_date" id="travel_date" required value="2026-02-10"
                class="mt-2 block w-full rounded-xl border-gray-200 shadow-sm focus:border-sky-500 focus:ring-sky-500 transition duration-200">
            </div>
          </div>

          <div>
            <label for="number_of_travelers" class="block text-sm font-semibold text-gray-700">Number of Travelers</label>
            <input type="number" name="number_of_travelers" id="number_of_travelers" min="1" required
              class="mt-2 block w-full rounded-xl border-gray-200 shadow-sm focus:border-sky-500 focus:ring-sky-500 transition duration-200"
              value="1">
          </div>

          <div>
            <label for="notes" class="block text-sm font-semibold text-gray-700">Special Requests / Notes</label>
            <textarea name="notes" id="notes" rows="4"
              class="mt-2 block w-full rounded-xl border-gray-200 shadow-sm focus:border-sky-500 focus:ring-sky-500 transition duration-200"
              placeholder="Any special needs, dietary requirements, etc."></textarea>
          </div>

          <div class="pt-4">
            <button type="submit"
              class="w-full bg-sky-600 border border-transparent rounded-xl py-4 px-8 flex items-center justify-center text-lg font-bold text-white hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 shadow-xl shadow-sky-500/20 transition-all">
              Confirm Booking Inquiry
            </button>
            <p class="mt-4 text-center text-sm text-gray-400">Our team will contact you within 24 hours to finalize
              details.</p>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection