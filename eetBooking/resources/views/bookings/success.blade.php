@extends('layouts.app')

@section('title', 'Booking Successful - Egypt Express Travel')

@section('content')
  <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
    <div class="bg-white p-12 rounded-3xl shadow-xl border border-gray-50">
      <div class="flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mx-auto mb-8">
        <svg class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
      </div>

      <h1 class="text-4xl font-black text-gray-900 mb-4 tracking-tight">Booking Received!</h1>
      <p class="text-xl text-gray-500 mb-10 leading-relaxed">Thank you, <strong>{{ $booking->customer_name }}</strong>.
        Your inquiry for <strong>{{ $booking->package->name_en }}</strong> has been received successfully.</p>

      <div class="bg-gray-50 rounded-2xl p-6 mb-10 text-left border border-gray-100">
        <div class="grid grid-cols-2 gap-y-4">
          <span class="text-gray-500">Booking ID:</span>
          <span class="font-bold text-gray-900">#EET-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>

          <span class="text-gray-500">Travel Date:</span>
          <span
            class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($booking->travel_date)->format('M d, Y') }}</span>

          <span class="text-gray-500">Estimated Total:</span>
          <span class="font-bold text-sky-600 tracking-tight">${{ number_format($booking->total_price, 2) }}</span>
        </div>
      </div>

      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="/"
          class="px-8 py-4 bg-sky-600 text-white font-bold rounded-xl hover:bg-sky-700 transition shadow-lg shadow-sky-500/20">Back
          to Home</a>
        <a href="{{ route('packages.index') }}"
          class="px-8 py-4 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Explore More</a>
      </div>
    </div>
  </div>
@endsection