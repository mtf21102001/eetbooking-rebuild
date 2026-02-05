@extends('layouts.app')

@section('title', 'Request Received - Egypt Express Travel')

@section('content')
  <div class="bg-white min-h-screen flex items-center justify-center pt-20">
    <div class="max-w-xl w-full px-4 text-center" data-aos="zoom-in">
      <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-8">
        <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
      </div>

      <h1 class="text-4xl font-black text-gray-900 mb-4 font-sans">
        @if(isset($isTransfer) && $isTransfer)
          Transfer Request Received!
        @else
          Flight Request Received!
        @endif
      </h1>
      <p class="text-gray-500 text-lg mb-8">Thank you, <span
          class="font-bold text-gray-900">{{ $booking->first_name }}</span>. Your flight request has been recorded and our
        team will contact you shortly with the best available quotes.</p>

      <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 text-left mb-10">
        <div class="flex justify-between items-center mb-6">
          <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Booking Reference</span>
          <span
            class="px-4 py-1.5 bg-blue-600 text-white rounded-full font-black text-sm">{{ $booking->booking_reference }}</span>
        </div>

        <div class="space-y-4">
          <div class="flex justify-between">
            <span class="text-gray-500">Route</span>
            @if(isset($isTransfer) && $isTransfer)
              <span class="font-bold text-gray-900">{{ $booking->pickup_location }} →
                {{ $booking->dropoff_location }}</span>
            @else
              <span class="font-bold text-gray-900">{{ $booking->departure_city }} → {{ $booking->arrival_city }}</span>
            @endif
          </div>
          <div class="flex justify-between">
            <span class="text-gray-500">Date</span>
            @if(isset($isTransfer) && $isTransfer)
              <span class="font-bold text-gray-900">{{ $booking->pickup_date->format('M d, Y') }}</span>
            @else
              <span class="font-bold text-gray-900">{{ $booking->departure_date->format('M d, Y') }}</span>
            @endif
          </div>
          <div class="flex justify-between">
            @if(isset($isTransfer) && $isTransfer)
              <span class="text-gray-500">Vehicle Type</span>
              <span class="font-bold text-gray-900 capitalize">{{ $booking->vehicle_type ?? 'Standard' }}</span>
            @else
              <span class="text-gray-500">Class</span>
              <span class="font-bold text-gray-900 capitalize">{{ $booking->class_preference }}</span>
            @endif
          </div>
          <div class="flex justify-between border-t border-gray-200 pt-4">
            <span class="text-gray-500">Status</span>
            <span class="text-blue-600 font-black uppercase text-xs tracking-widest">{{ $booking->status }}</span>
          </div>
        </div>
      </div>

      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ url('/') }}"
          class="px-10 py-4 bg-gray-900 text-white font-bold rounded-2xl hover:bg-blue-600 transition">Back to Home</a>
        <a href="{{ route('packages.index') }}"
          class="px-10 py-4 bg-white border-2 border-gray-100 text-gray-900 font-bold rounded-2xl hover:bg-gray-50 transition">Explore
          Packages</a>
      </div>
    </div>
  </div>
@endsection